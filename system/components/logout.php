<?php
	include("../database.php");	
	$user_id = $_REQUEST["id"];
	$encoder_id = 0;
	$log_string = "Logged out of system";
	$date = date("Y-m-d H:i:s");
	include("../insert_log.php");

	session_start();
	session_destroy();
	
	die(header("Location: ../login.php"));
?>