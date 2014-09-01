<?php
require_once('../../protected/constants.php');
if ($level >= USER){
  $vars = <<< HTML
    <script>
      TeamNineLoggedUser = "{$_SESSION['user']}"; 
    </script>
HTML;
  echo '<script src="/team/js/userscripts.js"></script>';
  echo $vars;
}
?>