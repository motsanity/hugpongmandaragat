<?php
	if($_SESSION['privilege'] == 1){
		die(header("Location: index.php")); 
	}
?>