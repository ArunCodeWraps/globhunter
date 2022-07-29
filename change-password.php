<?php 
ob_start(); 
session_start();
include('include/config.php');
include("include/functions.php");
validate_admin();

if($_POST['submitForm'] == "yes") {
  $old_password=$obj->escapestring($_POST['old_password']);
  $new_password=$obj->escapestring($_POST['new_password']);
  $confirm_password=$obj->escapestring($_POST['confirm_password']);

  if($new_password==$confirm_password){
    $query=$obj->query("select * from $tbl_users where id=".$_SESSION['sess_admin_id'],$debug=-1);//die;
    $result=$obj->fetchNextObject($query);

    if($old_password!=$result->password){ 
     $_SESSION['sess_msg']='Old Password is Wrong !';
    }else{
      $obj->query("update $tbl_users set password='$new_password' where id=".$_SESSION['sess_admin_id']);
      $_SESSION['sess_msg']='Your password has been updated successfully !';
    }
  }else{
    $_SESSION['sess_msg']='Both password are not same!';
  }
}
if($_SESSION['sess_admin_id']){
  $sql=$obj->query("select * from $tbl_users where id=".$_SESSION['sess_admin_id']);
  $result=$obj->fetchNextObject($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('head.php') ?>
</head>
<body
	class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
	<div class="page-wrapper">
		<?php include("topmenu.php"); ?>
		<div class="page-container">
			<!-- start sidebar menu -->
			<div class="sidebar-container">
				<?php include("sidemenu.php"); ?>
			</div>
			<!-- end sidebar menu -->
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Change Password</div>
							</div>
							 <div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#6673fc;margin-right: -60%;"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Change Password</li>
							</ol>
						</div>
					</div>
					<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
					<input type="hidden" name="submitForm" value="yes" />
					<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-body row">
									<div class="col-lg-6 p-t-20">
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input class="mdl-textfield__input" name="old_password" type="password" id="old_password"  value="<?php echo $_POST['old_password']; ?>">
											<label class="mdl-textfield__label">Old  Password</label>
										</div>
									</div>
								</div>
								<div class="card-body row">
									<div class="col-lg-6 p-t-20">
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input class="mdl-textfield__input" type="text" id="txtCourseCode" name="new_password" type="password" id="new_password"  value="<?php echo $_POST['new_password']; ?>">
											<label class="mdl-textfield__label">New Password</label>
										</div>
									</div>
								</div>
								<div class="card-body row">
									<div class="col-lg-6 p-t-20">
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input class="mdl-textfield__input" name="confirm_password" type="password" id="confirm_password"  value="<?php echo $_POST['confirm_password']; ?>">
											<label class="mdl-textfield__label">Confirm Password</label>
										</div>
									</div>
						
	
									<div class="col-lg-12 p-t-20 text-center">
										<button type="submit"
											class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary">Change Password</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</from>
				</div>
			</div>

		</div>
		<div class="page-footer">
			<?php include("footer.php"); ?>
		</div>
	</div>
</body>
</html>