<?php

	session_start();
	include ('database.php');
	include ('general.php');
	protect_page();
	$_SESSION['id'];
	$_SESSION['privilege'];
	$_SESSION['user_name'];
	
?>