<?php
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

  /*unset($_SESSION['logged']);
  unset($_SESSION['user']);
  unset($_SESSION['idhash']);

  if (isset($_SESSION['admin']))
     unset($_SESSION['admin']);*/
  session_unset();
  session_destroy();
  header("Location: /"); 
  exit;
?>