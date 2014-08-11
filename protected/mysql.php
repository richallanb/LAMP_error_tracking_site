<?php
// Mysql credentials stored in php file outside of document root.
// Aka you assholes don't stand a chance.
require_once('secure.php');
class mysqliInterface {
  // Protected object inside an external class for more layering & obscurity
  protected $con;
  function __construct(){
    $this->con = mysqli_connect(mysqli_host, mysqli_user, mysqli_pw, mysqli_db, mysqli_port);
  }
  
  function queryUser($user){
    // Mother fucking prepared statements. Suck it SQL injection.
    if ($stmt = $this->con->prepare("SELECT hash, admin FROM Users WHERE user=?")) {

      /* bind parameters for markers */
      $stmt->bind_param("s", $user);

      /* execute query */
      $stmt->execute();

      /* bind result variables */
      $stmt->bind_result($hash, $admin);

      /* fetch value */
      $stmt->fetch();

      //printf("hash %s\n", $hash);

      /* close statement */
      $stmt->close();
      return array ($hash, $admin);
    }
    return 0;
  }
  
  function close(){
    mysqli_close($this->con);
  }
  
}

?>