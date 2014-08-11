<?php
session_start();
	if (!isset($_SESSION['logged'])) {
		
		header("Location: /team");
		exit;
	}
	else if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
		header("Location: /team/dash");
		exit;
	}
phpinfo();
?>
