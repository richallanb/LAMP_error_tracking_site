<?php
  if( isset($_SESSION['error']) && $_SESSION['error'] == TRUE ){
    $body = <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <p style="text-align:center"><strong>Huh!?</strong> Bad username or password!</p>
      </div>    
HTML;
    // Resets session error, less spammy
    unset($_SESSION['error']);
    echo $body;
  }
?>