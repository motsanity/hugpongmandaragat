<?php
	# REPORT 
	include("database.php");
	$has_transaction = false;
	if (isset($_REQUEST["id"])){
		$user_id = $_REQUEST["id"];
		$mode = true;
	}
	else {
		$mode = false;
	}
	
	include("pagination.php");
	$rep = [];
	$page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
	$start = ($page - 1) * $limit;
	
	# 1 - deposit; 2 - withdrawal; 3 - claims; 4 - deductions
	
	if (isset($_REQUEST["id"])){
		$stmt = $conn->prepare("SELECT a.date as date, a.trans as trans, b.description as trans_desc, a.credit as credit, a.debit as debit, a.r as r, a.encoder_id as encoder_id, a.user_id as user_id, c.description as remarks from transaction_history a left join transaction b on a.trans = b.id left join claim_classification c on a.remarks = c.id where a.user_id = ? order by date desc LIMIT " . $start . ", " . $limit);
		$stmt->bind_param("s", $user_id);
	}
	else 
		$stmt = $conn->prepare("SELECT *, (select if(sum(credit) is not null, sum(credit), 0) from finances_view_general where date <= a.date and trans in (1, 5)) - (select if (sum(debit) is not null, sum(debit), 0) from finances_view_general where date <= a.date and trans in (2, 3)) as r FROM `finances_view_general` a LIMIT " . $start . ", " . $limit);	
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()){
		$has_transaction = true;
		$rep[] = [
			"date" 			=> $row["date"],
			"trans" 		=> $row["trans"],
			"trans_desc" 	=> $row["trans_desc"],
			"amt" 			=> isset($_REQUEST["id"]) ? (in_array($row["trans"], [1, 3]) ? $row["credit"] : $row["debit"]) : (in_array($row["trans"], [1, 5]) ? $row["credit"] : $row["debit"]),
			"bal" 			=> $row["r"],
			"remarks"		=> $row["remarks"],
			"encoder_id"	=> !isset($_REQUEST["id"]) ? $row["encoder_id"]: "",
			"user_id"		=> !isset($_REQUEST["id"]) ? $row["user_id"]: "",
		];
	}
	
	if (isset($_REQUEST["page"]) && $has_transaction){
		foreach($rep as $r){
			?>
			<tr>
				<td class="text-nowrap"><?php echo date("F d, Y H:i:s", strtotime($r["date"])); ?>
				<td class="text-center text-nowrap <?php echo isset($_GET["id"]) ? (in_array($r["trans"], [1, 3, 5]) ? 'process' : 'denied') : (in_array($r["trans"], [1, 5]) ? 'process' : 'denied')?>" ><?php echo $r["trans_desc"]; ?></td>
				<td><?php echo number_format($r["amt"], 2); ?></td>
				<td><?php echo number_format($r["bal"], 2); ?></td>
				<td class="text-center text-nowrap"><?php echo in_array($r["trans"], [3, 4]) ? $r["remarks"] : "-";?></td>
				<?php if (!isset($_GET["id"])){?>
				<td class="text-nowrap text-center"><?php echo $r["encoder_id"]  == NULL ? "-" : $r["encoder_id"]; ?></td>
				<td class="text-nowrap text-center"><a href="data.php?view=<?php echo $r["user_id"] ?>"class="text-nowrap"><?php echo $r["user_id"] ?></a></td>
				<?php } ?>
			</tr>
			<?php }
	}
	else {
		?>
        <tr>
			<td colspan="7" class="text-center">No transactions yet.</td>
			</td>
		</tr>
	<?php } 
	$stmt->close();
?>