<?php
	include("database.php");
	
	$stmt_c = $conn->prepare("SELECT amt as value from claim_classification where id = ? ");
	$stmt_c->bind_param("s", $class);
	$stmt_c->execute();
	$stmt_c->store_result();
	$stmt_c->bind_result($claim_value);
	$stmt_c->fetch();
	$stmt_c->close();
	
	$stmt_d = $conn->prepare("INSERT INTO deductions VALUES(NULL, ?, ?, ?, ?, ?)");
	$stmt_d->bind_param("sssss", $date, $encoder_id, $d_id, $class, $claim_value);
	
	for ($i = 0; $i < count($_SESSION["user_id_deduct"]); $i++){
		$date = date("Y-m-d H:i:s");
		$d_id = $_SESSION["user_id_deduct"][$i];
		$stmt_d->execute();
		
		# date, credit, debit, trans, encoder, user
		postSubmit($date, 0, $claim_value, 4, $encoder_id, $d_id, $class);
		
	}
	
	$b = implode($_SESSION["user_id_zerobal"], ",");
	$stmt_z = $conn->prepare("update users set zerobal_instance = (zerobal_instance + 1) where find_in_set(id, ?)");
	$stmt_z->bind_param("s", $b);
	$stmt_z->execute();
	
	$b = implode($_SESSION["user_id_deduct"], ",");
	$stmt_z = $conn->prepare("update users set zerobal_instance = 0 where find_in_set(id, ?) and zerobal_instance != 0");
	$stmt_z->bind_param("s", $b);
	$stmt_z->execute();
	
	
	$stmt_d->close();
	
	
	
?>