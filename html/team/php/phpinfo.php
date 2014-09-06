<?php
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();
	if (!isset($_SESSION['logged'])) {
		
		header("Location: /");
		exit;
	}
	else if (!isset($_SESSION['admin']) || ($_SESSION['admin'] != 3) || ($_SESSION['admin'] != 2)) {
		header("Location: /");
		exit;
	}
phpinfo();
?>
