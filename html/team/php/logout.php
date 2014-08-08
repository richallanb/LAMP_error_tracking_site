<?php
  session_start();
  unset($_SESSION["logged"]);
  unset($_SESSION["name"]);
  if (isset($_SESSION["admin"]))
     unset($_SESSION["admin"]);
  header("Location: ../index.php"); 
  exit;
?>