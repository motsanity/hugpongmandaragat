<?php
	include("database.php");
	
	$a = ["1", "26", "27", "28"];
	$b = implode($a, ',');
	echo $b; 
	$stmt = $conn->prepare("update users set zerobal_instance = (zerobal_instance + 1) where find_in_set(id, ?)");
	$stmt->bind_param("s", $b);
	$stmt->execute();
	
?>