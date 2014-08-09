<?php
require_once('../../../protected/secure.php');
class mysqliInterface {
  protected $con;
  function __construct(){
    $this->con = mysqli_connect(mysqli_host, mysqli_user, mysqli_pw, mysqli_db, mysqli_port);
  }
  
  function queryUser($user){
    if ($stmt = $this->con->prepare("SELECT hash FROM Users WHERE user=?")) {

      /* bind parameters for markers */
      $stmt->bind_param("s", $user);

      /* execute query */
      $stmt->execute();

      /* bind result variables */
      $stmt->bind_result($hash);

      /* fetch value */
      $stmt->fetch();

      //printf("hash %s\n", $hash);

      /* close statement */
      $stmt->close();
      return $hash;
    }
    return 0;
  }
  
  function close(){
    mysqli_close($this->con);
  }
  
}

?>