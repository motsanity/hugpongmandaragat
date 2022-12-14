<?php

	$sn = "localhost";
	$un = "hugpongm_root";
	$db = "hugpongm_hm_sys";
	
	$conn = mysqli_connect($sn, $un, "28Nov.2019", $db);
	
	if ($conn->connect_error)
		die ("Connection failed.");
	


	
?>