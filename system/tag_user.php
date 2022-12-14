<?php
	include("database.php");	
	
	$encoder_id = $_GET["e"];
	$user_id = $_GET["id"];
	$action = $_GET["action"];
	
	if (in_array($action, [1, 2, 3])){ # ACTIVE, INACTIVE, DECEASED
		$sql = " status = " . $action;
	}
	else {
		if ($action == 4)
			$t_action = 3; # SET AS ADMIN
		else if ($action == 5)
			$t_action = 1; # SET AS ENCODER
		else if ($action == 6) # ANNUAL PAYMENT
			$t_action = 6;
		$sql = " privilege = " . $t_action;
	}
	if ($action != 6) {
		$stmt = $conn->prepare("UPDATE users set " . $sql . ", change_status_date = NOW() where id = ?");
		$stmt->bind_param("s", $user_id);
		$stmt->execute();
		$stmt->close();
	
		$log_string = "Tagged user as " . $action;
	}
	else {
		$stmt_mf = $conn->prepare("SELECT amt FROM fees where id = 3");
		$stmt_mf->bind_result($amt);
		$stmt_mf->execute();
		$stmt_mf->store_result();
		$stmt_mf->fetch();
		$stmt_mf->close();
		
		$date = date("Y-m-d h:i:s");
		
		$stmt_th = $conn->prepare("INSERT INTO annual_fees VALUES( NULL, ?, ?, ?, ?)");
		$stmt_th->bind_param("ssss", $user_id, $amt, $date, $encoder_id);
		$stmt_th->execute();
		$stmt_th->close();
		
		# LOG 
		$log_string = "Charging of annual fees";
		
	
		$stmt_th_r = $conn->prepare("SELECT r from transaction_history where user_id = ? order by date desc limit 1");
		$stmt_th_r->bind_param("s", $user_id);
		$stmt_th_r->execute();
		$stmt_th_r->store_result();
		$stmt_th_r->bind_result($r);
		if (!$stmt_th_r->fetch()){
			$r = 0;
		}
		$stmt_th_r->close();
	
		$r -= $amt;
	
		$credit = 0;
		$trans = 5;
		$remarks = null;
	
		$stmt_th = $conn->prepare("INSERT INTO transaction_history VALUES( NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt_th->bind_param("ssssssss", $date, $credit, $amt, $trans, $encoder_id, $user_id, $remarks, $r);
		$stmt_th->execute();
		$stmt_th->close();
	
		
	}
	include("insert_log.php");
	
	session_start();
	if ($action == 6)
		$message = "Annual fee successfully charged!";
	else 
		$message = "Tag successful!";
	$_SESSION['message'] = $message;
	$_SESSION['msg_type'] = "success";
	
	die(header("Location: users.php?r=reg_success")); 
	
?>
