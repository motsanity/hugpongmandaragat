<?php
	include('init.php');
    include('privilege.php');
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>Update Member Documents</title>
	<?php include("components/head_assets.html"); ?>
</head>

<body class="animsition">
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
									<div class = "alert alert-<?=$_SESSION['msg_type'] ?>">
                                        <b>
                                            <?php 
                                                echo  $_SESSION['message'];
                                                unset ($_SESSION['message']);
                                            ?>
                                    
                                        </b>
								    </div>
								<?php endif?>
                                
                                <a href="update_files.php"class="btn btn-primary btn-sm">Update Passport & Seaman's Book</a>
                                <a href="update_files.php?view=1"class="btn btn-warning btn-sm">Update NSO & Marriage Contract</a>
								<a href="update_appform.php"class="btn btn-success btn-sm">Update Application Form</a>
                                
								
                                <div class="card">
									
                                    <div class="card-header">
                                       
                                            <strong>Update Application Form</strong> 
                                        
                                    </div>
                                    <div class="card-body card-block">
                                    
                                        <form action="submit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            
											 <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-text" class=" form-control-label">User Code</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="hf-text" name="user_name" placeholder="<?php echo date("Y")?>-12345678" class="form-control" required>
                                                    
                                                </div>
                                            </div>
                                            
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Application Form <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" name="appform[]"  accept=".xlsx,.xls,.doc,.docx,.pdf" class="form-control" required>
                                                    <input type="text" value="<?php echo $_SESSION["id"]; ?>" name="encoder_id" hidden />
                                                </div>
                                            </div>
											
                                                <button type="submit" id = "submit"name="updateaf_submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Update
                                                </button>
												

                                        </form>
                                    </div>
								</div>
							</div>
                    </div>
					<?php include('components/footer.html'); ?>
                </div>
            </div>
        </div>

    </div>
	
	<script>
    $('#submit').click(function(event) {
        var val = $('input[type=file]').val().toLowerCase();
        var regex = new RegExp("(.*?)\.(pdf|docx|doc|xls|xlsx)$");
        if(!(regex.test(val))) {
            $('.uploadExtensionError').show();
            event.preventDefault();
        }
    });
	</script>

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
