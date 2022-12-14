<?php
	include("database.php");
	$classification = [];
	
	$stmt = $conn->prepare("SELECT * from fees");
	$stmt->execute();
	$result_c = $stmt->get_result();
	
	while ($r = $result_c->fetch_assoc()){
		$classification[] = [
			"value" => $r["value"],
			"description" => $r["description"],
		];
	}
	$stmt->close();
	
?>