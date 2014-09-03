<?php
  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();

  function main() {
    if( isset($_SESSION['admin']) && $_SESSION['admin'] == 3 && isset($_SESSION['logged']) && $_SESSION['logged'] && isset($_SESSION['user']) && $_SESSION['user'] ){
      if( !action() ){
         return "Broke.";
      }
    }else{
      return "Blank?";
    }
  }

  function action() {
    require_once('../protected/mysql.php');
    require_once("$_SERVER[DOCUMENT_ROOT]/jrrrs/errordetailv2.php");
    
    $sample_date = "2014-08-31 03:54:14";
    
    $Errors = array();
    $Errors[] = new Error('9', 'Some Error', $sample_date, '3', '123', "www.teamnine.com", 'GET', 'This is a test');
    $Errors[] = new Error('18', 'Second Error', $sample_date, '2', '9', "www.teamnine.com/admin", 'GET', 'This is another test');
    $Errors[] = new Error('19', 'One more Error', $sample_date, '1', '1076', "www.teamnine.com/admin/access", 'POST');
    
    $errors_headers = error_table_header();
    $errors_details = NULL;
    foreach($Errors as $Error){
      $errors_details .= error_table_row($Error, "RTE");
    }
      
    echo <<< HTML
      <div>
        <div class="table-responsive">
          <table class="table" style="width=100%">
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
  }
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
      
      <div class="jumbotron">
        <?php
          echo main();
        ?>
      </div>
    </div>
    
  </body>
</html>