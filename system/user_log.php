<?php
	include('init.php');
	include('privilege.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>User Logs</title>
	<?php include("components/head_assets.html"); ?>
	<style type="text/css">
		#ajax-table img, #imageModal img{
			object-fit: cover;
		}
		#ajax-table img {
			height: 50px;
			width: 50px;
		}
		#imageModal img {
			height: 470px;
			width: 470px;
		}
		#ajax-table img:hover {
			cursor: pointer;
		}
	</style>
	
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php include('components/navbar.html'); ?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="title-1 m-b-20">
									<i class="icon zmdi zmdi-settings"></i>
									<span>User Log</span>
								</h3>
								<div class="table-data__tool">
									<div class="table-data__tool-left">
	                                    <div class="rs-select2--light rs-select2--lg">
	                                        <select class="js-select2" name="member-status" id="member-status">
	                                            <option value="1" selected>Donations</option>
	                                            <option value="2">Withdrawals</option>
												<option value="3">Claims</option>
												<option value="12">Annual Fee Payment</option>
												<option value="4">User Status/Privilege Tagging</option>
												<option value="5">Updating of Claim Classifications</option>
												<option value="11">Updating of Fees</option>
												<option value="6">Updating of Member Documents</option>
												<option value="7">Registration of Members</option>
												<option value="8">Updating of Profile Picture</option>
												<option value="9">Log In</option>
												<option value="10">Log Out</option>
	                                        </select>
	                                        <div class="dropDownSelect2"></div>
	                                    </div>
	                                </div>
								</div>
							</div>
	                    </div>		                            	
						<div class="row" id="pagination"> 
							<div class="col-lg-12">
								<div class="row ">
									<span class="col-lg-1 d-inline align-middle">Page</span>
									<div class="col-lg-11 d-inline align-middle" id="pages"> 
								<?php $mode = false;
									$action = 1;
									include("log_pagination.php");?>
								
									</div> 
								</div>
							</div>
						</div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
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
								
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3" id="ajax-table">
										<thead>
                                            <tr>
												<th class="text-center text-nowrap">Date</th>
												<th class="text-center text-nowrap">Action</th>
												<th id="action" class="text-center">Description</th>
                                                <th id="encoder" class="text-center text-nowrap">Encoder</th>
												<th id="member" class="text-center text-nowrap">Member</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
								</div>
                            </div>
                            <!-- END DATA TABLE-->
						</div>
						<?php include('components/footer.html'); ?>      
                    </div>
                </div>
            </div>
        </div>
		<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title" id="smallmodalLabel">
							<i class="fa fa-photo"></i> User Image 
						</span>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<img src=""/>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
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
	<script src="js/log_js.js"></script>
    <script src="js/main.js"></script>
	<script type="text/javascript">
		
	</script>
</body>

</html>
<!-- end document-->
