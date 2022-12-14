<?php

	include("database.php");
	$mode = true;
	if (isset($_GET["mode"]))
		$mode = $_GET["mode"];
	
	if ($mode == "true"){
		$stmt = $conn->prepare("SELECT id as id from users where user_name = ? and status = 1 and privilege = 2"); # GET CLAIMANT
		$stmt->bind_param("s", $_REQUEST["id"]);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($user_id_claimant);
		
		if ($stmt->fetch()) {
			$stmt_c = $conn->prepare("SELECT amt as value from claim_classification where id = ? ");
			$stmt_c->bind_param("s", $_REQUEST["class"]);
			$stmt_c->execute();
			$stmt_c->store_result();
			$stmt_c->bind_result($claim_value);
			$stmt_c->fetch();
			$stmt_c->close();
		
			$user_id_deduct = [];
			$user_id_zerobal = [];
			
			$stmt_u = $conn->prepare("SELECT user_id, r from user_balance_view WHERE user_id != ? and status = 1 and privilege = 2"); # ACTIVE MEMBERS ONLY
			$stmt_u->bind_param("s", $user_id_claimant);
			$stmt_u->execute();
			$stmt_u->store_result();
			$stmt_u->bind_result($id, $r);
			while ($stmt_u->fetch()){
				if ($r < $claim_value){
					$user_id_zerobal[] = $id;
				}
				else {
					$user_id_deduct[] = $id;
				}
			
			}
	
			session_start();
			$_SESSION["user_id_deduct"] = $user_id_deduct;
			$_SESSION["user_id_zerobal"] = $user_id_zerobal;
			$entitled_claim = $claim_value * count($user_id_deduct);
			if ($entitled_claim != 0)
				echo number_format($entitled_claim, 2, ".", "");
			else 
				echo "y";
			$stmt_u->close();
		
		}
		
		else {
			echo "x";
		}
		
	}
	else {
		$stmt = $conn->prepare("SELECT amt as value from claim_classification where id = ? ");
		$stmt->bind_param("s", $_REQUEST["class"]);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($claim_value);
		$stmt->fetch();
		
		echo $claim_value;
		
	}
	
	$stmt->close();
	
?>