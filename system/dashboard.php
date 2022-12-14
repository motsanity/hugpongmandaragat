<?php
	# USERS
	$stmt = $conn->prepare("SELECT count(id) as total_users FROM users where status = 1 and privilege = 2");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_users);
	$stmt->fetch();
	$stmt->close();
	
	# DONATIONS
	$stmt = $conn->prepare("SELECT sum(amt) as total_donations FROM donations");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_donations);
	$stmt->fetch();
	$stmt->close();
	
	# WITHDRAWALS
	$stmt = $conn->prepare("SELECT sum(amt) as total_withdrawals FROM withdrawals");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_withdrawals);
	$stmt->fetch();
	$stmt->close();
	
	# MEMBERSHIP
	$stmt = $conn->prepare("SELECT sum(amt) as amt FROM membership");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($membership);
	$stmt->fetch();
	$stmt->close();
	
	# ANNUAL
	$stmt = $conn->prepare("SELECT sum(amt) as amt FROM annual_fees");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($annual);
	$stmt->fetch();
	$stmt->close();
	
	# CLAIMS
	$stmt = $conn->prepare("SELECT sum(amt) as total_claims FROM claims");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($total_claims);
	$stmt->fetch();
	$stmt->close();
		
	# DONATIONS TREND
	$donation_month = [];
	$donation_amt = [];
	
	$stmt = $conn->prepare("SELECT date_format(date, '%M %Y') as month, sum(amt) as amt FROM donations group by date_format(date, '%M %Y') order by date desc limit 12");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($month, $amt);
	$donations_data = [];
	while ($stmt->fetch()){
		$donation_month[] = $month;
		$donation_amt[] = $amt;
	}
	$stmt->close();
	
	# WITHDRAWALS TREND
	$wd_month = [];
	$wd_amt = [];
	
	$stmt = $conn->prepare("SELECT date_format(date, '%M %Y') as month, sum(amt) as amt FROM withdrawals group by date_format(date, '%M %Y') order by date desc limit 12");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($month, $amt);
	$donations_data = [];
	while ($stmt->fetch()){
		$wd_month[] = $month;
		$wd_amt[] = $amt;
	}
	$stmt->close();
	
	if (empty($donation_amt)){
		$donation_amt[] = 0;
	}
	if (empty($wd_amt)){
		$wd_amt[] = 0;
	}
	
	$max_value = max($donation_amt) >= max($wd_amt) ? max($donation_amt) : max($wd_amt);
		
	echo "<script type='text/javascript'>
		const total_users = " . $total_users . ";
		const total_donations = '" . number_format($total_donations, 2) . "';
		const total_withdrawals = '" . number_format($total_withdrawals, 2) . "';
		const membership = '" . number_format($membership, 2) . "';
		const annual = '" . number_format($annual, 2) . "';
		const total_claims = '" . number_format($total_claims, 2) . "';
		const outstanding = '" . number_format( ($total_donations + $annual)- ($total_withdrawals + $total_claims), 2) . "';
		
		const donation_month = " . json_encode($donation_month) .";
		const donation_amt = " . json_encode($donation_amt) .";
		const wd_month = " . json_encode($wd_month) .";
		const wd_amt = " . json_encode($wd_amt) .";
		const max_value = " . $max_value . ";
	</script>
		";	
	echo "<script type='text/javascript' src='js/dashboard.js'></script>"
			
?>