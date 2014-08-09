
<?php 
session_start();
if(isset($_POST['submit'])){
   
    $user = $_POST['user']; 
    $pw = $_POST['password'];
    
    /*
    if($user == "123@123.com" && $pw == "123"){ 
         //We're logged in
        
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = TRUE;
        header("Location: /team/team.php"); // Modify to go to the page you would like 
        exit; 
    */
        
    if($user == "admin")
    {
      if($pw == "admin")
      {
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = TRUE;
        $_SESSION['admin'] = TRUE;
        header("Location: /team/team.php"); // Modify to go to the page you would like 
        exit; 
      }
      /*
      elseif($pw == "R" || $pw == "RolandoIsAwesome")
      {
        //Someone's tests
        $_SESSION['user'] = "Best Guy";
        $_SESSION['logged'] = TRUE;
        header("Location: /team/debug.php");
        exit;
      }
      */
    }
    else{ 
        header("Location: /team/index.php"); 
        exit; 
    } 
}
?>