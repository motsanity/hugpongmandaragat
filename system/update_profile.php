<?php
	include('init.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
	<title>Update Profile Picture</title>
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
                                <a href="update_profile.php"class="btn btn-primary btn-sm">Update Profile Picture</a>
                                <a href="update_profile.php?view=1"class="btn btn-warning btn-sm">Change Password</a>
                                <div class="card">
									
                                    <div class="card-header">
                                    <?php if(isset($_GET['view']) != 1):?>
                                        <strong>Update Profile Picture</strong> 
                                    <?php endif?>

                                    <?php if(isset($_GET['view']) == 1):?>
                                        <strong>Change Password</strong> 
                                    <?php endif?>

                                    </div>
                                    <div class="card-body card-block">
                                        <?php if(isset($_GET['view']) != 1):?>
                                        <form action="submit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            
										
											
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Profile Picture*</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" name="pp[]"  accept=".jpeg,.jpg,.png" class="form-control" required>
                                                    <input name="sid"  value="<?php echo $_SESSION['id']?>" class="form-control" hidden>
													<input name="user_name" value="<?php echo $_SESSION['user_name']?>" class="form-control" hidden>
                                                </div>
                                            </div>

				
											<button type="submit" id = "submit"name="update_submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Update
                                        </button>
                                        </form>
                                        <?php endif?>

                                        <!--change password -->

                                        <?php if(isset($_GET['view']) == 1):?>
                                        <form action="submit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            
										
											
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Old Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="hf-password" name="password" placeholder="Enter Old Password..." class="form-control" required>
                                                    
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">New Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="hf-password" name="new_password" placeholder="Enter New Password..." class="form-control" required>
                                                    
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Re-type Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="hf-password" name="repassword" placeholder="Re-type Password..." class="form-control" required>
                                                    <input name="sid"  value="<?php echo $_SESSION['id']?>" class="form-control" hidden>
													<input name="user_name" value="<?php echo $_SESSION['user_name']?>" class="form-control" hidden>
                                               
                                                </div>
                                            </div>

				
											<button type="submit" id = "submit"name="changepw_submit" class="btn btn-warning btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Change Password
                                        </button>
                                        </form>
                                        <?php endif?>

                                        
                                    </div>
                                    <div class="card-footer">
                                        
                                        
                                    </div>
                                </div>
                               
                                
                        </div>
                        <div class="row">
                            
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
        var regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
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
