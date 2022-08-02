<?php
session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();



if($_REQUEST['submitForm']=='yes')
{	

$name=$obj->escapestring($_POST['name']);
$website=$obj->escapestring($_POST['website']);
$taxid=$obj->escapestring($_POST['taxid']);
$position=$obj->escapestring($_POST['position']);
$fee=$obj->escapestring($_POST['fee']);
$payment=$obj->escapestring($_POST['payment']);
$employe_type=$obj->escapestring($_POST['employe_type']);
$email=$obj->escapestring($_POST['email']);
$contact=$obj->escapestring($_POST['contact']);
$address=$obj->escapestring($_POST['address']);
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

		$obj->query("insert into $tbl_company set name='$name',email='$email',contact='$contact',address='$address',website='$website',taxid='$taxid',position='$position',fee='$fee',payment='$payment',employe_type='$employe_type',note='$note',user_id='".$_SESSION['sess_admin_id']."',logo='$fileNameNew',status=1 ",$debug=-1);// die;
		$_SESSION['sess_msg']='Clinet added sucessfully';  
	}
	else
	{ 

		$sql="Select logo from $tbl_company where id=".$_REQUEST['id'];
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
	
		$obj->query("update $tbl_company set name='$name',email='$email',contact='$contact',address='$address',website='$website',taxid='$taxid',position='$position',fee='$fee',payment='$payment',employe_type='$employe_type',note='$note' where id='".$_REQUEST['id']."'",-1);//die;
		$_SESSION['sess_msg']='Clinet updated sucessfully';   
	}
	header("location:client-list.php");
	exit();
}      	      
if($_REQUEST['id']!='')
{
	$sql=$obj->query("select * from $tbl_company where id=".$_REQUEST['id'],$debug=-1);
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
								<div class="page-title">Client Add</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="client-list.php">Client List</a>&nbsp;<i class="fa fa-list"></i>
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
										<div class="form-group">
											<label class="simpleFormEmail"> Name</label>
											<input class="form-control" type="text" id="name" name="name" value="<?php echo $result->name ?>" required>
										</div>
									</div>
									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail">Website</label>
											<input class="form-control" type="text" id="website" name="website" value="<?php echo $result->website ?>" required>
										</div>
									</div>
									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail">Tax ID </label>
											<input class="form-control" type="text" id="taxid" name="taxid" value="<?php echo $result->taxid ?>" required>
										</div>
									</div>
									<div class="col-lg-4 p-t-20">
										<div
											class="form-group">
											<label class="simpleFormEmail">Position</label>
											<input class="form-control" type="text" id="position" name="position" value="<?php echo $result->position ?>" required>
										</div>
									</div>
										<div class="col-lg-4 p-t-20">
										<div
											class="form-group">
											<label class="simpleFormEmail">Fee</label>
											<input class="form-control" type="text" id="fee" name="fee" value="<?php echo $result->fee ?>" required>
										</div>
									</div>
									<div class="col-lg-4 p-t-20">
										<div
											class="form-group">
											<label class="simpleFormEmail">Payment info</label>
											<input class="form-control" type="text" id="payment" name="payment" value="<?php echo $result->payment ?>" required>
										</div>
									</div>
												<div class="col-lg-4 p-t-20">
									<div
									class="form-group">
									<label for="simpleFormEmail" class="simpleFormEmail">Industry</label>
									<select class="form-control"  name="employe_type"  id="employe_type" >
							
									<option value="sales"<?php if($result->user_type=="sales"){?> selected <?php }?>>Aerospace  </option>
									<option value="Transport"<?php if($result->user_type=="Transport"){?> selected <?php }?>>Transport </option>
									<option value="Computer"<?php if($result->user_type=="Computer"){?> selected <?php }?>>Computer  </option>
									<option value="Telecommunication"<?php if($result->user_type=="Telecommunication"){?> selected <?php }?>>Telecommunication </option>
									<option value="Agriculture"<?php if($result->user_type=="Agriculture"){?> selected <?php }?>>Agriculture  </option>
									<option value="Construction"<?php if($result->user_type=="Construction"){?> selected <?php }?>>Construction  </option>
									<option value="Education"<?php if($result->user_type=="Education"){?> selected <?php }?>>Education  </option>
									</select>
									</div>
									</div>
									
									<div class="col-lg-4 p-t-20">
										<div
											class="form-group">
											<label class="simpleFormEmail"> Email</label>
											<input class="form-control" type="email" id="email" name="email" value="<?php echo $result->email ?>"required>
										</div>
									</div>
							
									<div class="col-lg-4 p-t-20">
										<div
											class="form-group">
											<label class="simpleFormEmail" for="text5">Mobile Number</label>
											<input class="form-control" type="text"
												pattern="-?[0-9]*(\.[0-9]+)?" id="contact" name="contact" value="<?php echo $result->contact ?>"required>
										</div>
									</div>
					<div class="col-md-4 p-t-20">
            		<div class="form-group">
						<label>Image</label>
						<input type="hidden" name="imagename" value="<?php echo $result->logo; ?>" >
						<input type="file" name="image_upload_file" class='form-control' /><br/>
						<?php if(is_file("upload_images/company/".$result->logo)){ ?>-
				<img src="upload_images/company/<?php echo $result->logo; ?>"  style="width: 26%;" /><?php } ?>
				  </div>
            </div>
									
									<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail" for="text7">Address</label>
											<textarea class="form-control" rows="4" id="address" name="address" value=""required><?php echo $result->address ?></textarea>
										</div>
									</div>
										<div class="col-lg-4 p-t-20">
										<div class="form-group">
											<label class="simpleFormEmail" for="text7">Note box</label>
											<textarea class="form-control" rows="4" id="note" name="note" value=""required><?php echo $result->note ?></textarea>
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