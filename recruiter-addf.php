<?php
session_start();
include("include/config.php");
include("include/functions.php"); 



if($_REQUEST['submitForm']=='yes')
{	


	$name=$obj->escapestring($_POST['name']);
	$email=$obj->escapestring($_POST['email']);
	$password=$obj->escapestring($_POST['password']);
	$mobile=$obj->escapestring($_POST['mobile']);
 	$fileNameNew='';
      if($_FILES['image_upload_file']['tmp_name'])
  {     
      $path[0] = $_FILES['image_upload_file']['tmp_name'];
      $file = pathinfo($_FILES['image_upload_file']['name']);
      $fileType = $file["extension"];
      $desiredExt='jpg';
      $fileNameNew = rand(333, 999) . time() . ".$desiredExt";

     $moved = move_uploaded_file($_FILES['image_upload_file']['tmp_name'],getcwd().'/'."upload_images/user/".$fileNameNew);
  
if( $moved ) {
  echo "Successfully uploaded";   
} else {
  echo "Not uploaded because of error #".$_FILES["file"]["error"];
}
       
    } 

	if($_REQUEST['id']=='')
	{

		$obj->query("insert into $tbl_users set name='$name',email='$email',mobile='$mobile',password='$password',image='$fileNameNew',user_type='recruiter',status=1 ",$debug=-1); //die;
		$_SESSION['sess_msg']='Recruiter added sucessfully';  
	}
	else
	{ 

		$sql="Select image from $tbl_users where id=".$_REQUEST['id'];
		$imgquery=$obj->fetchNextObject($obj->query($sql));
		if($fileNameNew!='')
		{
			$fileNameNew=$fileNameNew;
			if(!empty($imgquery->image) || $imgquery->image!='')
			{
			unlink("upload_images/user/".$imgquery->image);
			unlink("upload_images/user/thumb/".$imgquery->image);
		}
		}else{
			$fileNameNew=$_REQUEST['imagename'];
		}
   $obj->query("update $tbl_users set name='$name',email='$email',mobile='$mobile',password='$password',image='$fileNameNew' where id='".$_REQUEST['id']."'",-1);//die;

		$_SESSION['sess_msg']='Recruiter updated sucessfully';   
	}
	header("location:recruiter-list.php");
	exit();
}      	      
if($_REQUEST['id']!='')
{
	$sql=$obj->query("select * from $tbl_users where id=".$_REQUEST['id'],$debug=-1);
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
								<div class="page-title">Recruiter Add</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="recruiter-list.php">Recruiter List</a>&nbsp;<i class="fa fa-list"></i>
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
									<div class="col-lg-6 p-t-20">
										<div
											class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input class="mdl-textfield__input" type="text" id="name" name="name" value="<?php echo $result->name ?>">
											<label class="mdl-textfield__label">Recruiter Name</label>
										</div>
									</div>
									
									<div class="col-lg-6 p-t-20">
										<div
											class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input class="mdl-textfield__input" type="email" id="email" name="email" value="<?php echo $result->email ?>" required>
											<label class="mdl-textfield__label">Recruiter Email</label>
											<span class="mdl-textfield__error">Enter Valid Email Address!</span>
										</div>
									</div>
								
									
									
									
							
									<div class="col-lg-6 p-t-20">
										<div
											class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input class="mdl-textfield__input" type="text"
												pattern="-?[0-9]*(\.[0-9]+)?" id="mobile" name="mobile" value="<?php echo $result->mobile ?>" required>
											<label class="mdl-textfield__label" for="text5">Mobile Number</label>
											<span class="mdl-textfield__error">Number required!</span>
										</div>
									</div>
							
									<div class="col-lg-6 p-t-20">
										<div
											class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
											<input class="mdl-textfield__input" type="text"
											 id="password" name="password" value="<?php echo $result->password ?>" required>
											<label class="mdl-textfield__label" for="text5">Password Number</label>
											<span class="mdl-textfield__error">Password required!</span>
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
									  <div class="col-md-12">
            		<div class="form-group">
						<label>Recruiter Logo</label>
						<input type="hidden" name="imagename" value="<?php echo $result->image; ?>" >
						<input type="file" name="image_upload_file" class='form-control' /><br/>
						<?php if(is_file("upload_images/user/".$result->image)){ ?>-
				<img src="upload_images/user/<?php echo $result->image; ?>"  style="height: 10%;width: 10%;" /><?php } ?>
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
	<!-- dropzone -->

	<!-- end js include path -->
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