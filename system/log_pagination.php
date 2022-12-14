<?php
	# REPORT 
	include("database.php");
	$limit = 15;
	$page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
	$status = isset($_REQUEST["s"]) ? $_REQUEST["s"] : 1;
	
	$start = ($page - 1) * $limit;
	
	if ($status == 1){
		$sql_c = "SELECT count(a.id) from log_donation a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id";
		$sql = "SELECT a.*, b.user_name as 'e', c.user_name as 'u' from log_donation a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 2) {
		$sql_c = "SELECT count(a.id) from log_wdrawal a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id";
		$sql = "SELECT a.*,b.user_name as 'e', c.user_name as 'u' from log_wdrawal a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 3) {
		$sql_c = "SELECT count(a.id) from log_claim a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id";
		$sql = "SELECT a.*, b.user_name as 'e', c.user_name as 'u' from log_claim a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 4) {
		$sql_c = "SELECT count(a.id) from log_tag a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id JOIN status d on a.action = d.id";
		$sql = "SELECT a.*, b.user_name as 'e', c.user_name as 'u', d.description as action from log_tag a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id JOIN status d on a.action = d.id order by a.date desc";
	}
	else if ($status == 5) {
		$sql_c = "SELECT count(a.id) from log_upd_cc a JOIN users b on a.encoder_id = b.id";
		$sql = "SELECT a.*, b.user_name as 'e'  from log_upd_cc a JOIN users b on a.encoder_id = b.id order by a.date desc";
	}
	else if ($status == 6) {
		$sql_c = "SELECT count(a.id) from log_docs a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id ";
		$sql = "SELECT a.*, b.user_name as 'e', c.user_name as 'u' from log_docs a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 7) {
		$sql_c = "SELECT count(a.id) from log_reg_member a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id ";
		$sql = "SELECT a.*, b.user_name as 'e', c.user_name as 'u' from log_reg_member a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 8) {
		$sql_c = "SELECT count(a.id) from log_pp a JOIN  users c on a.user_id = c.id";
		$sql = "SELECT a.*, c.user_name as 'u' from log_pp a JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 9) {
		$sql_c = "SELECT count(a.id) from log_log_in a JOIN  users c on a.user_id = c.id";
		$sql = "SELECT a.*, c.user_name as 'u' from log_log_in a JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 10) {
		$sql_c = "SELECT count(a.id) from log_log_out a JOIN  users c on a.user_id = c.id";
		$sql = "SELECT a.*, c.user_name as 'u' from log_log_out a JOIN users c on a.user_id = c.id order by a.date desc";
	}
	else if ($status == 11) {
		$sql_c = "SELECT count(a.id) from log_upd_fees a JOIN users b on a.encoder_id = b.id";
		$sql = "SELECT a.*, b.user_name as 'e'  from log_upd_fees a JOIN users b on a.encoder_id = b.id order by a.date desc";
	}
	if ($status == 12){
		$sql_c = "SELECT count(a.id) from log_annual a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id";
		$sql = "SELECT a.*, b.user_name as 'e', c.user_name as 'u' from log_annual a JOIN users b on a.encoder_id = b.id JOIN users c on a.user_id = c.id order by a.date desc";
	}
	
	$stmt = $conn->prepare($sql_c); # count

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

		$stmt = $conn->prepare($sql . " LIMIT " . $start . ", " . $limit);
		$stmt->execute();
		$result = $stmt->get_result();
	
		$has_result = false;
		while ($row = $result->fetch_assoc()){
			$has_result = true;
			$rep[] = [
				"date"	=> $row["date"],
				"desc"	=> $row["description"],
				"a"		=> in_array($status, [1, 2, 3, 5, 11, 12]) ? $row["amt"] : (in_array($status, [4]) ? $row["action"] : "-"),
				"e"		=> in_array($status, [1, 2, 3, 4, 5, 6, 7, 11, 12]) ? $row["e"] : "-",
				"u"		=> in_array($status, [1, 2, 3, 4, 6, 7, 8, 9, 10, 12]) ? $row["u"] : "-",
			];
		}
	
		if (isset($_REQUEST["page"]) && $has_result){
			foreach($rep as $r){ ?>
				<tr>
					<td class="text-center text-nowrap"><?php echo $r["date"]; ?></td>
					<td class="text-left text-nowrap"><?php echo $r["desc"]; ?></td>
					
					<td class="text-center text-nowrap"><?php echo in_array($status, [1, 2, 3, 5, 11]) ? number_format($r["a"], 2) : $r["a"]; ?></td>
					
					<td class="text-left text-nowrap"><?php echo $r["e"]; ?></td>
					
					<td class="text-left text-nowrap"><?php echo $r["u"]; ?></td>
				</tr>
			<?php }
		}
		else { 
			if (isset($_REQUEST["page"])){
		?>	
	        <tr>
				<td colspan="10" class="text-center">No record found.</td>
				</td>
			</tr>
		<?php 
		}
	}
	$stmt->close();
}
?>