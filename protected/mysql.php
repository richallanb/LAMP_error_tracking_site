<?php
// Mysql credentials stored in php file outside of document root.
// Aka you assholes don't stand a chance.

require_once('constants.php');
require_once('secure.php');
require_once('encrypt.php'); 
require_once('objects.php');

class mysqliInterface {
  // Protected object inside an external class for more layering & obscurity
  protected $con;
  protected $connected;
  
  function __construct(){
    // Non CAPS constants, ugh! - Rolando
    $this->con = mysqli_connect(mysqli_host, mysqli_user, mysqli_pw, mysqli_db, mysqli_port);
    $this->connected = true;
  }
  
  // Why not this? - Rolando
  function __destruct(){
    if ($this->connected)
      mysqli_close($this->con);
  }
  
  /* Sign Up
     Returns:   -1 on insertion error (MYSQL Related)
                -2 on invalid email string
                -3 on invalid user string
                idhash when successful
  */
  function signUp($user, $pwhash, $email, $parent){
    // If we have an empty parent string just make sure it's null
    if (strlen($parent) < 1) {
      $parent = null;
    }
    // Bad email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return -2;
    }
    
    // Bad user name
    if (!preg_match(USER_REGEX, $user)){
      return -3;
    }
    
    // Generate a unique id hash for this user
    $idHash = idHash($user, $email);
    
