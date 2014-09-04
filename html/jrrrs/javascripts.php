<?php
require_once('../../protected/constants.php');
if ($level >= USER){
  $vars = <<< HTML
    <script>
      
      TeamNineLoggedUserId = "$userIdHash"; 
    </script>
HTML;
  echo '<script src="/team/js/userscripts.min.js"></script>';
  echo $vars;
}
?>