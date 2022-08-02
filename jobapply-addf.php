<?php
session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();


if($_REQUEST['submitForm']=='yes')
{	

	$name=$obj->escapestring($_POST['name']);
	$job_title=$obj->escapestring($_POST['job_title']);
	$job_code=$obj->escapestring($_POST['job_code']);
	$linkedin=$obj->escapestring($_POST['linkedin']);
	$payment=$obj->escapestring($_POST['payment']);
	$coutnry=$obj->escapestring($_POST['coutnry']);

	$cinfo=$obj->escapestring($_POST['cinfo']);
	$contact=$obj->escapestring($_POST['contact']);
	$portfoliow=$obj->escapestring($_POST['portfoliow']);
	$note=$obj->escapestring($_POST['note']);
	$fileNameNew='';
	if($_FILES['image_upload_file']['tmp_name'])
	{     
		$path[0] = $_FILES['image_upload_file']['tmp_name'];
		$file = pathinfo($_FILES['image_upload_file']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
		$moved = move_uploaded_file($_FILES['image_upload_file']['tmp_name'],getcwd().'/'."upload_images/company/".$fileNameNew);
		if( $moved ) {
			echo "Successfully uploaded";   
		} else {
			echo "Not uploaded because of error #".$_FILES["file"]["error"];
		}     
	} 
	if($_REQUEST['id']=='')
	{

		$obj->query("insert into $tbl_job_application set candidate_name='$name',candidate_email='$cinfo',candidate_phone='$contact',candidate_country_id='$coutnry',candidate_linkdin='$linkedin',payment='$payment',candidate_portfoliow='$portfoliow',candidate_screening_ans='$note',job_title='$job_title',position_code='$job_code',candidate_resume='$fileNameNew',status=1 ",$debug=-1); //die;
		$_SESSION['sess_msg']='Company added sucessfully';  
	}
	else
	{ 

		$sql="Select logo from $tbl_jobs where id=".$_REQUEST['id'];
		$imgquery=$obj->fetchNextObject($obj->query($sql));
		if($fileNameNew!='')
		{
			$fileNameNew=$fileNameNew;
			if(!empty($imgquery->logo) || $imgquery->logo!='')
			{
				unlink("upload_images/company/".$imgquery->logo);
				unlink("upload_images/company/thumb/".$imgquery->logo);
			}
		}else{
			$fileNameNew=$_REQUEST['imagename'];
		}

		$obj->query("update $tbl_jobs set name='$name',cinfo='$cinfo',contact='$contact',address='$address',logo='$fileNameNew' where id=".$_REQUEST['id']);
		$_SESSION['sess_msg']='Company updated sucessfully';   
	}
	header("location:clinet-list.php");
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
								<header>Basic Information</header>
								<button id="panel-button"
								class="mdl-button mdl-js-button mdl-button--icon pull-right"
								data-upgraded=",MaterialButton">

							</button>

						</div>
						<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">	
							<input type="hidden" name="submitForm" value="yes" />
							<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />	
							<div class="card-body row">
								<div class="col-lg-4 p-t-20">
									<div
									class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
									<input class="mdl-textfield__input" type="text" id="name" name="name" value="<?php echo $result->name ?>" required>
									<label class="mdl-textfield__label">Recruiter's full name *</label>

								</div>
							</div>
							<div class="col-lg-4 p-t-20">
								<div
								class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
								<input class="mdl-textfield__input" type="text" id="job_title" name="job_title" value="<?php echo $result->job_title ?>" required>
								<label class="mdl-textfield__label">Job Title</label>
							</div>
						</div>
						<div class="col-lg-4 p-t-20">
							<div
							class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<input class="mdl-textfield__input" type="text" id="job_code" name="job_code" value="<?php echo $result->job_code ?>" required>
							<label class="mdl-textfield__label">Applied position code *</label>
						</div>
					</div>
					<div class="col-lg-6 p-t-20">
						<div
						class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						<input class="mdl-textfield__input" type="text" id="linkedin" name="linkedin" value="<?php echo $result->linkedin ?>" required>
						<label class="mdl-textfield__label">Candidate's Linkedin profile *</label>
					</div>
				</div>

				<div class="col-lg-6 p-t-20">
					<div
					class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
					<input class="mdl-textfield__input" type="text" id="payment" name="payment" value="<?php echo $result->payment ?>" required>
					<label class="mdl-textfield__label">Payment infor</label>
				</div>
			</div>
			<div class="col-lg-6 p-t-20">
				<div
				class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
				<label for="list2" class="mdl-textfield__label">Country</label>
				<select class="mdl-textfield__input" name="coutnry" id="country">

					<?php $cityArr=$obj->query("select * from $tbl_country where status=1 ",$debug=-1);
					while($resultCity=$obj->fetchNextObject($cityArr)){?>
						<option value="<?php echo $resultCity->id; ?>"<?php if($_POST['country_id']==$resultCity->id){?>selected<?php } ?>><?php echo $resultCity->country; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-lg-6 p-t-20">
			<div
			class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
			<input class="mdl-textfield__input" type="email" id="cinfo" name="cinfo" value="<?php echo $result->cinfo ?>"required>
			<label class="mdl-textfield__label"> Candidate's email *</label>
			<span class="mdl-textfield__error">Enter Valid Email Address!</span>
		</div>
	</div>
	<div class="col-lg-6 p-t-20">
		<div
		class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
		<input class="mdl-textfield__input" type="text"
		pattern="-?[0-9]*(\.[0-9]+)?" id="contact" name="contact" value="<?php echo $result->contact ?>"required>
		<label class="mdl-textfield__label" for="text5">Candidate's phone number *</label>
		<span class="mdl-textfield__error">Number required!</span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label>Image</label>
		<input type="hidden" name="imagename" value="<?php echo $result->logo; ?>" >
		<input type="file" name="image_upload_file" class='form-control'required /><br/>
		<?php if(is_file("upload_images/company/".$result->logo)){ ?>-
		<img src="upload_images/company/<?php echo $result->logo; ?>"  style="width: 26%;" /><?php } ?>
	</div>
</div>

<div class="col-lg-6 p-t-20">
	<div class="mdl-textfield mdl-js-textfield txt-full-width">
		<textarea class="mdl-textfield__input" rows="4" id="portfoliow" name="portfoliow" value=""required><?php echo $result->portfoliow ?></textarea>
		<label class="mdl-textfield__label" for="text7">Portfolio (if required)</label>
	</div>
</div>
<div class="col-lg-6 p-t-20">
	<div class="mdl-textfield mdl-js-textfield txt-full-width">
		<textarea class="mdl-textfield__input" rows="4" id="note" name="note" value=""required><?php echo $result->note ?></textarea>
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