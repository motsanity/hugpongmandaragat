<?php	
	$stmt_l = $conn->prepare("INSERT INTO user_log VALUES(NULL, ?, ?, ?, ?)");
	$stmt_l->bind_param("ssss", $date, $log_string, $encoder_id, $user_id);
	$stmt_l->execute();

?>