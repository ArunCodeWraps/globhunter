<?php 
ob_start(); 
session_start();
include('include/config.php');
include("include/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="RedstarHospital" />
	<title>Globhunter CRM</title>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet"
	type="text/css" />
	<link rel="stylesheet" href="assets/plugins/iconic/css/material-design-iconic-font.min.css">
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
	<link rel="stylesheet" href="assets/css/pages/login.css">
	<link rel="shortcut icon" href="https://www.einfosoft.com/templates/admin/smart/source/assets/img/favicon.ico" />
</head>
<body>
<div class="main">
<section class="sign-in">
	<div class="container">
		<div class="signin-content">
			<div class="signin-image">
				<figure><img src="assets/img/pages/signin.jpg" alt="sing up image"></figure>
			</div>
			<div class="signin-form">
				<h2 class="form-title">Login</h2>
				<p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:14px;color:#e50e0a"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p>
				<form name="loginform" id="loginform" method="post" action="login.php">
					<input type="hidden" name="logged" value="yes" />
					<div class="form-group">
						<div class="">

							<input name="username" type="text" value="" class="required email form-control input-height" id="username" Placeholder="User Name" /> </div>
						</div>
						<div class="form-group">
							<div class="">
								<input  name="password" id="userpass" type="password" value="" class="required form-control input-height" Placeholder="Password"/>
							</div>
							</div>
							<div class="form-group form-button">
								<button class="btn btn-round btn-primary" name="signin" id="signin">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#loginform").validate();
		})
	</script>
	<style type="text/css">
		.error{
			color: red;
		}
	</style>
</body>
</html>