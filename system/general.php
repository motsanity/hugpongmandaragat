<?php
	function logged_in_redirect(){
		if ($_SESSION['privilege'] == 3){
			header('Location: index.php');
			exit();
		}
	}
	function protect_page(){
		if ($_SESSION['privilege'] == NULL) {
			die(header("Location: login.php"));
			exit();
		}
	}
	
?>