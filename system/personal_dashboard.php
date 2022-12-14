<?php
	$user_id = $_SESSION['id'];	
	# DONATIONS
	$stmt = $conn->prepare("SELECT sum(amt) as total_donations FROM donations WHERE user_id = ?");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_donations);
	$stmt->fetch();
	$stmt->close();
	
	# WITHDRAWALS
	$stmt = $conn->prepare("SELECT sum(amt) as total_withdrawals FROM withdrawals WHERE user_id = ?");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_withdrawals);
	$stmt->fetch();
	$stmt->close();
	
	# WITHDRAWALS
	$stmt = $conn->prepare("SELECT sum(amt) as total_claims FROM claims WHERE user_id = ?");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_claims);
	$stmt->fetch();
	$stmt->close();
	
	
	# WITHDRAWALS
	$stmt = $conn->prepare("SELECT sum(amt) as total_deductions FROM deductions WHERE user_id = ?");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_deductions);
	$stmt->fetch();
	$stmt->close();
	
	# ANNUAL
	$stmt = $conn->prepare("SELECT sum(amt) as total_annual FROM annual_fees WHERE user_id = ?");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_annual);
	$stmt->fetch();
	$stmt->close();
	
		
	# DONATIONS TREND
	$monthly_month = [];
	$monthly_amt = [];
	
	$stmt = $conn->prepare("SELECT date_format(date, '%M') as month, sum(amt) as amt FROM donations WHERE user_id = ? group by date_format(date, '%M') order by date desc limit 12");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($month, $amt);
	$donations_data = [];
	while ($stmt->fetch()){
		$monthly_month[] = $month;
		$monthly_amt[] = $amt;
	}
	$stmt->close();
	
	# WITHDRAWALS TREND
	$yearly_year = [];
	$yearly_amt = [];
	
	$stmt = $conn->prepare("SELECT date_format(date, '%Y') as year, sum(amt) as amt FROM donations WHERE user_id = ? group by date_format(date, '%Y') order by date desc limit 12");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($year, $amt);
	$donations_data = [];
	while ($stmt->fetch()){
		$yearly_year[] = $year;
		$yearly_amt[] = $amt;
	}
	$stmt->close();

	echo "<script type='text/javascript'>
		const total_donations = '" . number_format($total_donations, 2) . "';
		const total_withdrawals = '" . number_format($total_withdrawals, 2) . "';
		const total_claims = '" . number_format($total_claims, 2) . "';
		const total_deductions = '" . number_format($total_deductions, 2) . "';
		const total_annual = '" . number_format($total_annual, 2) . "';
		const outstanding = '" . number_format($total_donations - ($total_withdrawals + $total_deductions + $total_annual) , 2) . "';
		
		const monthly_month = " . json_encode($monthly_month) .";
		const monthly_amt = " . json_encode($monthly_amt) .";
		const yearly_year = " . json_encode($yearly_year) .";
		const yearly_amt = " . json_encode($yearly_amt) .";
		const user_id = ". $user_id."; 
	</script>
		";	
	echo "<script type='text/javascript' src='js/personal_dashboard.js'></script>"
?>