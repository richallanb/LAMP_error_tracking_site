<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>403!</title>

    <!-- Bootstrap core CSS -->
    <link href="/team/bootstrap/css/style.min.css" rel="stylesheet">
  
  </head>

  <body>
    
    <script>
    </script>
    
    <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar_light.html"); ?>
    
    <div class="container container-padded">
    
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>
          Error 403... Thanks Obama!
        </h1>
        <p class="lead">
          Nice try NSA. You're trying to access a restricted page, 
          <a href="javascript:history.back()">make a U-turn</a> 
          and go the other way!
        </p>       
      </div>
         
      <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/footer.html"); ?>
    </div> <!-- /container -->
  </body>
</html>