<?php
//if logged in, go to manager page
	session_start();
	if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
		// header("Location: ./dashboard.php");
	}else{
		header('Location: ./login.php');
	}
?>