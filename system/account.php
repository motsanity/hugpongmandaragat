<?php
	 $stmt = $conn->prepare("SELECT * from users where id = " . $_SESSION['id']);
	 $stmt->execute();
	 $result = $stmt->get_result();
	 $row_account = $result->fetch_assoc();
	 
	 $stmt->free_result();
	 $stmt->close();
?>