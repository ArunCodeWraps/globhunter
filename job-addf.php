<?php
session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();


if($_REQUEST['submitForm']=='yes')
{	

$company_id=$obj->escapestring($_POST['company_id']);
$job_code=$obj->escapestring($_POST['job_code']);
$job_title=$obj->escapestring($_POST['job_title']);
$job_description=$obj->escapestring($_POST['job_description']);
$salary=$obj->escapestring($_POST['salary']);
$position=$obj->escapestring($_POST['position']);
$job_land_id=implode(',',$_POST['job_land_id']);
$job_location=$obj->escapestring($_POST['job_location']);
$view=$obj->escapestring($_POST['view']);
$job_pioratiry=$obj->escapestring($_POST['job_pioratiry']);
$no_of_position=$obj->escapestring($_POST['no_of_position']);


if($_REQUEST['id']=='')
{
	$obj->query("insert into $tbl_jobs set sales_id='".$_SESSION['sess_admin_id']."',company_id='$company_id',job_code='$job_code',job_title='$job_title',job_description='$job_description',salary='$salary',position='$position',job_land_id='$job_land_id',job_location='$job_location',view='$view',job_pioratiry='$job_pioratiry',no_of_position='$no_of_position' ",$debug=-1);//die;
	$_SESSION['sess_msg']='Job added sucessfully';  
}
else
{ 
	$obj->query("update $tbl_jobs set company_id='$company_id',job_code='$job_code',job_title='$job_title',job_description='$job_description',salary='$salary',position='$position',job_land_id='$job_land_id',job_location='$job_location',view='$view',job_pioratiry='$job_pioratiry',no_of_position='$no_of_position' where id=".$_REQUEST['id']);
	$_SESSION['sess_msg']='Job updated sucessfully';   
}
	header("location:job-list.php");
	exit();
}      	      
if($_REQUEST['id']!='')
{
	$sql=$obj->query("select * from $tbl_jobs where id=".$_REQUEST['id'],$debug=-1);
	$result=$obj->fetchNextObject($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('head.php') ?>
	<link href="assets/plugins/dropzone/dropzone.css" rel="stylesheet" media="screen">
	<link href="assets/plugins/summernote/summernote.css" rel="stylesheet">
	 <link rel="stylesheet" href="assets/css/select2.min.css">
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
								<div class="page-title">Job Add</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="job-list.php">Job List</a>&nbsp;<i class="fa fa-list"></i>
								</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Job Information</header>
									<button id="panel-button"
										class="mdl-button mdl-js-button mdl-button--icon pull-right"
										data-upgraded=",MaterialButton">
										
									</button>
								
								</div>
								<form name="frm" id="countryfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">	
							<input type="hidden" name="submitForm" value="yes" />
							<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />	
								<div class="card-body row">
									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label for="simpleFormEmail">Company</label>
											<select class="form-select required"  name="company_id"  id="company_id" >
												<option value="">Select</option>
												<?php
												if($_SESSION['user_type']=='admin'){
												$cSql = $obj->query("select id,name from $tbl_company where status=1");
												}else{
												$cSql = $obj->query("select id,name from $tbl_company where user_id='".$_SESSION['sess_admin_id']."' and status=1");
												}
												while($cResult = $obj->fetchNextObject($cSql)){?>
													<option value="<?php echo $cResult->id; ?>" <?php if($cResult->id==$result->company_id){?> selected <?php } ?>><?php echo $cResult->name; ?></option>
												<?php }?>
											</select>
										</div>
								    </div>

								    <div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label for="simpleFormEmail">Job Code</label>
											<input class="form-control" type="text" id="job_code" name="job_code" value="<?php echo $result->job_code ?>" required>
										</div>
								    </div>
								    <div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label for="simpleFormEmail">Job Title</label>
											<input class="form-control" type="text" id="job_title" name="job_title" value="<?php echo $result->job_title ?>" required>
										</div>
								    </div>



									<div class="col-lg-12 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail">Job Description</label>
											<textarea name="job_description" id="formsummernote" class="form-control" required><?php echo $result->job_description ?></textarea>
										</div>
									</div>


									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail">Salary($)</label>
											<input class="form-control" type="number" id="salary" name="salary" value="<?php echo $result->salary ?>" required>
										</div>
									</div>
									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail">Position</label>
											<input class="form-control" type="text" id="position" name="position" value="<?php echo $result->position ?>" required>
										</div>
									</div>

									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail">Job Pioratiry</label>
											<select class="form-control"  name="job_pioratiry"  id="job_pioratiry" >							
												<option value="1" <?php if($result->job_pioratiry=='1'){?> selected <?php } ?>>Normal</option>
												<option value="2" <?php if($result->job_pioratiry=='2'){?> selected <?php } ?>>Urgent</option>
											</select>
										</div>
									</div>
									
									<div class="col-lg-4 p-t-20">
									<div class="form-group">
										<label class="simpleFormEmail">Language Profile</label>
									<select class="form-control select2"  name="job_land_id[]"  id="job_land_id" multiple>							
											<option value="">Select</option>
												<?php
												$lanArr = explode(',',$result->job_land_id);
												$lSql = $obj->query("select id,name from $tbl_language where status=1");
												while($lResult = $obj->fetchNextObject($lSql)){?>
													<option value="<?php echo $lResult->id; ?>" <?php if(in_array($lResult->id,$lanArr)){?> selected <?php } ?>><?php echo $lResult->name; ?></option>
												<?php }?>
									</select>
									</div>
									</div>
									
									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail"> Job Location</label>
											<input class="form-control" type="text" id="job_location" name="job_location" value="<?php echo $result->job_location ?>"required>
										</div>
									</div>


									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail"> No of Required Candidate</label>
											<input class="form-control" type="number" name="no_of_position" value="<?php echo $result->no_of_position ?>"required>
										</div>
									</div>
									
									
									<div class="col-lg-12 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail" for="text7">View</label>
											<textarea class="form-control" rows="4" id="view" name="view" value=""required><?php echo $result->view ?></textarea>
										</div>
									</div>
							<!-- 	<div class="col-lg-12 p-t-20">
										<label class="control-label col-md-3">Course Photo
										</label>
										<div class="col-md-12">
											<div id="id_dropzone" class="dropzone">
												<input type="file" name="image_upload_file">
											</div>
										</div>
									</div> -->
						
										
									<div class="col-lg-12 p-t-20 text-center">
										<button type="submit"
											class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary">Submit</button>
										<button type="button"
											class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Cancel</button>
									</div>
								</div>
							</form>

							</div>
						</div>
					</div>
					<
				</div>
			</div>

		</div>
		<div class="page-footer">
			<?php include("footer.php"); ?>
		</div>
	</div>

</body>
	<script src="assets/plugins/dropzone/dropzone.js"></script>
	<script src="assets/plugins/dropzone/dropzone-call.js"></script>
	<script src="assets/plugins/summernote/summernote.js"></script>
	<script src="assets/js/pages/summernote/summernote-data.js"></script>
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