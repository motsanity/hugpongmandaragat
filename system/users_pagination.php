<?php
	# REPORT 
	include("database.php");
	session_start();
	$limit = 15;
	$page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
	$status = isset($_REQUEST["s"]) ? $_REQUEST["s"] : 0;
	
	$start = ($page - 1) * $limit;

	$sql_status = $status != 0 && !in_array($status, [4, 5]) ? " where status = " . $status : ( $status == 4 ? " where a.privilege = 3" : ( $status == 5 ? " where a.privilege = 1" : "")); 
	
	$stmt = $conn->prepare("SELECT count(*) count FROM users a " . $sql_status);

	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	$total_records = $count;  
	$total_pages = ceil($total_records / $limit); 
	$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : $action;
	if (isset($action) && $action == 1){
		if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
			if($i == 1):?>
            <button id="<?php echo $i ?>" class="btn btn-sm btn-success"><?php echo $i;?></button>
			<?php else:?>
			<button id="<?php echo $i ?>" class="btn btn-sm btn-outline-success"><?php echo $i;?></button>
		<?php endif;?>			
		<?php endfor;endif; 
	}
	else {

		$rep = [];

		$stmt = $conn->prepare("SELECT a.*, a.id as user_id, b.description as stat_desc from users a join status b on a.status = b.id " . $sql_status . " LIMIT " . $start . ", " . $limit);
		$stmt->execute();
		$result = $stmt->get_result();
	
		$has_result = false;
		while ($row = $result->fetch_assoc()){
			$has_result = true;
			$rep[] = [
				"user_id"		=> $row["user_id"],
				"date" 			=> $row["date"],
				"img"			=> $row["img_path"],
				"first_name" 	=> $row["first_name"],
				"last_name" 	=> $row["last_name"],
				"middle_name" 	=> $row["middle_name"],
				"suffix" 		=> $row["suffix"],
				"date_of_birth" => $row["date_of_birth"],
				"user_name" 	=> $row["user_name"],
				"email" 		=> $row["email"],
				"phone" 		=> $row["phone"],
				"status"		=> $row["status"],
				"privilege"		=> $row["privilege"],
				"stat_desc"		=> $row["stat_desc"],
				"zerobal_inst"	=> $row["zerobal_instance"],
			];
		}
	
		if (isset($_REQUEST["page"]) && $has_result){
			foreach($rep as $r){ ?>
				<tr>
					<td class="text-center align-middle <?php echo  $r["status"] == 1 ? 'process' : 'denied' ?>"><?php echo $r["stat_desc"]; ?></td>
					<td class="action align-middle">
						<button href="tag_user.php?e=<?php echo $_SESSION["id"];?>&id=<?php echo $r["user_id"];?>&action=6" class="btn btn-sm btn-success d-block m-1"><i class="zmdi zmdi-money"></i> Charge annual payment</button>
						
					<?php if ($r["zerobal_inst"] >= 3 && $r["status"] == 1) {?>
							<button href="tag_user.php?e=<?php echo $_SESSION["id"];?>&id=<?php echo $r["user_id"];?>&action=2" class="btn btn-sm btn-primary d-block m-1"><i class="fa fa-times"></i> Tag as inactive</button>
						
					<?php } if ($r["privilege"] == 2 && $r["status"] == 1){ 
					?>
						<button href="tag_user.php?e=<?php echo $_SESSION["id"];?>&id=<?php echo $r["user_id"];?>&action=3" class="btn btn-sm btn-secondary d-block m-1"><i class="fa fa-times"></i> Tag as deceased</button>
					<?php } if ($r["privilege"] == 2 && $r["status"] != 1 && $_SESSION["privilege"] == 3) {
					?>
						<button href="tag_user.php?e=<?php echo $_SESSION["id"];?>&id=<?php echo $r["user_id"];?>&action=1" class="btn btn-sm btn-success d-block m-1"><i class="fa fa-check"></i> Tag as active</button>
					<?php } if ($r["privilege"] == 1 && $_SESSION["privilege"] == 3 && $r["user_id"] != $_SESSION["id"]){
					?>
						<button href="tag_user.php?e=<?php echo $_SESSION["id"];?>&id=<?php echo $r["user_id"];?>&action=4" class="btn btn-sm btn-warning d-block m-1"><i class="zmdi zmdi-repeat"></i> Switch to Administrator</button>
					<?php } if ($r["privilege"] == 3 && $_SESSION["privilege"] == 3 && $r["user_id"] != $_SESSION["id"]){
					?>
						<button href="tag_user.php?e=<?php echo $_SESSION["id"];?>&id=<?php echo $r["user_id"];?>&action=5" class="btn btn-sm btn-warning d-block m-1"><i class="zmdi zmdi-repeat"></i> Switch to Encoder</button>
					<?php }
					?>
					</td>
					<td class="text-nowrap align-middle"><?php echo date("F d, Y m:s", strtotime($r["date"])); ?></td>
					<?php if(file_exists($r['img'])){?>
					<td class="align-middle">
						<img data-toggle="modal" data-target="#imageModal" class="image-user" src="<?php echo $r["img"];?>" title="<?php echo $r["user_name"] ;?>"/>
					</td>
					<?php }
						else {?>
					<td class="align-middle">
						<img src="assets/avatar.png" title="Image not found"/>
					</td>
					<?php }?>
					<td class="text-left text-nowrap align-middle"><a href="data.php?view=<?php echo $r["user_name"];?>"><?php echo $r["user_name"]; ?></a></td>
					<td class="text-left text-nowrap align-middle"><?php echo $r["first_name"]; ?></td>
					<td class="text-left text-nowrap align-middle"><?php echo $r["middle_name"]; ?></td>
					<td class="text-left text-nowrap align-middle"><?php echo $r["last_name"]; ?></td>
					<td class="text-left text-nowrap align-middle"><?php echo $r["suffix"]; ?></td>
					<td class="text-left text-nowrap align-middle"><?php echo date("F d, Y", strtotime($r["date_of_birth"])); ?></td>
					<td class="text-left text-nowrap align-middle"><?php echo $r["email"]; ?></td>
					<td class="text-left text-nowrap align-middle"><?php echo $r["phone"];  ?></a></td>
				<?php } ?>
				</tr>
			<?php }
		else { 
			if (isset($_REQUEST["page"])){
		?>	
	        <tr>
				<td colspan="12" class="text-center">No user found.</td>
				</td>
			</tr>
		<?php 
		}
	}
	$stmt->close();
}
?>