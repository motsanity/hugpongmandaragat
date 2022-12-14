<?php

	if ($mode){
		$limit = 10;
		$stmt = $conn->prepare("SELECT count(id) as count FROM transaction_history where user_id = ?");
		$stmt->bind_param("s", $user_id);
	}
	else{
		$limit = 15;
		$stmt = $conn->prepare("SELECT count(id) as count FROM finances_view_general");
	}
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	$total_records = $count;  
	$total_pages = $total_records > 0 ? ceil($total_records / $limit) : 0; 
	
?>