    if ($stmt = $this->con->prepare("INSERT INTO Users (email, user, hash, idhash, parent_idhash) VALUES (?, ?, ?, ?, ?);")) {
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      
      $stmt->bind_param("sssss", $email, $user, $pwhash, $idHash ,$parent);

      /* execute query */
      if ($stmt->execute()) {
        $worked = ($stmt->affected_rows > 0);
        $stmt->close();
        if ($worked)
          return $idHash;
        else
          return -1;
      } else{
        $stmt->close();
        return -1;
      }
    }
    else{
      return -1;
    }
  }
  
  /* Check users existence
   * Returns:    False / True
   */
  function checkUser($user){
    if ($stmt = $this->con->prepare("SELECT user_id FROM Users WHERE user=?")) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      $stmt->bind_param("s", $user);

      $stmt->execute();

      $stmt->bind_result($exists);

      $stmt->fetch();

      $stmt->close();
      return(($exists != null));
    }
    return false;
  } 
  
  // Checks recovery table and returns the idhash if it exists
  // Returns:   null if no pwhash
  //            idhash if pwhash exists
  function checkPasswordRecHash($pwRecHash){
    if ($stmt = $this->con->prepare("SELECT idhash FROM Recovery WHERE recovery_hash=?;")) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      $stmt->bind_param("s", $pwRecHash);
      $stmt->execute();
      $stmt->bind_result($hashit);
      $stmt->fetch();
      $stmt->close();
      return($hashit);
    }
    return null;
  }
  
  
  // Changes user's password when passed the correct recovery hash
  // Returns:  0 if success
  //           1 otherwise
  function changePassword($pwRecHash, $newHash){
    // 2 parts
    
      $idHash = $this->checkPasswordRecHash($pwRecHash);
      if ($idHash == null)
        return false;
      if ($stmt = $this->con->prepare("DELETE FROM `Recovery` WHERE `recovery_hash`=? AND `idhash`=?;")) { // 1 -- Deletes Recovery hash
        /*   s - string, b - blob, i - int, etc */
        $stmt->bind_param("ss", $pwRecHash, $idHash);
      
        if ($stmt->execute()) {
          $worked = ($stmt->affected_rows > 0);
          $stmt->close();
          if (!($worked))
            return false;
        } else {
          $stmt->close();
          return false;
        }
        // Removes recovery handshake
        if ($stmt = $this->con->prepare("UPDATE Users SET `hash`=? WHERE `idhash`=? AND `activated`=1;")) { // 2 -- Updates password
          /* s - string, b - blob, i - int, etc */
          $stmt->bind_param("ss", $newHash, $idHash);
          if ($stmt->execute()) {
            $worked = ($stmt->affected_rows > 0);
            $stmt->close();
            if ($worked)
              return true;
            else
              return false;
          } else {
            $stmt->close();
            return false;
          } 
        } else {
          return false;
        } // End 2
      } else{
        return false;
      } // End 1
  }
  
  function passwordRecoveryGen($user, $email) {
    $valid = preg_match(USER_REGEX, $user) && filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$valid) {
      return null;
    }
    
    $idHash = $this->getIdHash($user, $email, 1, false);
    
    // Generate a unique id hash for this user
    $handshake = passwordToHash($idHash.$user.$email);
    
    if ($stmt = $this->con->prepare("INSERT INTO Recovery (idhash, recovery_hash) VALUES (?, ?);")) {
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      
      $stmt->bind_param("ss", $idHash, $handshake);

      /* execute query */
      if ($stmt->execute()) {
        $worked = ($stmt->affected_rows > 0);
        $stmt->close();
        if ($worked) {
          return $handshake;
        } else {
          return null;
        }
      } else {
        $stmt->close();
        return null;
      }
    }
    else{
      return null;
    }
    
  }
  
  /* Check if email is already used
   * Returns:    False / True
   */
  function checkEmail($email){
    if ($stmt = $this->con->prepare("SELECT user_id FROM Users WHERE email=?;")) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($exists);
      $stmt->fetch();
      $stmt->close();
      return(($exists != null));
    }
    return false;
  }
  
  // Checks whether an ID Hash exists.
  // Returns:    False / True
  function checkIdHash($idHash){
    if ($stmt = $this->con->prepare("SELECT user_id FROM Users WHERE idhash=? AND activated=1;")) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      $stmt->bind_param("s", $idHash);
      $stmt->execute();
      $stmt->bind_result($exists);
      $stmt->fetch();
      $stmt->close();
      return(($exists != null));
    }
    return false;
  }
  
  // Get user's ID Hash from username and email or just username
  // Pay attention to defaults!
  // Returns:    User's idhash
  function getIdHash($user, $email=null, $active=1, $admin=true){
    
    
    $query = "SELECT `idhash` FROM `Users` WHERE `user`=?";
    
    if (!$admin) // Ignore admin
      $query .= " AND admin <> 3"; 
    
    if ($email == null) // Search by user & email?
      $query .= " AND `activated`=?;";
    else
      $query .= " AND `email`=? AND `activated`=?;";
      
    if ($stmt = $this->con->prepare($query)) {
      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      if ($email == null)
        $stmt->bind_param("si", $user, $active);
      else
        $stmt->bind_param("ssi", $user, $email, $active);
      
      $stmt->execute();
      $stmt->bind_result($idHash);
      $stmt->fetch();
      $stmt->close();
      return($idHash);
    }
    return null;
  }
  
  
  /* Activates an account
   * Returns:   0 on success
   *           -1 on failure
   */
  function activateUser($idHash){
    
    if ($stmt = $this->con->prepare("UPDATE Users SET activated=1 WHERE idhash=?;")) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      $stmt->bind_param("s", $idHash);
      if ($stmt->execute()) {
        $worked = ($stmt->affected_rows > 0);
        $stmt->close();
        if ($worked)
          return 0;
        else
          return -1;
      } else{
        $stmt->close();
        return -1;
      }
    } else{
      return -1;
    }
  }
  
  /* Deletes user -- Needs to be worked on
     Returns:    0 on success
                 -1 on failure
                 -2 on unknown credentials
                 -3 on admin deletion attempt
  */
  function deleteUser($invoking_user, $tobedeleted_user){
    
    $idHash='';
    // Grabs user that is under the invoking user's idhash (parent_idhash matches in client)
    // Also checks that account is activated and that the user is not admin (by some fluke)
    if($stmt = $this->con->prepare("SELECT c.idhash FROM Users p INNER JOIN Users c ON c.parent_idhash = p.idhash WHERE p.user= ? AND c.admin<>3 AND c.activated=1 AND c.user= ?;")){
      $stmt->bind_param("ss", $invoking_user, $tobedeleted_user);
      $stmt->execute();
      $stmt->bind_result($idHash);
      $stmt->fetch();
      $stmt->close();
      
      // No user exists with that name & activated & not an admin
      if(!(strlen($idHash) > 0)){
        
        // Add logging mechanism + destroy session 
        header("Location: /team/php/logout.php");
        
        return -3;
      // We remove all instances of that user (it had other accounts under it). Then we delete that user.
      }else if($stmt = $this->con->prepare("UPDATE Users SET parent_idhash=NULL WHERE parent_idhash=?; DELETE FROM Users WHERE user=?;")){
          $stmt->bind_param("ss", $idHash, $tobedeleted_user);
          $stmt->execute();
          $stmt->close();
        }
      
     }
    
    return -1;
  }
  
  // Updates last login
  function lastLogin($user){
    
    if ($stmt = $this->con->prepare("UPDATE Users SET lastlogin=? WHERE user=?;")) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      date_default_timezone_set('US/Pacific');
      $currtime = date("Y-m-d H:i:s");
      $stmt->bind_param("ss", $currtime, $user);
      if ($stmt->execute()) {
        $worked = ($stmt->affected_rows > 0);
        $stmt->close();
        if ($worked)
          return 0;
        else
          return -1;
      } else{
        $stmt->close();
        return -1;
      }
    } else{
      return -1;
    }
  }
  
  /* Get user's profile
     Returns:    Single User object
  */
  function getProfile($user){
    // Get self
    if ($stmt = $this->con->prepare("SELECT user, email, idhash, created, lastlogin FROM Users WHERE user=?;")){
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $stmt->bind_result($name, $email, $id, $created, $last_login);
      $stmt->fetch();
      $stmt->close();
      
      $results = new User($name, $email, $id, $created, $last_login);
      return $results;
    }
    return 0;
  }
  
  // Gets an individual project if the user is a member of it
  function getProject($caller, $projId){
    return $this->getProjects($caller, $projId);
  }
  
  // Get user's projects
  // Returns:    User object lists with itself at index 0 inside project's array
  function getProjects($caller, $projId=null){
    // Grabs all projects associated with a user
    $query = "SELECT uu.user, uu.email, uu.idhash, uu.created, uu.lastlogin, p.name, p.project_idhash, p.owner=uu.user FROM Projects p INNER JOIN Project_Users u ON u.project_idhash = p.project_idhash INNER JOIN Users uu ON uu.user=u.user WHERE ? IN (SELECT user FROM Project_Users WHERE project_idhash=p.project_idhash) ORDER BY uu.user=? DESC;";
    if ($projId != null){
      $query = "SELECT uu.user, uu.email, uu.idhash, uu.created, uu.lastlogin, p.name, p.project_idhash, p.owner=uu.user FROM Projects p INNER JOIN Project_Users u ON u.project_idhash = p.project_idhash INNER JOIN Users uu ON uu.user=u.user WHERE p.project_idhash = ? AND ? IN (SELECT user FROM Project_Users WHERE project_idhash=p.project_idhash) ORDER BY uu.user=? DESC;";
    }
    
    $errQuery = "SELECT err.id, err.idhash, err.created, err.error, err.line, err.source, pu.user, err.user_idhash, err.project_idhash, err.severity, err.comment, err.resolved, err.resolved_comment, err.resolved_date, err.resolved_user, COUNT(*) FROM `Errors` err INNER JOIN Project_Users pu ON pu.user_idhash = err.user_idhash WHERE pu.project_idhash = err.project_idhash AND ? IN (SELECT user FROM Project_Users WHERE project_idhash=pu.project_idhash) GROUP BY err.line, err.error, err.source, err.user ORDER BY err.user=? DESC, err.created DESC;";
      
    if ($stmt = $this->con->prepare($query)){ // Project Users query
      if ($projId == null) {
        $stmt->bind_param("ss", $caller, $caller);
      } else {
        $stmt->bind_param("sss", $projId, $caller, $caller);
      }
      $stmt->execute();
      $stmt->bind_result($name, $email, $id, $created, $last_login, $proj_name, $proj_idhash, $proj_owner);
      
      // Projects array
      $results = array();
      while($stmt->fetch()){
        if(!array_key_exists($proj_idhash, $results)){
          $results[$proj_idhash] = new Project($proj_name, $proj_idhash);
        }

        $user_object = new User($name, $email, $id, $created, $last_login);
        $results[$proj_idhash]->addUser($user_object);
        if ($proj_owner){
          $results[$proj_idhash]->addOwner($user_object);
        }
      }
      $stmt->close();
    
      // This should be inside that if statement right
      if($stmt1 = $this->con->prepare($errQuery)){ // Error query
        $stmt1->bind_param("ss", $caller, $caller);
        $stmt1->execute();
        $stmt1->bind_result($errId, $errIdHash, $errCreated, $errName, $errLine, $errSource, $errUser, $errUserIdHash, $errProjIdHash,
                              $errSeverity, $errComment, $errResolved, $errResolvedComment, $errResolvedDate, $errResolvedUser, $errCount);
        while($stmt1->fetch()){
          // public function __construct($i, $count, $n, $cd, $sl, $l, $s, $c = NULL, $rc = NULL, $rd = NULL, $ru = NULL){
          $error_object = new Error($errId, $errCount, $errName, $errCreated, $errSeverity, $errLine, $errSource, $errComment,
                                    $errResolved, $errResolvedComment, $errResolvedDate, $errResolvedUser); 
          //echo "$errUser\n";
          if(!array_key_exists($errUserIdHash, $results[$errProjIdHash]->getUsers())){ // Method is always going to be GET since it's JS
            // TODO reminder: delete
            echo "DEBUG Something seriously wrong";
            return 0;
          }
          $results[$errProjIdHash]->getUsers()[$errUserIdHash]->addError($error_object);
        }
        return $results;
      }
    }
    return 0;
  }
  
  /* Checks whether a project_id (and owner_idhash) exist
   * Returns:    TRUE/FALSE
   */
  function checkProject($project_id, $ownerIdHash=null){
    $query = "SELECT id FROM Projects WHERE project_idhash=?";
    if ($ownerIdHash == null){
      $query .= ";";
    } else {
      $query .= " AND owner_idhash=?;";
    }
    if ($stmt = $this->con->prepare($query)) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      if ($ownerIdHash == null) {
        $stmt->bind_param("s", $project_id);
      } else {
        $stmt->bind_param("ss", $project_id, $ownerIdHash);
      }
      $stmt->execute();
      $stmt->bind_result($exists);
      $stmt->fetch();
      $stmt->close();
      return(($exists != null));
    }
    return false;
  }
  
  // Add User into Project -- Tested && working
  // Returns:      0 on success
  //              -1 on failure
  function addUserToProject($invitee_email, $project_id, $referrer_id){
    
    // Checks if referrer is owner && grabs invited user's name & idhash
    if($stmt = $this->con->prepare("SELECT p.owner_idhash=?, u.user, u.idhash FROM Projects p INNER JOIN Users u WHERE 
    p.project_idhash=? AND u.email=? AND u.activated=1;")){
      $stmt->bind_param("sss", $referrer_id, $project_id, $invitee_email);
      $stmt->execute();
      $stmt->bind_result($owner_check, $addUsername, $addUserIdHash);
      $stmt->fetch();
      $stmt->close();
      //echo "owner: $owner_check\tuserlookup: $addUsername  $addUserIdHash\n";
      if (!$owner_check)
        return -1; // Referer was not the owner
        
        // Inserts into projects -- New query avoids duplicate entries
        if($stmt = $this->con->prepare("INSERT INTO Project_Users (`project_idhash`, `user`, `user_idhash`) SELECT ?, ?, ? FROM Project_Users WHERE NOT EXISTS (SELECT id FROM Project_Users pu WHERE pu.project_idhash=? AND pu.user=? AND pu.user_idhash=?) LIMIT 1;")){
          $stmt->bind_param("ssssss", $project_id, $addUsername, $addUserIdHash, $project_id, $addUsername, $addUserIdHash);
          if ($stmt->execute()) { // add to make sure the statement executes
            $worked = ($stmt->affected_rows > 0);
            $stmt->close();
            if ($worked)
              return 0;
            else
              return -1;
          } else{
            $stmt->close();
            return -1;
          }
        } else {
          return -1;
        }
      } else {
      return -1;
    }
    
    return -1;
  }
  
  // Removes target_user from project -- Working
  // Returns:      0 on success
  //              -1 on failure
  function removeUserFromProject($caller_id, $target_user_id, $project_id){
    if($stmt = $this->con->prepare("DELETE pu.* FROM Project_Users pu INNER JOIN Projects p ON pu.project_idhash=p.project_idhash WHERE p.owner_idhash=? AND pu.user_idhash=? AND pu.project_idhash=?;")){
      $stmt->bind_param("sss", $caller_id, $target_user_id, $project_id);
      if ($stmt->execute()) {
        $worked = ($stmt->affected_rows > 0);
        $stmt->close();
        if ($worked)
          return 0;
        else
          return -1;
      } else{
        $stmt->close();
        return -1;
      }
    }
    return -1;
  }
  
  // Leave myself (non owner ONLY) from project -- Working
  // Returns:      0 on success
  //              -1 on failure
  function leaveProject($caller_id, $project_id){
    if($stmt = $this->con->prepare("DELETE pu.* FROM Project_Users pu INNER JOIN Projects p ON pu.project_idhash=p.project_idhash WHERE p.owner_idhash<>? AND pu.user_idhash=? AND pu.project_idhash=?;")){
      $stmt->bind_param("sss", $caller_id, $caller_id, $project_id);
      if ($stmt->execute()) {
        $worked = ($stmt->affected_rows > 0);
        $stmt->close();
        if ($worked)
          return 0;
        else
          return -1;
      } else{
        $stmt->close();
        return -1;
      }
    } else {
      return -1;
    }
  }
  
  // Creates new project. Requires user name, hash, and project name
  // Returns:   0 on success
  //            -1 or -2 on failure
  function createProject($name, $caller, $idHash){
       
    // Bad project name alphanumeric + spaces only
    if (!preg_match(NAME_REGEX, $name)){
      return -2;
    }
    if (!($this->checkIdHash($idHash))) {
      return -2;
    }
    if ($stmt = $this->con->prepare("INSERT INTO Projects (`project_idhash`, `owner`, `owner_idhash`, `name`) VALUES (?, ?, ?, ?);")) { // 0 -- Create project
      
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      $projHash = projHash($name.$caller);
      $stmt->bind_param("ssss", $projHash, $caller, $idHash, $name);

      /* execute query */
      if ($stmt->execute()) {
        $worked = ($stmt->affected_rows > 0);
        $stmt->close();
        if (!($worked))
          return -1;
      } else {
        $stmt->close();
        return -1;
      }
      
        if ($stmt = $this->con->prepare("INSERT INTO Project_Users(`project_idhash`, `user`, `user_idhash`) VALUES (?, ?, ?);")) { // 1 -- Add user to project
          /* execute query */
          $stmt->bind_param("sss", $projHash ,$caller, $idHash);
          if ($stmt->execute()) {
            $worked = ($stmt->affected_rows > 0);
            $stmt->close();
            if ($worked)
              return 0;
            else
              return -1;
          } else{
            $stmt->close();
            return -1;
          }
        } else {
          return -1;
        } // End 1
    } else {
      return -1;
    } // End 0
  }
  

  // Delete project -- Working
  // Returns:      0 on success
  //              -1 on failure
  function deleteProject($caller_id, $project_id){
    // Disband the project
    if($stmt = $this->con->prepare("DELETE pu.* FROM Project_Users pu INNER JOIN Projects p ON p.project_idhash=pu.project_idhash WHERE p.owner_idhash=? AND pu.project_idhash=?;")){
        $stmt->bind_param("ss", $caller_id, $project_id);
        if ($stmt->execute()) {
          $worked = ($stmt->affected_rows > 0);
          $stmt->close();
          if (!$worked)
            return -1;
        } else {
          $stmt->close();
          return -1;
        }
        // Delete project
        if($stmt = $this->con->prepare("DELETE p.*  FROM Projects p WHERE p.owner_idhash=? AND p.project_idhash=?;")){
          $stmt->bind_param("ss", $caller_id, $project_id);
          if ($stmt->execute()) {
            $worked = ($stmt->affected_rows > 0);
            $stmt->close();
            if ($worked)
              return 0;
            else
              return -1;
          } else {
            $stmt->close();
            return -1;
          }
        } else {
          return -1;
        }
    } else {
    return -1;
    }
  }
  
  // Adds errors to database
  // BE MINDFULL OF NULL VALUES!!
  function addError($error, $line, $source, $method="", $user="", $userIdHash="", $proj="", $severity=0){
    $error = filter_var($error, FILTER_SANITIZE_STRING);
    $line = filter_var($line, FILTER_SANITIZE_STRING);
    $source = filter_var($source, FILTER_SANITIZE_STRING);
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $user = filter_var($user, FILTER_SANITIZE_STRING);
    $proj = filter_var($proj, FILTER_SANITIZE_STRING);
    $severity = (int) $severity;
    $errorHash = projHash($error.$line.$src.$user.$proj);
    $methodN= strlen($method)>0?$method:NULL;
    $userN= NULL;
    $userIdN= strlen($userIdHash)>0?$userIdHash:NULL;
    $projN= strlen($proj)>0?$proj:NULL;
     if($stmt = $this->con->prepare("INSERT INTO Errors (`idhash`,`error`,`line`,`source`,`method`,`user`, `user_idhash`, `project_idhash`, `severity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);")){
      $stmt->bind_param("ssisssssi", $errorHash, $error, $line, $source, $methodN, $userN, $userIdN, $projN, $severity);
      if ($stmt->execute()) {
            $worked = ($stmt->affected_rows > 0);
            $stmt->close();
            if ($worked)
              return 0;
            else
              return -1;
       } else {
            $stmt->close();
            return -1;
      }
      return 0;
    }
    return -1;
  }
  function modifyError($errorIdHash, $callerIdHash, $comment, $severity){
    $comment = filter_var($comment, FILTER_SANITIZE_STRING);
    if($stmt = $this->con->prepare("UPDATE `Errors` err0 INNER JOIN `Errors` err1 ON err1.idhash = ? AND err1.user_idhash = ? SET err0.`comment` = ?, err0.`severity` = ? WHERE err0.`error` = err1.`error` AND err0.`line` = err1.`line` AND err0.`source` = err1.`source`;")){
          $stmt->bind_param("sssi", $errorIdHash, $callerIdHash, $comment, $severity);
          if ($stmt->execute()) {
            $worked = ($stmt->affected_rows > 0);
            $stmt->close();
            if ($worked)
              return 0;
            else
              return -1;
          } else {
            $stmt->close();
            return -1;
          }
        } else {
          return -1;
        }
    
  }
  
  function resolveError($errorIdHash, $caller, $comment = ""){
    
    // Don't forget to add date.
    $comment = filter_var($comment, FILTER_SANITIZE_STRING);
    date_default_timezone_set('US/Pacific');
    $currtime = date("Y-m-d H:i:s");
    if($stmt = $this->con->prepare("UPDATE `Errors` err0 INNER JOIN `Errors` err1 ON err1.idhash = ? SET err0.`resolved` = 1, err0.`resolved_comment` = ?, err0.`resolved_user` = ?, err0.`resolved_date` = ? WHERE err0.`error` = err1.`error` AND err0.`line` = err1.`line` AND err0.`source` = err1.`source` AND err0.`resolved` <> 1;")){
          $stmt->bind_param("ssss", $errorIdHash, $comment, $caller, $currtime);
          if ($stmt->execute()) {
            $worked = ($stmt->affected_rows > 0);
            $stmt->close();
            if ($worked)
              return 0;
            else
              return -1;
          } else {
            $stmt->close();
            return -1;
          }
        } else {
          return -1;
        }
    //UPDATE `Errors` err0 INNER JOIN `Errors` err1 ON err1.idhash = 'BfB9qYsPdmm.A' SET err0.`resolved` = 1, err0.`resolved_comment` = 'Testing Resolve', err0.`resolved_user` = 'theFuzz'  WHERE err0.`error` = err1.`error` AND err0.`line` = err1.`line` AND err0.`source` = err1.`source` AND err0.`resolved` <> 1;
  }
  
  function getProjectErrors($caller, $project = NULL) {
    // Get errors related to a project if the user belongs to the project.
    // Errors returned sorted with caller as first entries, and errors of the same type are grouped & counted. Errors sorted by time.
    
  }
  
  function getUserErrors($caller) {
    // Gets all errors belonging to a user (regardless of project). Errors of the same time are grouped (if they belong to the same project)
    // Sorted by time
    //SELECT err.*, COUNT(*) FROM `Errors` err WHERE err.user='theFuzz' GROUP BY err.line, err.error, err.source, err.project_idhash ORDER BY err.created DESC;
  }
  
  function queryUser($user){
    // Mother fucking prepared statements. Suck it SQL injection.
    //SELECT hash, admin FROM Users WHERE user=? and activated=1;
    if ($stmt = $this->con->prepare("SELECT u.hash, u.admin, u.idhash, CASE WHEN p.user = ? THEN 1 ELSE 0 END AS proj_member FROM Users u INNER JOIN Project_Users p WHERE u.user = ? AND activated=1 ORDER BY proj_member DESC LIMIT 1;")) {

      /* bind parameters for markers */
      /* Bind parameters
         s - string, b - blob, i - int, etc */
      $stmt->bind_param("ss", $user, $user);

      /* execute query */
      $stmt->execute();

      /* bind result variables */
      $stmt->bind_result($hash, $admin, $idhash, $proj_member);

      /* fetch value */
      $stmt->fetch();

      //printf("hash %s\n", $hash);

      /* close statement */
      $stmt->close();
      return array ($hash, $admin, $idhash);
    }
    return 0;
  }
  
  function close(){
    $this->connected = false;
    mysqli_close($this->con);
  }
}

?>