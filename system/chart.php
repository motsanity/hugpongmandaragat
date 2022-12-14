<?php
	include('init.php');
	include('privilege.php');
	include('privilege_encoder.php');
?>
<!DOCTYPE html>
<html lang="en">

	<head>
	    <title>Financial Reports</title>
		<?php include("components/head_assets.html"); ?>
	</head>

	<body class="animsition">
		<?php
			include("fin_rep.php");
		?>
	    <div class="page-wrapper">
	       <?php include ('components/navbar.html');?>

	            <!-- MAIN CONTENT-->
	            <div class="main-content">
	                <div class="section__content section__content--p30">
	                    <div class="container-fluid">
							<div class="row">
		                        <div class="col-md-12">
		                            <!-- DATA TABLE -->
		                            <h3 class="title-1 m-b-20">
										<i class="icon fa fa-bar-chart-o"></i>
										<span>Financial Reports</span>
									</h3>
		                            <div class="table-data__tool align-middle">
		                                <div class="table-data__tool-left align-middle">
		                                    <div class="rs-select2--light rs-select2--sm">
		                                        <select class="js-select2" name="time" id="time">
		                                            <option value="1" selected>Monthly</option>
													<option value="2">Yearly</option>
		                                        </select>
		                                        <div class="dropDownSelect2"></div>
		                                    </div>
		                                </div>
									</div>
								</div>
							</div>
							 <div class="row" id="chart-1">   
	                            <div class="col-lg-12">
	                                <div class="au-card m-b-30">
	                                    <div class="au-card-inner">
	                                        <h3 class="title-2 m-b-20">Monthly Donations</h3>
	                                        <canvas id="monthly-chart"></canvas>
	                                    </div>
	                                </div>
	                            </div>
							</div>
	                        <div class="row" id="chart-2">
	                            <div class="col-lg-12">
	                                <div class="au-card m-b-30">
	                                    <div class="au-card-inner">
	                                        <h3 class="title-2 m-b-20">Yearly Donations</h3>
	                                        <canvas id="yearly-chart"></canvas>
	                                    </div>
	                                </div>
	                            </div>
	                         </div>
	                        <?php include('components/footer.html'); ?>
	                    </div>
	                </div>
	            <!-- END MAIN CONTENT-->
	        </div>
	        <!-- END PAGE CONTAINER-->

	    </div>
	    <?php include("components/body_assets.html"); ?>
	</body>

</html>
<!-- end document-->
