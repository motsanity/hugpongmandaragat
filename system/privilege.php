<?php
	if($_SESSION['privilege'] == 2){
		die(header("Location: profile.php")); 
	}
?>