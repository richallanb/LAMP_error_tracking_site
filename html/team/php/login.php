
<?php 
if(isset($_POST['submit'])){
   
    $user = $_POST['user']; 
    $pw = $_POST['password']; 
    if($user == "123@123.com" && $pw == "123"){ 
         //We're logged in
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = TRUE;
        header("Location: team.php"); // Modify to go to the page you would like 
        exit; 
    }else{ 
        header("Location: ../index.html"); 
        exit; 
    } 
}else{    //If the form button wasn't submitted go to the index page, or login page 
    header("Location: ../index.html");     
    exit; 
} 
?>