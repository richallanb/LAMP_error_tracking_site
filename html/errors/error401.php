<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>401.</title>

    <!-- Bootstrap core CSS -->
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/team/style.css" rel="stylesheet">
  
  </head>

  <body>
    
    <script>
    </script>
    
    <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar_light.html"); ?>
    
    <div class="container container-padded">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>
          Error 401... Thanks Obama!
        </h1>
        <p class="lead">
          You shouldn't even be here. Go <a href="javascript:history.back()">back</a>. 
          <!--
          <a href="../">here</a>  
          -->
              </p>
      </div>
         
      <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/footer.html"); ?>
    </div> <!-- /container -->
  </body>
</html>