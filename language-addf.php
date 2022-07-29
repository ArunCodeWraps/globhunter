<?php 
ob_start(); 
session_start();
include('include/config.php');
include("include/functions.php");
validate_admin();

  if($_REQUEST['submitForm']=='yes'){

  $name=$obj->escapestring($_POST['name']);
  if($_REQUEST['id']==''){
	  $obj->query("insert into $tbl_language set name='$name'",-1);//die;
	  $_SESSION['sess_msg']='Language added sucessfully';  
	  
       }else{ 
	  $obj->query("update $tbl_language set name='$name' where id=".$_REQUEST['id']);
	  $_SESSION['sess_msg']='Language updated sucessfully';   
        }
   header("location:language-list.php");
   exit();
  }      
	   
	   
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_language where id=".$_REQUEST['id']);
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
								<div class="page-title">Language Add</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="language-list.php">Language List</a>&nbsp;<i class="fa fa-list"></i>
								</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">	
							<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" >	
							<input type="hidden" name="submitForm" value="yes" />
							<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />					
								<div class="card-body row">
									<div class="col-lg-6 p-t-20">
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input type="text" name="name" value="<?php echo stripslashes($result->name); ?>" class="mdl-textfield__input " required >
											<label class="mdl-textfield__label">Language Name</label>
										</div>
									</div>
						
	
									<div class="col-lg-12 p-t-20 text-center">
										<button
											class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary" type="submit">Submitd</button>
											
									</div>
								</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="page-footer">
			<?php include("footer.php"); ?>
		</div>
	</div>
</body>
<script>
		$(document).ready(function(){
			$("#countryfrm").validate();
		})
	</script>
	<style type="text/css">
		.error{
			color: red;
		}
	</style>
</html>