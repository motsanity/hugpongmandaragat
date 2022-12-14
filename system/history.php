<?php
	
	
	$sql = "SELECT * from history";
	$result = $conn->query($sql);
	
	while ($r = $result->fetch_assoc()){
		
		$huser = $r['user_id'];
		$hencoder = $r['encoder_id'];
		$hamt = $r['amt'];
		$hdate = $r['date'];
		
	}
	
	
	
?>