<?
  // Validator for all (Projects) pj prefixed files

  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();
  require_once('header.php');

  // Checks for session
  if( isset($_SESSION['admin']) && isset($_SESSION['logged']) && $_SESSION['logged'] && isset($_SESSION['user'] && $_SESSION['user'] ){
    
    // Checks for POST validity
    if( !empty($_POST) && empty($_GET) && validatePost() ){
      
      // Connection is defined only here
      $connection = new mysqliInterface;
      $session_id = $connection->getIdHash($_SESSION['user']);
      
      // Sends corresponding idhash for one last check
      action($session_id);
    }
  }

  exit;
?>