<?php

	include("database.php");
	
	$stmt = $conn->prepare("SELECT amt as value from fees where id = ? ");
	$stmt->bind_param("s", $_REQUEST["fee"]);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($fee_value);
	$stmt->fetch();
	
	echo $fee_value;
	$stmt->close();
	
?>