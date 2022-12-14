<?php
	session_start();
?>
<html lang="en">
<head>
    <!-- Title Page-->
    <title>Login</title>
	<?php include("components/head_assets.html"); ?>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/hmlogo.png" alt="HMIS Logo">
                            </a>
							<h3>HUGPONG MANDARAGAT, INC.</h3>
                        </div>
                        <div class="login-form">
                            <?php
								if (isset($_SESSION['message'])){ ?>
								<div class = "alert alert-<?php echo $_SESSION['msg_type'];?>">
									<?php 
										echo  $_SESSION['message'];
										unset ($_SESSION['message']);
									?>
							</div>
							<?php } ?>
                            <form action="submit.php" method="POST">
								<?php if(isset($_GET['view'])==1):?>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
                                </div>
								<?php endif?>
								
								<?php if(isset($_GET['view'])!=1):?>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="user_name" placeholder="username" required>
                                </div>
								<?php endif?>
								
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password"required>
                                </div>
								
                                <?php if(isset($_GET['view'])!=1):?>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="userlogin_submit">sign in</button>
								<?php endif?>
								
								<?php if(isset($_GET['view'])==1):?>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="login_submit">sign in</button>
								<?php endif?>
								
								
								<?php if(isset($_GET['view'])!=1):?>
                                <a href="login.php?view=1"class="text-nowrap">Login using Email?</a>
								<?php endif?>
								<?php if(isset($_GET['view'])==1):?>
                                <a href="login.php"class="text-nowrap">Login using Username?</a>
								<?php endif?>
                            </form>
                            
                        </div>
                    </div>
                </div>
				<?php
					include("components/footer.html");
				?>
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
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->