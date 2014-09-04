<?php
  // Pulls user projects data

  // Includes
  require_once('objects.php');
  require_once('mysql.php');
  require_once('encrypt.php');

  // Must be logged to pull data
  if( !isset($_SESSION["admin"]) || !isset($_SESSION["logged"]) || !$_SESSION["logged"]){
    return NULL;
  }

  // Connects to DB + get User object array
  $connection = new mysqliInterface;

  function getProjects(){
    global $connection;
    return $connection->getProjects($_SESSION['user']);
  }

  function getProfile(){
    global $connection;
    return $connection->getProfile($_SESSION['user']);
  }
?>