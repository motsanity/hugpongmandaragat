<?php
	include('init.php');
	include('privilege.php');
?>
<!DOCTYPE html>
<html lang="en">

	<head>
	    <title>Dashboard</title>
		<?php include("components/head_assets.html"); ?>
	</head>

	<body class="animsition">
		<?php
			include("dashboard.php");
		?>
	    <div class="page-wrapper">
	         <?php include('components/navbar.html');?>

	            <!-- MAIN CONTENT-->
	            <div class="main-content">
	                <div class="section__content section__content--p30">
	                    <div class="container-fluid">
							<?php if($_SESSION['privilege'] == 3):?>
	                        <div class="row">
	                            <div class="col-md-12">
	                                <h3 class="title-1">
										<i class="icon fa fa-th"></i>
										<span>Overview</span>
									</h3>
	                            </div>
	                        </div>
	                        <div class="row m-t-25">
	                            <div class="col-md-6 offset-md-3" id="outstanding">
	                                <div class="card bg-flat-color-1">
	                                    <div class="card-body">
		                                    <div class="overview-box clearfix">
		                                        <div class="icon align-middle">
		                                            <i class="zmdi zmdi-money-box"></i>
		                                        </div>
		                                        <div class="text align-middle">
		                                            <h2 class="card-text text-light data"></h2>
		                                        </div>
		                                    </div>
	                                        <span class="card-text text-light">Outstanding Funds</span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-md-6" id="donations">
	                                <div class="card bg-flat-color-5">
	                                    <div class="card-body">
		                                    <div class="overview-box clearfix">
		                                        <div class="icon align-middle">
		                                            <i class="zmdi zmdi-money"></i>
		                                        </div>
		                                        <div class="text align-middle">
		                                            <h2 class=" card-text text-light data text-truncate"></h2>
		                                        </div>
		                                    </div>
	                                        <span class="card-text text-light">Total Donations</span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-md-6" id="withdrawals">
	                                <div class="card bg-flat-color-4">
	                                    <div class="card-body">
		                                    <div class="overview-box clearfix">
		                                        <div class="icon align-middle">
		                                            <i class="zmdi zmdi-money-off"></i>
		                                        </div>
		                                        <div class="text align-middle">
		                                            <h2 class="card-text text-light data"></h2>
		                                        </div>
		                                    </div>
	                                        <span class="card-text text-light">Total Withdrawals</span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-md-6" id="claims">
	                                <div class="card bg-flat-color-3">
	                                    <div class="card-body">
		                                    <div class="overview-box clearfix">
		                                        <div class="icon align-middle">
		                                            <i class="zmdi zmdi-money"></i>
		                                        </div>
		                                        <div class="text align-middle">
		                                            <h2 class="card-text text-light data"></h2>
		                                        </div>
		                                    </div>
	                                        <span class="card-text text-light">Total Claims</span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-md-6" id="users">
	                                <div class="card bg-flat-color-2">
	                                    <div class="card-body">
		                                    <div class="overview-box clearfix">
		                                        <div class="icon align-middle">
		                                            <i class="zmdi zmdi-accounts-alt"></i>
		                                        </div>
		                                        <div class="text align-middle">
		                                            <h2 class="card-text text-light data"></h2>
		                                        </div>
		                                    </div>
	                                        <span class="card-text text-light">Total Members</span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-md-6" id="membership">
	                                <div class="card bg-flat-color-6">
	                                    <div class="card-body">
		                                    <div class="overview-box clearfix">
		                                        <div class="icon align-middle">
		                                            <i class="zmdi zmdi-accounts-add"></i>
		                                        </div>
		                                        <div class="text align-middle">
		                                            <h2 class="card-text text-light data"></h2>
		                                        </div>
		                                    </div>
	                                        <span class="card-text text-light">Membership Fees Collected</span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-md-6" id="annual">
	                                <div class="card bg-flat-color-7">
	                                    <div class="card-body">
		                                    <div class="overview-box clearfix">
		                                        <div class="icon align-middle">
		                                            <i class="zmdi zmdi-account-add"></i>
		                                        </div>
		                                        <div class="text align-middle">
		                                            <h2 class="card-text text-light data"></h2>
		                                        </div>
		                                    </div>
	                                        <span class="card-text text-light">Annual Fees Collected</span>
	                                    </div>
	                                </div>
	                            </div>
							</div>
							<?php endif?>
							<?php if($_SESSION['privilege'] == 3):?>
							<div class="row">
	                            <div class="col-lg-12">
	                                <div class="au-card recent-report">
	                                    <div class="au-card-inner">
	                                        <h3 class="title-2 m-b-30">Recent Financial Activity</h3>
	                                        <div class="recent-report__chart">
	                                            <canvas id="recent-fin-rep-chart" ></canvas>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
							<?php endif?>
							<div class="row">
	                            <div class="col-md-12">
									<h3 class="title-4">
										<i class="fa fa-list-alt"></i>
										Financial Status</h3>
	                                <!-- DATA TABLE-->
										<div class="row" id="pagination"> 
											<div class="col-md-12 m-t-30">
												<div class="row ">
													<span class="col-md-1 d-inline align-middle">Page</span>
													<div class="col-md-11 d-inline align-middle"> 
												<?php $mode = false;
													include("pagination.php");?>
												<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
													if($i == 1):?>
										            <button id="<?php echo $i ?>" class="btn btn-sm btn-success"><?php echo $i;?></button>
													<?php else:?>
													<button id="<?php echo $i ?>" class="btn btn-sm btn-outline-success"><?php echo $i;?></button>
												<?php endif;?>			
												<?php endfor;endif;?> 
													</div> 
												</div>
										</div>
									</div>
								</div>
	                        </div>
							
	                        <div class="row m-t-30">
	                            <div class="col-md-12">
	                                <!-- DATA TABLE-->
	                                <div class="table-responsive m-b-40">
	                                    <table class="table table-borderless table-data3" id="ajax-table">
											
											<thead>
	                                            <tr>
	                                                <th>Date</th>
	                                                <th>Transaction</th>
	                                                <th>Amount</th>
	                                                <th>Balance</th>
													<th class="text-center">Remarks</th>
													<th class="text-left">Encoder</th>
													<th class="text-left">Member</th>
													
	                                            </tr>
	                                        </thead>
	                                        <tbody>
												
	                                        </tbody>
	                                    </table>
									</div>
	                            </div>
                                <!-- END DATA TABLE-->
							</div>
	                        <?php include('components/footer.html'); ?>
	                    </div>
	            </div>
	            <!-- END MAIN CONTENT-->
	            <!-- END PAGE CONTAINER-->
	        </div>

	    </div>
	    <?php include("components/body_assets.html"); ?>
	</body>

</html>
<!-- end document-->
