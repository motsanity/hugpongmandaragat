<?php
	include('init.php');
	include('privilege.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>Withdrawal Forms</title>
	 <?php include("components/head_assets.html"); ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        
            <?php include('components/navbar.html')?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">

                                <?php if(isset($_SESSION['message'])):?>
                                        <div class = "alert alert-<?=$_SESSION['msg_type'] ?>">
                                            <b>
                                                <?php 
                                                    echo  $_SESSION['message'];
                                                    unset ($_SESSION['message']);
                                                ?>
                                        
                                            </b>
                                        </div>
								<?php endif?>
                                <div class="card">
									
                                    <div class="card-header">
                                        <strong>Withdraw</strong> Form
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="submit.php" method="POST" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-text" class=" form-control-label">User's Code</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="hf-text" name="user_name" placeholder="<?php echo date("Y")?>-12345678" class="form-control" required>
                                                    
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-email" class=" form-control-label">Amount to withdraw</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="" maxlength="10" name="amt" placeholder="1500" class="form-control" required>                                                 
                                                </div>
												<input type ="text" name="encoder_id" value="<?php echo $_SESSION["id"];?>" hidden>
												<input type ="text" name="description" value="Withdraw" hidden>
                                            </div>
											
											<button type="submit" name="withdraw_submit" class="btn btn-warning btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit Withdrawal
                                        </button>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        
                                        
                                    </div>
                                </div>
                               
                                
                        </div>
                        <div class="row">
                            
                        </div>
                    </div>
					
                </div>
				<?php include('components/footer.html'); ?>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
