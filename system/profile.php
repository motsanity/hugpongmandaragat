<?php
	include('init.php');
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Profile</title>
		<?php include("components/head_assets.html"); ?>
		<style type="text/css">
			.card img{
				object-fit: cover;
				height: 50px;
				width: 50px;
			}
		</style>
	</head>

	<body class="animsition">
	    <div class="page-wrapper">
	         <?php include('components/navbar.html');?>

	            <!-- MAIN CONTENT-->
	            <div class="main-content">
	                <div class="section__content section__content--p30">
	                    <div class="container-fluid">
						 <div class="row">
	                            <div class="col-md-12">
	                                
	                            </div>
	                        </div>
							<div class="row">
								<div class="col-lg-12 m-t-20">
	                                <div class="card">
	                                    <div class="card-header">
	                                        <strong>Account Information</strong>
	                                    </div>
	                                    <div class="card-body card-block">
											<div class="row form-group">
												<div class="col col-md-12 ">
												<?php if ($row_account["img_path"] != NULL):?>
											 	   <img src="<?php echo $row_account['img_path']?>" alt="Profile Picture" style=" border-radius: 10%;width:150px; height:150px; background-position: center center; background-repeat: no-repeat;">	
												<?php endif?>
												<?php if ($row_account["img_path"] == NULL):?>
													<i class="icon zmdi zmdi-account-circle"></i>
													<span>Profile</span>
												<?php endif?>
												</div>
											</div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>First Name</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $row_account["first_name"]?></p>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>Middle Name</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $row_account["middle_name"]?></p>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>Last Name</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $row_account["last_name"]?></p>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>Suffix</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $row_account["suffix"]?></p>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>Date of Birth</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo date("F d, Y", strtotime($row_account["date_of_birth"])); ?></p>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>User Name</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $row_account["user_name"]?></p>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>Email Address</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $row_account["email"]?></p>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label"><b>Phone Number</b>:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $row_account["phone"]?></p>
                                                </div>
                                            </div>
	                                    </div>
									</div>	
	                            </div>
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
	                                        <strong>Attachments & Documents</strong>
											<?php include ("docs.php"); ?>
	                                    </div>
										<div class="card-body">
											<?php if ($has_attachments) {
												if (file_exists($row_docs["appform_path"]) && is_file($row_docs['appform_path'])) {
											?>
	                                        <a class="btn btn-sm btn-outline-primary" target="_blank" href='<?php echo $row_docs["appform_path"]?>'>
	                                            <i class="fa fa-link"></i>&nbsp; Application Form
											</a>
											<?php }
												if (file_exists($row_docs["passport_path"]) && is_file($row_docs['passport_path'])) {
											?>
	                                        <a class="btn btn-sm btn-outline-primary" target="_blank" href='<?php echo $row_docs["passport_path"]?>'>
	                                            <i class="fa fa-link"></i>&nbsp; Passport
											</a>
											<?php } if (file_exists($row_docs["nso_path"]) && is_file($row_docs['nso_path'])) {
											?>
	                                        <a class="btn btn-sm btn-outline-primary" target="_blank" href='<?php echo $row_docs["nso_path"]?>'>
	                                            <i class="fa fa-link"></i>&nbsp; NSO Birth Certificate 
											</a>
											<?php } if (file_exists($row_docs["mc_path"]) && is_file($row_docs['mc_path'])) {
											?>
	                                        <a class="btn btn-sm btn-outline-primary" target="_blank" href='<?php echo $row_docs["mc_path"]?>'>
	                                            <i class="fa fa-link"></i>&nbsp; Marriage Contract
											</a>
											<?php } if (file_exists($row_docs["sbook_path"]) && is_file($row_docs['sbook_path'])) {
											?>
	                                        <a class="btn btn-sm btn-outline-primary" target="_blank" href='<?php echo $row_docs["sbook_path"]?>'>
	                                            <i class="fa fa-link"></i>&nbsp; Seaman's Book
											</a>
											<?php } if (file_exists($row_docs["other_path"]) && is_file($row_docs['other_path'])) {
											?>
	                                        <a class="btn btn-sm btn-outline-primary" target="_blank" href='<?php echo $row_docs["other_path"]?>'>
	                                            <i class="fa fa-link"></i>&nbsp; Other Document
											</a>
											<?php } ?>
	                                  	  	<?php } else {?>
											<p>No attachments available.</p>
											<?php }?>
	                                    </div>
									</div>
								</div>
							</div>
							<hr class="line-separate">
						    <section class="statistic statistic2 m-t-0 p-0">
								<?php include('personal_dashboard.php'); ?>
								   <h3 class="title-4">Personal Financial Report</h3>
			                       <div class="row m-t-20">
			                           <div class="col-md-6 col-lg-4">
			                               <div class="statistic__item statistic__item--blue">
			                                   <h2 class="number" id="outstanding"></h2>
			                                   <span class="desc">Outstanding Funds</span>
			                                   <div class="icon">
			                                       <i class="zmdi zmdi-money-box"></i>
			                                   </div>
			                               </div>
			                           </div>
			                           <div class="col-md-6 col-lg-4">
			                               <div class="statistic__item statistic__item--green">
			                                   <h2 class="number" id="donations"></h2>
			                                   <span class="desc">Total Donations</span>
			                                   <div class="icon">
			                                       <i class="zmdi zmdi-money"></i>
			                                   </div>
			                               </div>
			                           </div>
			                           <div class="col-md-6 col-lg-4">
			                               <div class="statistic__item statistic__item--orange">
			                                   <h2 class="number" id="withdrawals"></h2>
			                                   <span class="desc">Total Withdrawals</span>
			                                   <div class="icon">
			                                       <i class="zmdi zmdi-money-off"></i>
			                                   </div>
			                               </div>
			                           </div>
			                           <div class="col-md-6 col-lg-4 offset-md-2">
			                               <div class="statistic__item statistic__item--yellow">
			                                   <h2 class="number" id="claims"></h2>
			                                   <span class="desc">Total Claims</span>
			                                   <div class="icon">
			                                       <i class="zmdi zmdi-money"></i>
			                                   </div>
			                               </div>
			                           </div>
			                           <div class="col-md-6 col-lg-4">
			                               <div class="statistic__item statistic__item--red">
			                                   <h2 class="number" id="deductions"></h2>
			                                   <span class="desc">Total Deductions</span>
			                                   <div class="icon">
			                                       <i class="zmdi zmdi-money-off"></i>
			                                   </div>
			                               </div>
			                           </div>
			                       </div>
			                  
			               </section>
							<div class="row">
		                        <div class="col-md-12">
		                            <!-- DATA TABLE -->
									<div class="row">
										<div class="col-md-6 col-lg-4">
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
							<div class="row m-30">
	                            <div class="col-md-12">
	                                <!-- DATA TABLE-->
										<div class="row" id="pagination"> 
											<div class="col-md-12">
												<div class="row ">
													<span class="col-md-1 d-inline align-middle">Page</span>
													<div class="col-md-11 d-inline align-middle"> 
												<?php $mode = true;
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
								<div class="col-lg-12">
	                                <div class="table-responsive m-b-40" id="ajax-table">
	                                    <table class="table table-borderless table-data3">
	                                        <thead>
	                                            <tr>
	                                                <th>Date</th>
	                                                <th>Transaction</th>
	                                                <th>Amount</th>
	                                                <th>Balance</th>
													<th class="text-center">Remarks</th>
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
