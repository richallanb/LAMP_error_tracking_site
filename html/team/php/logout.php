<?php
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

  unset($_SESSION['logged']);
  unset($_SESSION['name']);
  unset($_SESSION['error']);

  if (isset($_SESSION['admin']))
     unset($_SESSION['admin']);
  header("Location: /"); 
  exit;
?>