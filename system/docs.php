<?php
	$has_attachments = false;
	$d_user_name = $_SESSION["user_name"];
	$stmt = $conn->prepare("SELECT * from folder where user_name = ?");
	$stmt->bind_param("s", $d_user_name);
	$stmt->execute();
	$result = $stmt->get_result();
	$row_docs = $result->fetch_assoc();

	if ($result->num_rows > 0){
	 $has_attachments = true;
	}
	
	$stmt->free_result();
	$stmt->close();
?>