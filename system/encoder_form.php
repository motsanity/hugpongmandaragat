<?php
	include('init.php');
	include('privilege.php');
	include('privilege_encoder.php');
	
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>Register Encoder</title>
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
                                <div class="card">
									
                                    <div class="card-header">
                                        <strong>Encoder Registration</strong> 
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="submit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-email" class=" form-control-label">Email <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="hf-email" name="email" placeholder="Ex. timothy@yahoo.com" class="form-control">
                                                    
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-email" class=" form-control-label">Mobile Number <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="" maxlength="11" name="phone" placeholder=" Ex. 09294210392" class="form-control" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="hf-password" name="password" placeholder="Enter Password..." class="form-control" required>
                                                    
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Re-type Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="hf-password" name="repassword" placeholder="Re-type Password" class="form-control" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">First Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="first_name" placeholder="Ex. Juan" class="form-control" required>
                                                    
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Middle Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="middle_name" placeholder="(Optional)" class="form-control">
                                                    
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Last Name<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="last_name" placeholder="Ex. Dejesus" class="form-control"required>
                                                    
                                                </div>
                                            </div>

											 <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Suffix</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="suffix" placeholder="(Optional)" class="form-control">
                                                    
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Date of Birth <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" maxlength="10" name="date_of_birth" placeholder="YYYY-MM-DD" class="form-control" required>
                                                    
                                                </div>
                                            </div>
											
											<input type="text" value="<?php echo $_SESSION["id"]; ?>" name="encoder_id" hidden />
											<input type="text" value="1" name="privilege" hidden />
											
											<button type="submit" id = "submit"name="ecform_submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Register
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
        var regex = new RegExp("(.*?)\.(pdf|docx|doc|xls|xlsx|jpeg|png|jpg)$");
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
