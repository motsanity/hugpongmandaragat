<?php
	$has_attachments = false;
	$user_name = $_GET["view"];
	$stmt = $conn->prepare("SELECT * from folder where user_name = ?");
	$stmt->bind_param("s", $user_name);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	if ($result->num_rows > 0){
	 $has_attachments = true;
	}
	
	$stmt->free_result();
	$stmt->close();
?>