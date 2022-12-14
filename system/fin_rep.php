<?php
	# YEARLY
	$yearly_year = [];
	$yearly_amt = [];
	
	$stmt = $conn->prepare("SELECT date_format(date, '%Y') as year, sum(amt) as amt FROM donations group by date_format(date, '%Y') order by date desc limit 10");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($year, $amt);
	$yearly_data = [];
	while ($stmt->fetch()){
		$yearly_year[] = $year;
		$yearly_amt[] = $amt;
	}
	$stmt->close();
			
	# MONTHLY
	$monthly_month = [];
	$monthly_amt = [];
	
	$stmt = $conn->prepare("SELECT date_format(date, '%M %Y') as month, sum(amt) as amt FROM donations group by date_format(date, '%M %Y') order by date desc limit 12");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($month, $amt);
	$monthly_data = [];
	while ($stmt->fetch()){
		$monthly_month[] = $month;
		$monthly_amt[] = $amt;
	}
	$stmt->close();
	
	echo "<script type='text/javascript'>
		const monthly_month = " . json_encode($monthly_month) .";
		const monthly_amt = " . json_encode($monthly_amt) .";
		const yearly_year = " . json_encode($yearly_year) .";
		const yearly_amt = " . json_encode($yearly_amt) .";
	</script>
		";	
	echo "<script type='text/javascript' src='js/fin_rep.js'></script>"
			
?>