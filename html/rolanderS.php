<?php
  include('../protected/constants.php');
  include('../protected/objects.php');

  require_once('../protected/mysql.php');
  require_once('../protected/encrypt.php');

  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();

  static $level = -1;
  if( isset($_SESSION["admin"]) && isset($_SESSION["logged"]) && $_SESSION["logged"] ){
    $level = $_SESSION["admin"];
  }

  if($level != 3){
    header("Location: /");
  }

  $myCon = new mysqliInterface;
  $Projects = $myCon->getProjects($_SESSION['user']);

  function debug(){
    global $Projects;
    echo "Projects: " . sizeof($Projects) . "<br>";
    foreach($Projects as $Project){
      
      echo "Project Info<br>";
      echo "Name " . $Project->getName() . " # " . $Project->getIdHash() . "<br>";
      echo "Owner " . $Project->getOwner()->getName() . " # " . $Project->getOwner()->getIdHash() . "<br>";
      echo "Users: " . sizeof($Project->getUsers()) . "<br>";
      
      foreach($Project->getUsers() as $User){
        echo "Name " . $User->getName() . " # " . $User->getIdHash() . "<br>";
      }
      
      echo "<hr>";
    }
  }


  function test(){
    echo "Got POST of size " . sizeof($_POST) . "<br>";
    echo "Got GET of size " . sizeof($_GET) . "<br>";
    
    echo "<br>Prefix definitions:<br>";
    echo "R: Referral form<br>";
    echo "LPF: Leave Project Form<br>";
    echo "RPUF: Remove Project User Form<br>";
    echo "DPF: Delete Project Form<br>";
    
    echo "<br>Data dump<hr>";
    $it = 1;
    foreach($_POST as $key => $value) {
      echo $it . ": " . $key . " => " . $value . "<br>";
      $it++;
    }
  }
?>

<!DOCTYPE>
<html>
  <head>
    <h1>BRIDGE</h1>
  </head>
  <body>
    
    <div>
      
      <?php
        //debug()
        test();
      ?>
      
      <table class="table table-striped" style="width:50%">
        <thead>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    
  </body>
</html>