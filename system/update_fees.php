<?php
	include('init.php');
	include('privilege.php');
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>Fees</title>
	<script src="vendor/jquery-3.2.1.min.js"></script>
	<?php include("components/head_assets.html"); ?>
</head>

<body class="animsition">
	<script type="text/javascript">
		var mode = false;
	</script>
	<script src="js/fee_js.js"></script>
    <div class="page-wrapper">
            <?php include('components/navbar.html'); ?>
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">  
                            <div class="col-lg-12">
								<?php if(isset($_SESSION['message'])):?>
									<div class = "alert alert-<?echo $_SESSION['msg_type'] ?>">
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
                                        <strong>Update Fees</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="submit.php" method="POST" class="form-horizontal">
											<div class="row form-group">
												<div class="col col-md-4">
                                                    <label for="claim-classification" class=" form-control-label">Fee Classification</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <select name="fee_classification" id="fee_classification" class="form-control-md form-control">
                                                        <option value="0">Please select fee classification</option>
														<?php 
														$mode = false;
														include("fee_classifications.php");
														foreach ($classification as $c){
														?><option value="<?php echo $c["value"]; ?>"><?php echo $c["description"]?></td>
														<?php }
															
														?></select>
                                                </div>
											</div>
											<div class="row form-group">
	                                            <div class="col col-md-4">
	                                                <label for="fee" class=" form-control-label">Current Amount	</label>
	                                            </div>
	                                            <div class="col-12 col-md-8">
	                                                <input type="text" id="fee" name="fee_amt" placeholder="Amount" readonly class="form-control">
	                                            </div>
	                                        </div>
											<div class="row form-group">
	                                            <div class="col col-md-4">
	                                                <label for="new_claim" class=" form-control-label">New Amount</label>
	                                            </div>
	                                            <div class="col-12 col-md-8">
	                                                <input type="text" id="new_fee" name="new_amt" placeholder="Enter new amount" class="form-control">
	                                            </div>
	                                        </div>
											<input type="text" value="<?php echo $_SESSION["id"]; ?>" name="encoder_id" hidden />
											<button type="submit" name="update_fee_submit" id="fee_submit" class="btn btn-success btn-sm offset-md-4">
                                            <i class="zmdi zmdi-edit"></i> Update Fee
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
