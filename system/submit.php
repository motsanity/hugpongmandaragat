<?php
	
	session_start();
	include("database.php");
	$date = date("Y");
	

	if (isset($_POST['userlogin_submit'])){	//LOGIN	using username
		$user_name = $_POST['user_name'];
		$password = md5($_POST['password']);
		
		$sql = "SELECT * from users WHERE (email = ? OR user_name = ?) AND password= ?";
		
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("sss", $user_name, $user_name, $password);
		$stmt->execute();
		$result = $stmt->get_result(); 
		$stmt->close();
		if($result->num_rows > 0){
		
			$r = $result->fetch_assoc();
		
			session_start();
		
			$_SESSION['id'] = $r['id'];
			$_SESSION['privilege'] = $r['privilege'];
			$_SESSION['user_name'] = $r['user_name'];
			
			unset($_SESSION["message"]);
			
			# LOG 
			$encoder_id = 0;
			$user_id = $_SESSION["id"];
			$log_string = "Logged in to system";
			$date = date("Y-m-d H:i:s");
			include("insert_log.php");
			
			die(header("Location: index.php"));
			
		}
		else {
			session_start();
			$_SESSION['message'] = "Incorrect username or password. Try again.";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: login.php?r=log_failed"));
		}
	}
	
	if (isset($_POST['login_submit'])){	//LOGIN	using email

		$email = $_POST['email'];
		$password = md5($_POST['password']);
		
		$sql = "SELECT * from users WHERE (email = ? OR user_name = ?) AND password= ?";
		
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("sss", $email, $email, $password);
		$stmt->execute();
		$result = $stmt->get_result(); 
		$stmt->close();
		if($result->num_rows > 0){
		
			$r = $result->fetch_assoc();
		
			session_start();
		
			$_SESSION['id'] = $r['id'];
			$_SESSION['privilege'] = $r['privilege'];
			$_SESSION['user_name'] = $r['user_name'];
			
			unset($_SESSION["message"]);
			
			# LOG 
			$encoder_id = 0;
			$user_id = $_SESSION["id"];
			$log_string = "Logged in to system";
			$date = date("Y-m-d H:i:s");
			include("insert_log.php");
			
			die(header("Location: index.php"));
		}
		else {
			session_start();
			$_SESSION['message'] = "Incorrect email or password. Try again.";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: login.php?view=1"));
		}
	}
	
	if(isset($_POST['updateaf_submit'])){   //UPDATE AF
		
		$user_name = $_POST['user_name'];
		
		$sql = "SELECT * from folder WHERE user_name = '{$user_name}'";
		$result = $conn->query($sql);
		if($r = $result->fetch_assoc()){
			
			$folderpath = $r['folderpath'];
			
			for($i=0; $i<count($_FILES["appform"]["name"]);$i++)//Application form
					{
		               $appform_tmp = $_FILES["appform"]["tmp_name"][$i];
					   $appform_name = $_FILES["appform"]["name"][$i];
					   $appform_type = $_FILES["appform"]["type"][$i];
					   $appform_path = "{$folderpath}/".$appform_name;
			   
					   move_uploaded_file($appform_tmp, $appform_path);	
					}

			$fusql = "UPDATE folder SET appform_path = '{$appform_path}' WHERE user_name = '{$user_name}'";
			$conn->query($fusql);
			
			$_SESSION['message'] = "Successfully updated '{$user_name}'";
			$_SESSION['msg_type'] = "success";
			
			# LOG 
			
			$sql = "SELECT id from users where user_name = '{$user_name}'";
			$res = $conn->query($sql);
			if ($r = $res->fetch_assoc())
				$user_id = $r["id"];

			$date = date("Y-m-d H:i:s");
			$encoder_id = $_POST["encoder_id"];
			$log_string = "Updating of member documents (Application form)";
			include("insert_log.php");
			
			die(header("Location: update_appform.php")); 
		
		}
		else {
			$_SESSION['message'] = "User'{$user_name}' doesn't exist!";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: update_appform.php")); 
			
		}
	}
	
	
	if(isset($_POST['updatepb_submit'])){   //UPDATE PB
		
		$user_name = $_POST['user_name'];
		
		$sql = "SELECT * from folder WHERE user_name = '{$user_name}'";
		$result = $conn->query($sql);
		if($r = $result->fetch_assoc()){
			
			$folderpath = $r['folderpath'];
			
			for($i=0; $i<count($_FILES["passport"]["name"]);$i++)//passport
			{
			   $passport_tmp = $_FILES["passport"]["tmp_name"][$i];
			   $passport_name = $_FILES["passport"]["name"][$i];
			   $passport_type = $_FILES["passport"]["type"][$i];
			   $passport_path = "{$folderpath}/".$passport_name;
			   
			   move_uploaded_file($passport_tmp, $passport_path);
			}
					
			for($i=0; $i<count($_FILES["sbook"]["name"]);$i++)//Seaman's book
			{

			   $sbook_tmp = $_FILES["sbook"]["tmp_name"][$i];
			   $sbook_name = $_FILES["sbook"]["name"][$i];
			   $sbook_type = $_FILES["sbook"]["type"][$i];
			   $sbook_path = "{$folderpath}/".$sbook_name;
			   
			   move_uploaded_file($sbook_tmp, $sbook_path);
			}
			
			$fusql = "UPDATE folder SET passport_path = '{$passport_path}',sbook_path = '{$sbook_path}' WHERE user_name = '{$user_name}'";
			$conn->query($fusql);
			
			$_SESSION['message'] = "Successfully updated '{$user_name}'";
			$_SESSION['msg_type'] = "success";
			
			# LOG 
			
			$sql = "SELECT id from users where user_name = '{$user_name}'";
			$res = $conn->query($sql);
			if ($r = $res->fetch_assoc())
				$user_id = $r["id"];

			$date = date("Y-m-d H:i:s");
			$encoder_id = $_POST["encoder_id"];
			$log_string = "Updating of member documents (Passport / Seaman's book)";
			include("insert_log.php");
			
			die(header("Location: update_files.php?r=reg_success")); 
		
		}
		else {
			$_SESSION['message'] = "User'{$user_name}' doesn't exist!";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: update_files.php?r=failed")); 
			
		}
	}
	
	if(isset($_POST['updatenm_submit'])){   //UPDATE PB
		
		$user_name = $_POST['user_name'];
		
		$sql = "SELECT * from folder WHERE user_name = '{$user_name}'";
		$result = $conn->query($sql);
		if($r = $result->fetch_assoc()){
			
			$folderpath = $r['folderpath'];
			
			for($i=0; $i<count($_FILES["nso"]["name"]);$i++)//NSO
					{
		               $nso_tmp = $_FILES["nso"]["tmp_name"][$i];
					   $nso_name = $_FILES["nso"]["name"][$i];
					   $nso_type = $_FILES["nso"]["type"][$i];
					   $nso_path = "{$folderpath}/".$nso_name;
			   
					   move_uploaded_file($nso_tmp, $nso_path);	
					}
			
			for($i=0; $i<count($_FILES["mc"]["name"]);$i++)//married contract
					{
		               $mc_tmp = $_FILES["mc"]["tmp_name"][$i];
					   $mc_name = $_FILES["mc"]["name"][$i];
					   $mc_type = $_FILES["mc"]["type"][$i];
					   $mc_path = "{$folderpath}/".$mc_name;
			   
					   move_uploaded_file($mc_tmp, $mc_path);
					}
			
			$fusql = "UPDATE folder SET nso_path = '{$nso_path}',mc_path = '{$mc_path}' WHERE user_name = '{$user_name}'";
			$conn->query($fusql);
			
			$_SESSION['message'] = "Successfully updated '{$user_name}'";
			$_SESSION['msg_type'] = "success";
			
			# LOG 
			
			$sql = "SELECT id from users where user_name = '{$user_name}'";
			$res = $conn->query($sql);
			if ($r = $res->fetch_assoc())
				$user_id = $r["id"];

			$date = date("Y-m-d H:i:s");
			$encoder_id = $_POST["encoder_id"];
			$log_string = "Updating of member documents (NSO Birth Cert./ M. Contract)";
			include("insert_log.php");
			
			die(header("Location: update_files.php?view=1")); 
		
		}
		else {
			$_SESSION['message'] = "User'{$user_name}' doesn't exist!";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: update_files.php?r=failed")); 
			
		}
	}	
	
	if(isset($_POST['update_submit'])){  //update profile picture
	
		$user_id = $_POST['sid'];
		
		for($i=0; $i<count($_FILES["pp"]["name"]);$i++) //update profile picture
		{
			
			$sql = "SELECT * FROM  users WHERE id = '{$user_id}'";
			$result = $conn->query($sql);
			while($r = $result->fetch_assoc()){
				$folderpath = $r['folderpath'];
			}

		   $pp_tmp = $_FILES["pp"]["tmp_name"][$i];
		   $pp_name = $_FILES["pp"]["name"][$i];
		   $pp_type = $_FILES["pp"]["type"][$i];
		   $pp_path = "{$folderpath}/".$pp_name;
		   
		   move_uploaded_file($pp_tmp, $pp_path);
		}
		$upsql = "UPDATE users SET img_path ='{$pp_path}' WHERE id = $user_id";
		
		if ($conn->query($upsql)){
		
			$_SESSION['message'] = "Profile has been updated!";
			$_SESSION['msg_type'] = "success";
			
			# LOG
			$date = date("Y-m-d H:i:s"); 
			$encoder_id = 0;
			$log_string = "Updating of profile picture";
			include("insert_log.php");
			
			die(header("Location: update_profile.php?r=reg_success"));
		}
		else {
			$_SESSION['message'] = "Profile is not updated";
			$_SESSION['msg_type'] = "warning";
			die(header("Location: update_profile.php?r=failed")); 
		}
	}
	
	if (isset($_POST["import"])) {
    
		$fileName = $_FILES["file"]["tmp_name"];
		$encoder_id = $_POST['sid'];
		
		if ($_FILES["file"]["size"] > 0) {
			
			$file = fopen($fileName, "r");
			$flag = true;
			while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
				if($flag) { $flag = false; continue; }
				$sql = "INSERT INTO annual_fees VALUES (NULL,'{$column[0]}','{$column[1]}','{$column[2]}','{$encoder_id}')";
				$result=$conn->query($sql);
				
				$date = date("Y-m-d H:i:s"); 
				$encoder_id = $_POST['sid'];
				$user_id = $column[0];
				$log_string = "Posting of annual fee payment, {$column[1]}";
				include("insert_log.php");
	
			}
				if (! empty($result)) {
					$_SESSION['message'] = "CSV file uploaded successfully!";
					$_SESSION['msg_type'] = "success";

					

					die(header("Location: import.php")); 
				} 
				
				else {
		
					$_SESSION['message'] = "Error!";
					$_SESSION['msg_type'] = "warning";
					die(header("Location: import.php")); 
				}
			
		}
	}
	
	if(isset($_POST['export'])){
		
		header('Content-Type: text/csv; chartset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		$sql = "SELECT * FROM `annual_fees`";

		$result = $conn->query($sql);
		$output = fopen("php://output","w");
		fputcsv($output, array('user_id','amt','date'));

		while($r = $result->fetch_assoc()){

			fputcsv($output, array($r['user_id'] , $r['amt'], $r['date'] ));
		}
		fclose($output);
	}
	
	if(isset($_POST['changepw_submit'])){
		
		$user_id = $_POST['sid'];
		$password = md5($_POST['password']);

		$sql = "SELECT * from users WHERE id = '{$user_id}'";
		$result = $conn->query($sql);

		if($r = $result->fetch_assoc()){

			$dpassword = $r['password'];

			if($password == $dpassword){

			
				$new_password = $_POST['new_password'];
				$repassword = $_POST['repassword'];

				if($new_password == $repassword){

					$hashed_password = md5($new_password);

					$usql = "UPDATE users SET password = '{$hashed_password}'WHERE id = '{$user_id}'";
					$conn->query($usql);

					$_SESSION['message'] = "Changed Password Success!";
					$_SESSION['msg_type'] = "success";

					# LOG 
					$encoder_id = 0;
					$log_string = "Changing of Password";
					include("insert_log.php");

					die(header("Location: update_profile.php?view=1")); 
				}

				else{
					$_SESSION['message'] = "Re-type Password did not match!";
					$_SESSION['msg_type'] = "warning";
					die(header("Location: update_profile.php?view=1")); 
				}
			}
			else{

				$_SESSION['message'] = "Password did not match!";
				$_SESSION['msg_type'] = "warning";
				die(header("Location: update_profile.php?view=1"));
			}
					
		}

		else{

			$_SESSION['message'] = "Password did not match!";
			$_SESSION['msg_type'] = "warning";
			die(header("Location: update_profile.php?view=1"));
		}

	}
	if(isset($_POST['reset_submit'])){
		
		$encoder_id = $_POST['encoder_id'];
		$user_name = $_POST['user_name'];
		
		$sql = "SELECT * from users WHERE user_name = '{$user_name}'";
		
		$result = $conn -> query($sql);
		
		if($r = $result->fetch_assoc()){
			
			$birthday = md5($r['date_of_birth']);

			$rsql = "UPDATE users SET password = '{$birthday}' WHERE user_name = '{$user_name}'" ;
			$conn->query($rsql);
			
			$_SESSION['message'] = "Password Reset Successfully";
			$_SESSION['msg_type'] = "success";
			
			die(header("Location: reset_password.php"));
		}
		
		else{
			$_SESSION['message'] = "User does not exist!";
			$_SESSION['msg_type'] = "danger";
			
			die(header("Location: reset_password.php"));
		}
		

	}
	
	if(isset($_POST['form_submit'])){ //REGISTRATION FOR MEMBERS
		
		$sql = "SELECT MAX(id) AS max FROM users";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$r = $result->fetch_assoc();
			
			$current_id = $r['max'] + 1;
    		$amax = sprintf("%08d", $current_id); //applied zeros from left
    		
    		$user_name = "{$date}-{$amax}";
    		$password = $_POST['password'];
    		$phone = $_POST["phone"];
    		
    		if ($password == $_POST['repassword']){ # IF PASSWORDS HAVE MATCHED
				$sql = "SELECT phone from users WHERE phone = '{$phone}'";
				$result = $conn->query($sql);

				$hashed_password = md5($password);

				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$middle_name = $_POST['middle_name'];
				$suffix = $_POST['suffix'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$date_of_birth = $_POST['date_of_birth'];
				$privilege = $_POST['privilege'];
				$rank = "CE";
				$folderpath = "folder/{$first_name}_{$last_name}";
				$status = 1;
				$zerobal_instance = 0;
			
				if ($r = $result->fetch_assoc()){ # IF PHONE ALREADY EXISTS
					$_SESSION['message'] = "Phone number already exists!";
					$_SESSION['msg_type'] = "warning";
					die(header("Location: form.php?r=reg_failed"));
				}
				else {
			        mkdir("folder/{$first_name}_{$last_name}"); //CREATE FOLDER
					fopen("folder/{$first_name}_{$last_name}/index.php", "w"); //to protect files inside the folder	
			
					for($i=0; $i<count($_FILES["passport"]["name"]);$i++)//passport
					{
		               $passport_tmp = $_FILES["passport"]["tmp_name"][$i];
					   $passport_name = $_FILES["passport"]["name"][$i];
					   $passport_type = $_FILES["passport"]["type"][$i];
					   $passport_path = "{$folderpath}/".$passport_name;
			   
					   move_uploaded_file($passport_tmp, $passport_path);
					}
			
			        for($i=0; $i<count($_FILES["nso"]["name"]);$i++)//NSO
					{
		               $nso_tmp = $_FILES["nso"]["tmp_name"][$i];
					   $nso_name = $_FILES["nso"]["name"][$i];
					   $nso_type = $_FILES["nso"]["type"][$i];
					   $nso_path = "{$folderpath}/".$nso_name;
			   
					   move_uploaded_file($nso_tmp, $nso_path);	
					}
			
					for($i=0; $i<count($_FILES["mc"]["name"]);$i++)//married contract
					{
		               $mc_tmp = $_FILES["mc"]["tmp_name"][$i];
					   $mc_name = $_FILES["mc"]["name"][$i];
					   $mc_type = $_FILES["mc"]["type"][$i];
					   $mc_path = "{$folderpath}/".$mc_name;
			   
					   move_uploaded_file($mc_tmp, $mc_path);
					}
			        for($i=0; $i<count($_FILES["sbook"]["name"]);$i++)//Seaman's book
					{
		               $sbook_tmp = $_FILES["sbook"]["tmp_name"][$i];
					   $sbook_name = $_FILES["sbook"]["name"][$i];
					   $sbook_type = $_FILES["sbook"]["type"][$i];
					   $sbook_path = "{$folderpath}/".$sbook_name;
			   
					   move_uploaded_file($sbook_tmp, $sbook_path);		
					}
			
					for($i=0; $i<count($_FILES["appform"]["name"]);$i++)//Application form
					{
		               $appform_tmp = $_FILES["appform"]["tmp_name"][$i];
					   $appform_name = $_FILES["appform"]["name"][$i];
					   $appform_type = $_FILES["appform"]["type"][$i];
					   $appform_path = "{$folderpath}/".$appform_name;
			   
					   move_uploaded_file($appform_tmp, $appform_path);	
					}
			
					for($i=0; $i<count($_FILES["otherform"]["name"]);$i++)//Application form
					{
		               $otherform_tmp  = $_FILES["otherform"]["tmp_name"][$i];
					   $otherform_name = $_FILES["otherform"]["name"][$i];
					   $otherform_type = $_FILES["otherform"]["type"][$i];
					   $otherform_path = "{$folderpath}/".$otherform_name;
			   
					   move_uploaded_file($otherform_tmp, $otherform_path);
					}
			
					$fsql = "INSERT INTO folder VALUES (NULL,'{$user_name}', '{$passport_path}' , '{$nso_path}', '{$mc_path}', '{$sbook_path}', '{$appform_path}', '{$otherform_path}', '{$folderpath}', NOW())";
					$conn->query($fsql);
	
					$date = date("Y-m-d H:i:s");
	
					$sql = "INSERT INTO users VALUES (NULL, '{$date}', '{$user_name}', '{$email}', '{$phone}', '{$hashed_password}', '{$first_name}', '{$last_name}', '{$middle_name}', '{$suffix}', '{$date_of_birth}', '{$privilege}', NULL, NULL, '{$folderpath}', '{$status}', NULL, '{$zerobal_instance}')";
					$conn->query($sql);
			
					$_SESSION['message'] = "Successfully created member '{$user_name}'";
					$_SESSION['msg_type'] = "success";
			
					# LOG 
					$encoder_id = $_POST["encoder_id"];
					$user_id = $conn->insert_id;
					$log_string = "Member registration";
					include("insert_log.php");
					
					# MEMBERSHIP
					$stmt_mf = $conn->prepare("SELECT amt FROM fees where id = 1");
					$stmt_mf->bind_result($amt);
					$stmt_mf->execute();
					$stmt_mf->store_result();
					$stmt_mf->fetch();
										
					$stmt_m = $conn->prepare("INSERT INTO membership VALUES (NULL, ?, ?, ?, ?)");
					$stmt_m->bind_param("ssss", $date, $encoder_id, $user_id, $amt);
					$stmt_m->execute();
					
					# EMERGENCY FUND
					$stmt_mf = $conn->prepare("SELECT amt FROM fees where id = 2");
					$stmt_mf->bind_result($amt);
					$stmt_mf->execute();
					$stmt_mf->store_result();
					$stmt_mf->fetch();
					
					$stmt_m = $conn->prepare("INSERT INTO donations VALUES (NULL, ?, ?, ?, ?)");
					$stmt_m->bind_param("ssss", $date, $encoder_id, $user_id, $amt);
					$stmt_m->execute();
					
					$stmt_mf->close();
					$stmt_m->close();
					# date, credit, debit, trans, encoder, user
					# FOR EMERGENCY FUND
					
					postSubmit($date, $amt, 0, 1, $encoder_id, $user_id, $remarks);
					
					die(header("Location: form.php?r=reg_success")); 
				}
					
			}
	    	else { # IF PASSWORDS DID NOT MATCH
				$_SESSION['message'] = "Passwords do not match!";
				$_SESSION['msg_type'] = "danger";
				die(header("Location: form.php?r=reg_failed")); 
			}
		}
	}
	
	if(isset($_POST['ecform_submit'])){ //REGISTRATION FOR ENCODERS
		
		$sql = "SELECT MAX(id) AS max FROM users";
		
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$r = $result->fetch_assoc();
			
			$current_id = $r['max'] + 1;
    		$amax = sprintf("%08d", $current_id); //applied zeros from left
			
    		$user_name = "{$date}-{$amax}";
    		$password = $_POST['password'];
    		
    		
    		if($password == $_POST['repassword']){

				$hashed_password = md5($password);
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$middle_name = $_POST['middle_name'];
				$suffix = $_POST['suffix'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$date_of_birth = $_POST['date_of_birth'];
				$privilege = $_POST['privilege'];
				$rank = "CE";
				$folderpath = "folder/{$first_name}_{$last_name}";
				$status = 1;
				$zerobal_instance = 0;
			
				$sql = "SELECT phone from users WHERE phone = '{$phone}'";
				$result = $conn->query($sql);
			
				if($r = $result->fetch_assoc()){
					$_SESSION['message'] = "Phone number already exists!";
					$_SESSION['msg_type'] = "warning";
					die(header("Location: encoder_form.php?r=reg_failed")); 		
				}
			
				else { 
			        mkdir("folder/{$first_name}_{$last_name}"); //CREATE FOLDER
					fopen("folder/{$first_name}_{$last_name}/index.php", "w"); //to protect files inside the folder	
		
				
					$fsql = "INSERT INTO folder VALUES (NULL,'{$user_name}',NULL , NULL, NULL,NULL,NULL,NULL,'{$folderpath}', NOW())";
					$conn->query($fsql);
		
					$date = date("Y-m-d H:i:s");
					$sql = "INSERT INTO users VALUES (NULL, '{$date}', '{$user_name}', '{$email}', '{$phone}', '{$hashed_password}', '{$first_name}', '{$last_name}', '{$middle_name}', '{$suffix}', '{$date_of_birth}', '{$privilege}', NULL, NULL, '{$folderpath}', '{$status}', NULL, '{$zerobal_instance}')";
					$conn->query($sql);
					
					$_SESSION['message'] = "Successfully created user '{$user_name}'";
					$_SESSION['msg_type'] = "success";
				
					# LOG 
					$encoder_id = $_POST["encoder_id"];
					$user_id = $conn->insert_id;
					$log_string = "Encoder registration";
					include("insert_log.php");
				
					die(header("Location: encoder_form.php?r=reg_success")); 
			    
				    }//else
	    	    }//password
    	else{
			$_SESSION['message'] = "Passwords do not match!";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: encoder_form.php?r=reg_failed")); 
		    }
		}//fetch
	}
	
	
	
	
	if(isset($_POST['donate_submit'])){ //DONATE SUBMIT
		
		$encoder_id = $_POST['encoder_id'];
		$user_name = $_POST['user_name'];
		$amt = $_POST['amt'];
		$description = $_POST['description'];
		
		$sql = "SELECT id from users WHERE user_name = '{$user_name}'";
		$result=$conn->query($sql);
		
		if($r = $result->fetch_assoc()){
			$user_id = $r['id'];
			$date = date("Y-m-d H:i:s");
			
			$nsql = "INSERT INTO donations VALUES(NULL,'{$date}','{$encoder_id}','{$user_id}','{$amt}')";
			$conn->query($nsql);
			
			$fsql = "INSERT INTO history VALUES(NULL,'{$user_id}','{$encoder_id}','{$amt}','{$description}',NOW())";
			$conn->query($fsql);
			
			# date, credit, debit, trans, encoder, user
			postSubmit($date, $amt, 0, 1, $encoder_id, $user_id);
			
			$_SESSION['message'] = "Successfully updated user '{$user_name}' (Donate)";
			$_SESSION['msg_type'] = "success";
			
			# LOG 
			$log_string = "Posting of donation transaction, " . $amt;
			include("insert_log.php");
			
			
			die(header("Location: donate_form.php?r=reg_success")); 
		}

		else
			$_SESSION['message'] = "User '{$user_name}' does not exist...";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: donate_form.php")); 
			
	}
	
	if(isset($_POST['claim_submit'])){ 
	
		$encoder_id = $_POST['encoder_id'];
		$user_name = $_POST['user_name'];
		$class = $_POST['claim_classification'];
		$amt = $_POST['claim_amt'];
		
		#$encoder_id = 0; # TEMPORARY
		
		$description = $_POST['description'];
		
		$sql = "SELECT id from users WHERE user_name = '{$user_name}'";
		$result=$conn->query($sql);
		
		if($r = $result->fetch_assoc()){
			$user_id = $r['id'];
			$date = date("Y-m-d H:i:s");
			$nsql = "INSERT INTO claims VALUES(NULL, '{$date}','{$encoder_id}','{$user_id}','{$class}','{$amt}')";
			$conn->query($nsql);	
					
			# date, credit, debit, trans, encoder, user
			postSubmit($date, $amt, 0, 3, $encoder_id, $user_id, $class);
			
			include("deduct_claim.php");
			
			$csql = "INSERT INTO history VALUES(NULL,'{$user_id}','{$encoder_id}','{$amt}','{$description}',NOW())";
			$conn->query($csql);
			
			$_SESSION['message'] = "Claim successful!";
			$_SESSION['msg_type'] = "success";
			
			# LOG 
			$log_string = "Posting of claim transaction, " . $amt;
			include("insert_log.php");
			
			die(header("Location: claim_form.php?r=reg_success")); 
		}

		else
			$_SESSION['message'] = "User \"{$user_name}\" does not exist";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: claim_form.php")); 
			
	}
	
	if (isset($_POST["update_claim_submit"])){
		$class = $_POST['claim_classification'];
		$new_amt = $_POST["new_amt"];
		
		$stmt = $conn->prepare("UPDATE claim_classification SET amt = ? WHERE id = ?");
		$stmt->bind_param("ss", $new_amt, $class);
		if ($stmt->execute()){
			$_SESSION['message'] = "Successfully updated claim classification!";
			$_SESSION['msg_type'] = "success";
			
			# LOG 
			$encoder_id = $_POST["encoder_id"];
			$user_id = 0;
			$log_string = "Set new amount for claim classification " . $class . ", " . $new_amt;
			$date = date("Y-m-d H:i:s");
			include("insert_log.php");
			
			die(header("Location: update_claim_classification.php?r=reg_success")); 
		}
	}
	
	if (isset($_POST["update_fee_submit"])){
		$class = $_POST['fee_classification'];
		$new_amt = $_POST["new_amt"];
		
		$stmt = $conn->prepare("UPDATE fees SET amt = ? WHERE id = ?");
		$stmt->bind_param("ss", $new_amt, $class);
		if ($stmt->execute()){
			$_SESSION['message'] = "Successfully updated fee classification!";
			$_SESSION['msg_type'] = "success";
			
			# LOG 
			$encoder_id = $_POST["encoder_id"];
			$user_id = 0;
			$log_string = "Set new amount for fee classification " . $class . ", " . $new_amt;
			$date = date("Y-m-d H:i:s");
			include("insert_log.php");
			
			die(header("Location: update_fees.php?r=reg_success")); 
		}
	}
	
	if(isset($_POST['withdraw_submit'])){ //Withdraw SUBMIT
		
		$encoder_id = $_POST['encoder_id'];
		$user_name = $_POST['user_name'];
		$amt = $_POST['amt'];
		$description = $_POST['description'];
		
		$sql = "SELECT id from users WHERE user_name = '{$user_name}'";
		$result=$conn->query($sql);
		
		if($r = $result->fetch_assoc()){
			$user_id = $r['id'];
			$date = date("Y-m-d H:i:s");
			
			$nsql = "INSERT INTO withdrawals VALUES(NULL,'{$date}','{$encoder_id}','{$user_id}','{$amt}')";
			$conn->query($nsql);
			$fsql = "INSERT INTO history VALUES(NULL,'{$user_id}','{$encoder_id}','{$amt}','{$description}',NOW())";
			$conn->query($fsql);
			
			# date, credit, debit, trans, encoder, user
			postSubmit($date, 0, $amt, 2, $encoder_id, $user_id);
			
			$_SESSION['message'] = "Successfully updated user '{$user_name}' (Withdraw)";
			$_SESSION['msg_type'] = "success";
			
			# LOG
			$log_string = "Posting of withdrawal transaction, " . $amt;
			include("insert_log.php");
			
			die(header("Location: withdrawal_form.php?r=reg_success")); 
		}

		else
			$_SESSION['message'] = "User '{$user_name}' does not exist";
			$_SESSION['msg_type'] = "danger";
			die(header("Location: withdrawal_form.php")); 
			
	}

	function postSubmit ($date, $credit, $debit, $trans, $encoder_id, $user_id, $remarks = ""){
		# id, date, credit, debit, trans, encoder_id, user_id, remarks, r
		include("database.php");
		
		$stmt_th_r = $conn->prepare("SELECT r from transaction_history where user_id = ? order by date desc limit 1");
		$stmt_th_r->bind_param("s", $user_id);
		$stmt_th_r->execute();
		$stmt_th_r->store_result();
		$stmt_th_r->bind_result($r);
		if (!$stmt_th_r->fetch()){
			$r = 0;
		}
		$stmt_th_r->close();
		
		if (in_array($trans, array(1, 2, 4, 5))){
			$r += $credit;
			$r -= $debit; 
		}
		
		$stmt_th = $conn->prepare("INSERT INTO transaction_history VALUES( NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt_th->bind_param("ssssssss", $date, $credit, $debit, $trans, $encoder_id, $user_id, $remarks, $r);
		$stmt_th->execute();
		$stmt_th->close();
		
	}
	
?>
