<?php
	include('init.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
	<title>Upload Annual Records</title>
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
                                    <strong>Upload Annual Report</strong> 
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="submit.php" method="POST" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data" class="form-horizontal">
                                            
										
											
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Annual Records*</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" name="file"  accept=".csv" class="form-control">
                                                    <input name="sid"  value="<?php echo $_SESSION['id']?>" class="form-control" hidden>
													</div>
                                            </div>
											<button type="submit" id = "submit"name="import" class="btn btn-success btn-sm">
                                            <i class="zmdi zmdi-upload"></i> Import
                                        </button>
										<button type="submit" id = "submit"name="export" class="btn btn-warning btn-sm">
                                            <i class="zmdi zmdi-download"></i> Export
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
					<?php include('components/footer.html'); ?>
                </div>
            </div>
        </div>

    </div>
	
	<script>
    $('#submit').click(function(event) {
        var val = $('input[type=file]').val().toLowerCase();
        var regex = new RegExp("(.*?)\.(csv)$");
        if(!(regex.test(val))) {
            $('.uploadExtensionError').show();
            event.preventDefault();
        }
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#frmCSVImport").on("submit", function () {

            $("#response").attr("class", "");
            $("#response").html("");
            var fileType = ".csv";
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
            if (!regex.test($("#file").val().toLowerCase())) {
                    $("#response").addClass("error");
                    $("#response").addClass("display-block");
                $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                return false;
            }
            return true;
        });
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
