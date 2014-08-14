
<?php 
require_once('../../../protected/mysql.php');
require_once('../../../protected/encrypt.php');
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

if(isset($_POST['submit'])){
  
    $user = $_POST['user']; 
    $pw = $_POST['password'];

    $myCon = new mysqliInterface;
    list($servHash, $admin) = $myCon->queryUser($user);
    
    $myCon->close();
   
    
        
    if (checkPasswordAgainstHash($pw, $servHash) && verifyFormToken("signin")) {
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

function verifyFormToken($form) {
    
    // check if a session is started and a token is transmitted, if not return an error
	if(!isset($_SESSION[$form.'_token'])) { 
		return false;
    }
	
	// check if the form is sent with token in it
	if(!isset($_POST['token'])) {
		return false;
    }
	
	// compare the tokens against each other if they are still the same
	if ($_SESSION[$form.'_token'] !== $_POST['token']) {
		return false;
    }
	
	return true;
}
?>