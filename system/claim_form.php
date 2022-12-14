<?php
	include('init.php');
	include('privilege.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>Claim Form</title>
	<script src="vendor/jquery-3.2.1.min.js"></script>
	<?php include("components/head_assets.html"); ?>
</head>

<body class="animsition">
	<script type="text/javascript">
		var user_id = <?php echo $_SESSION["id"]; ?>;
		var mode = true;
	</script>
	<script src="js/claim_js.js"></script>
    <div class="page-wrapper">
            <?php include('components/navbar.html'); ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
			
				
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">  
                            <div class="col-lg-12">
                            <?php if(isset($_SESSION['message'])):?>
									<div class = "alert alert-<?php echo $_SESSION['msg_type'] ?>">
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
                                        <strong>Claims</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="submit.php" method="POST" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-text" class=" form-control-label">Member User Code</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="user-name" name="user_name" placeholder="Ex: <?php echo date("Y")?>-12345678" class="form-control" required>
                                                    
                                                </div>
                                            </div>
											<div class="row form-group">
												<div class="col col-md-4">
                                                    <label for="claim-classification" class=" form-control-label">Claim Classification</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <select name="claim_classification" id="claim-classification" class="form-control-md form-control">
                                                        <option value="0">Please select claim classification</option>
														<?php 
														$mode = true;
														include("claim_classifications.php");
														foreach ($classification as $c){
														?><option value="<?php echo $c["value"]; ?>"><?php echo $c["description"]; ?></td>
														<?php }
															
														?></select>
                                                </div>
											</div>
											<div class="row form-group">
	                                            <div class="col col-md-4">
	                                                <label for="claim_amt" class=" form-control-label">Entitled Amount of Claim</label>
	                                            </div>
	                                            <div class="col-12 col-md-8">
	                                                <input type="text" id="claim" name="claim_amt" placeholder="Amount" readonly class="form-control" required>
	                                            </div>
	                                        </div>
												<input type ="text" name="encoder_id" value="<?php echo $_SESSION['id'];?>" hidden>
												<input type ="text" name="description" value="Claimed" hidden>
											<button type="submit" name="claim_submit" id="claim-submit" class="btn btn-success btn-sm offset-md-5" disabled>
                                            <i class="zmdi zmdi-check"></i> Claim
                                        </button>
                                        </form>
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
