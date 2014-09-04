<?php
  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();

  define('VALIDATE', false);

  include_once('../protected/pull.php');
  include_once("$_SERVER[DOCUMENT_ROOT]/jrrrs/errordetailv2.php");

  function main() {
    if( VALIDATE ) {
      if( isset($_SESSION['admin']) && $_SESSION['admin'] == 3 && isset($_SESSION['logged']) && $_SESSION['logged'] && isset($_SESSION['user']) && $_SESSION['user'] ){
        if( !action() ){
           return "Broke.";
        }
      }else{
        return "Blank?";
      }
    }else{
      action();
      return NULL;
    }
  }

  function action() {
    $Projects_list = getProjects();
    echo all_project_error_table($Projects_list);
    
   
  }

 /*
    $sample_date = "2014-08-31 03:54:14";
    
    $Errors = array();
    $Errors[] = new Error('9', 5, 'Uncaught Error', $sample_date, '3', '123', "www.teamnine.com", 'This is a test');
    $Errors[] = new Error('18', 12, 'Uncaught Syntax Error', $sample_date, '2', '9', "www.teamnine.com/admin", 'This is another test but with a very long string. Now, this is a story all about how
My life got flipped-turned upside down
And Id like to take a minute
Just sit right there
Ill tell you how I became the prince of a town called Bel Air');
    $Errors[] = new Error('19', 3, 'Uncaught WTF Error: wtf not defined and also long, like very long message', $sample_date, '1', '1076', "www.teamnine.com/admin/access");
    $Errors[] = new Error('99', 1, 'Resolved Error Demo', $sample_date, '1', '976', "www.teamnine.com/", 'WTF happened', 'Look guys! I completely owned this error.', $sample_date, 'rochwu');
    
    $errors_headers = error_table_header();
    $errors_details = NULL;
    foreach($Errors as $Error){
      $errors_details .= error_table_row($Error, "RTE");
    }
      
    echo <<< HTML
      <div>
        <div class="table-responsive">
          <table class="table" style="width=100%; table-layout:fixed">
            <thead>
              $errors_headers
            </thead>
            <tbody>
              $errors_details
            </tbody>
          </table>   
        </div>
      </div>
HTML;
    return TRUE;
    */
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Errores</title>
    
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/team/bootstrap/css/carousel.css" rel="stylesheet">
    <link href="/team/style.css" rel="stylesheet">
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
  </head>
  <body>
    
    <div class="container">
      <h1>Laboratorio</h1>
      
      <div class="jumbotron active tab-pane">
        <?php
          echo main();
        ?>
      </div>
      
    </div> 
    
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/team/bootstrap/js/bootstrap.min.js"></script>
    
  </body>
</html>