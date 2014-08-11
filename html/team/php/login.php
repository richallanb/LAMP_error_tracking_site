
<?php 
require_once('mysql.php');
require_once('encrypt.php');
session_start();
if(isset($_POST['submit'])){
  
    $user = $_POST['user']; 
    $pw = $_POST['password'];
  
    $myCon = new mysqliInterface;
    list($servHash, $admin) = $myCon->queryUser($user);
    
    $myCon->close();
   
    
        
    if (checkPasswordAgainstHash($pw, $servHash)) {
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = TRUE;
        $_SESSION['admin'] = $admin;
       
        header("Location: /team/dash"); // Modify to go to the page you would like 
        exit; 
      
    }
    else{ 
        header("Location: /"); 
        exit; 
    } 
}
?>