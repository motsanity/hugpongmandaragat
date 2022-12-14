<?php
	include('init.php');
	include('privilege.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>User List</title>
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
									<i class="icon zmdi zmdi-accounts"></i>
									<span>User List</span>
								
								</h3>
								<div class="table-data__tool">
									<div class="table-data__tool-left">
	                                    <div class="rs-select2--light rs-select2--lg">
	                                        <select class="js-select2" name="member-status" id="member-status">
	                                            <option value="0" selected="selected">All</option>
	                                            <option value="1">Active Members</option>
	                                            <option value="2">Inactive Members</option>
												<option value="3">Deceased Members</option>
												<option value="4">Administrators</option>
												<option value="5">Encoders</option>
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
									include("users_pagination.php");?>
								
									</div> 
								</div>
							</div>
						</div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
								<?php if(isset($_SESSION['message'])):?>
									<div class = "alert alert-<?php echo $_SESSION['msg_type']; ?>">
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
												<th class="text-center text-nowrap">Status</th>
												<th class="text-center text-nowrap">Action</th>
                                                <th class="text-left text-nowrap">Date Joined</th>
                                                <th class="text-left text-nowrap">Image</th>
												<th class="text-left text-nowrap">User Code</th>
                                                <th class="text-left text-nowrap">First Name</th>
												<th class="text-left text-nowrap">Middle Name</th>
                                                <th class="text-left text-nowrap">Last Name</th>
												<th class="text-left text-nowrap">Suffix</th>
												<th class="text-left text-nowrap">Date of Birth</th>
												<th class="text-left text-nowrap">Email</th>
												<th class="text-left text-nowrap">Phone</th>
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
	<script src="js/users_js.js"></script>
    <script src="js/main.js"></script>
	<script type="text/javascript">
		
	</script>
</body>

</html>
<!-- end document-->
