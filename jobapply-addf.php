<?php
session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();


if($_REQUEST['submitForm']=='yes')
{	

	$candidate_name=$obj->escapestring($_POST['candidate_name']);
	$candidate_email=$obj->escapestring($_POST['candidate_email']);
	$candidate_phone=$obj->escapestring($_POST['candidate_phone']);
	$candidate_country_id=$obj->escapestring($_POST['candidate_country_id']);
	$candidate_linkdin=$obj->escapestring($_POST['candidate_linkdin']);
	$candidate_portfoliow=$obj->escapestring($_POST['candidate_portfoliow']);
	$candidate_screening_ans=$obj->escapestring($_POST['candidate_screening_ans']);
	$payment=$obj->escapestring($_POST['payment']);

	$fileNameNew='';
	if($_FILES['image_upload_file']['tmp_name'])
	{     

		$file = $_FILES['image_upload_file']['name'];
		$fileNameNew = rand(333, 999).time().$file;
		
		$moved = move_uploaded_file($_FILES['image_upload_file']['tmp_name'],getcwd().'/'."upload_images/candidate/".$fileNameNew);  
	} 

	if($_REQUEST['id']==''){
		$obj->query("insert into $tbl_job_application set rec_id='".$_SESSION['sess_admin_id']."',job_id='".$_REQUEST['jid']."',candidate_name='$candidate_name',candidate_email='$candidate_email',candidate_phone='$candidate_phone',candidate_country_id='$candidate_country_id',candidate_linkdin='$candidate_linkdin',candidate_portfoliow='$candidate_portfoliow',candidate_screening_ans='$candidate_screening_ans',payment='$payment',candidate_resume='$fileNameNew' ",$debug==-1); //die;
		$_SESSION['sess_msg']='Company added sucessfully'; 

	}else{ 
		$sql = "update $tbl_job_application set candidate_name='$candidate_name',candidate_email='$candidate_email',candidate_phone='$candidate_phone',candidate_country_id='$candidate_country_id',candidate_linkdin='$candidate_linkdin',candidate_portfoliow='$candidate_portfoliow',candidate_screening_ans='$candidate_screening_ans',payment='$payment'";

		if($fileNameNew!=''){
			$sql .=",candidate_resume='$fileNameNew'";
		}

		$sql .= "where id='".$_REQUEST['id']."'";
		$obj->query($sql);
		$_SESSION['sess_msg']='Company updated sucessfully';   
	}
header("location:jobapply-list.php?jid=".$_REQUEST['jid']);
exit();
}      	      
if($_REQUEST['id']!='')
{
	$sql=$obj->query("select * from $tbl_job_application where id=".$_REQUEST['id'],$debug=-1);
	$result=$obj->fetchNextObject($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('head.php') ?>
	<link href="assets/plugins/dropzone/dropzone.css" rel="stylesheet" media="screen">
</head>
<body
class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
<div class="page-wrapper">
	<?php include("topmenu.php"); ?>
	<div class="page-container">
		<div class="sidebar-container">
			<?php include("sidemenu.php"); ?>
		</div>
		<div class="page-content-wrapper">
			<div class="page-content">
				<div class="page-bar">
					<div class="page-title-breadcrumb">
						<div class=" pull-left">
							<div class="page-title">Add Job Application <br> <span style="color:#6673fc; font-size: 15px;">For <?php echo getField('job_title',$tbl_jobs,$_REQUEST['jid']) ?></span></div>
						</div>
						<ol class="breadcrumb page-breadcrumb pull-right">
							<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
								href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
							</li>
							<li><a class="parent-item" href="jobapply-list.php?jid=<?php echo $_REQUEST['jid']; ?>">Job Application List</a>&nbsp;<i class="fa fa-list"></i>
							</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card-box">
							<div class="card-head">
								<header>Basic Information</header>
								<button id="panel-button"
								class="mdl-button mdl-js-button mdl-button--icon pull-right"
								data-upgraded=",MaterialButton">
							</button>
						</div>
						<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">	
							<input type="hidden" name="submitForm" value="yes" />
							<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />	
							<input type="hidden" name="jid" value="<?php echo $_REQUEST['jid'];?>" />	
							<div class="card-body row">
								<div class="col-lg-4 p-t-20">
									<div
									class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
									<input class="mdl-textfield__input" type="text" id="candidate_name" name="candidate_name" value="<?php echo $result->candidate_name ?>" required>
									<label class="mdl-textfield__label">Condidate Name *</label>
								</div>
							</div>
							<div class="col-lg-4 p-t-20">
								<div
								class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
								<input class="mdl-textfield__input" type="email" id="candidate_email" name="candidate_email" value="<?php echo $result->candidate_email ?>"required>
								<label class="mdl-textfield__label"> Candidate's email *</label>
							</div>
						</div>
						<div class="col-lg-4 p-t-20">
							<div
							class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<input class="mdl-textfield__input" type="text"
							pattern="-?[0-9]*(\.[0-9]+)?" id="candidate_phone" name="candidate_phone" value="<?php echo $result->candidate_phone ?>"required>
							<label class="mdl-textfield__label" for="text5">Candidate's phone number *</label>
						</div>
					</div>
					<div class="col-lg-3 p-t-20">
						<div
						class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
						<label for="list2" class="mdl-textfield__label">Country</label>
						<select class="mdl-textfield__input" name="candidate_country_id" id="candidate_country_id">
							<?php $cityArr=$obj->query("select * from $tbl_country where status=1 ",$debug=-1);
							while($resultCity=$obj->fetchNextObject($cityArr)){?>
								<option value="<?php echo $resultCity->id; ?>"<?php if($result->candidate_country_id==$resultCity->id){?>selected<?php } ?>><?php echo $resultCity->country; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-3 p-t-20">
					<div
					class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
					<input class="mdl-textfield__input" type="text" id="candidate_linkdin" name="candidate_linkdin" value="<?php echo $result->candidate_linkdin ?>" required>
					<label class="mdl-textfield__label">Candidate's Linkedin profile *</label>
				</div>
			</div>
			<div class="col-lg-3 p-t-20">
				<div
				class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
				<input class="mdl-textfield__input" type="file" id="image_upload_file" name="image_upload_file" value="<?php echo $result->candidate_resume; ?>" <?php if($_REQUEST['id']==''){?> required <?php }?>>

				<?php if(is_file("upload_images/company/".$result->candidate_resume)){ ?>-
				<img src="upload_images/company/<?php echo $result->candidate_resume; ?>"  style="width: 26%;" /><?php } ?>
				<label class="mdl-textfield__label">Upload CV *</label>
			</div>
		</div>
		<div class="col-lg-3 p-t-20">
			<div
			class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
			<input class="mdl-textfield__input" type="text" id="payment" name="payment" value="<?php echo $result->payment ?>" required>
			<label class="mdl-textfield__label">Payment infor</label>
		</div>
	</div>
	<div class="col-lg-6 p-t-20">
		<div class="mdl-textfield mdl-js-textfield txt-full-width">
			<textarea class="mdl-textfield__input" rows="4" id="candidate_portfoliow" name="candidate_portfoliow" value=""required><?php echo $result->candidate_portfoliow ?></textarea>
			<label class="mdl-textfield__label" for="text7">Portfolio (if required)</label>
		</div>
	</div>
	<div class="col-lg-6 p-t-20">
		<div class="mdl-textfield mdl-js-textfield txt-full-width">
			<textarea class="mdl-textfield__input" rows="4" id="candidate_screening_ans" name="candidate_screening_ans" value=""required><?php echo $result->candidate_screening_ans ?></textarea>
			<label class="mdl-textfield__label" for="text7">Screening answers *</label>
		</div>
	</div>
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