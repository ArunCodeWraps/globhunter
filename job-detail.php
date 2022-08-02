<?php 
ob_start(); 
session_start();
include('include/config.php');
include("include/functions.php");
validate_admin();

$jobId=$_REQUEST['id'];

$sql=$obj->query("select * from $tbl_jobs where id='$jobId'",$debug=-1);
$jResult=$obj->fetchNextObject($sql);

if (empty($jResult)) {
	header("location:job-list.php");
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
								<div class="page-title">Job Details</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="job-list.php">Job List</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Job Details</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<div class="card">
									<div class="card-body no-padding height-9">
										<div class="row">
											<?php 
											$clogo= getField('logo',$tbl_company,$jResult->company_id);
											if (empty($clogo)) {
												$clogo='';
											}  ?>
											
											<div class="profile-userpic">
												<img src="upload_images/company/<?php echo $clogo ?>" class="img-responsive" alt=""> </div>
										</div>
										<div class="profile-usertitle">
											<div class="profile-usertitle-name"> <?php echo getField('name',$tbl_company,$jResult->company_id); ?></div>
										</div>
										<ul class="list-group list-group-unbordered">
											<li class="list-group-item">
												<b><i class="fa fa-usd"></i> Salary</b> <a class="pull-right"><?php echo number_format($jResult->salary) ?> USD</a>
											</li>
											<li class="list-group-item">
												<b><i class="fa fa-users"></i> Qunatity Needed</b> <a class="pull-right"><?php echo $jResult->no_of_position ?></a>
											</li>
											<li class="list-group-item">
												<b><i class="fa fa-globe"></i> Language Profile</b> <a class="pull-right"><?php echo getField('name','tbl_language',$jResult->job_land_id); ?></a>
											</li>
											<li class="list-group-item">
												<b><i class="fa fa-map-marker"></i> Location</b> <a class="pull-right"><?php echo $jResult->job_location ?></a>
											</li>
										</ul>
										
									</div>
								</div>
								<div class="card">
									<div class="card-head">
										<header>Company Info</header>
									</div>
									<div class="card-body no-padding height-9">
										<div class="profile-desc">
											<?php echo getField('cinfo',$tbl_company,$jResult->company_id); ?>
										</div>
									</div>
								</div>
							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							<div class="profile-content">
								<div class="row">
									<div class="card">
										<div class="card-topline-aqua">
											<header></header>
										</div>
										<div class="white-box">
											<!-- Nav tabs -->
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane active fontawesome-demo">
													<div id="biography">
														<div class="row">
															<div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
																<br>
																<p class="text-muted">Celena Anderson </p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
																<br>
																<p class="text-muted">(123) 456 7890</p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Email</strong>
																<br>
																<p class="text-muted">test@example.com</p>
															</div>
															<div class="col-md-3 col-6"> <strong>Location</strong>
																<br>
																<p class="text-muted">India</p>
															</div>
														</div>
														<h4 class="font-bold">Employment Information</h4>
														<?php echo $jResult->job_description ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END PROFILE CONTENT -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- The Modal -->
		<div class="modal" id="CommitionModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Set Commition</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<!-- Modal body -->
					<div class="modal-body mycommitionscls"></div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="page-footer">
			<?php include("footer.php"); ?>
		</div>
	</div>
</body>


<script type="text/javascript">
	$(".jobpostcommitionadd").click(function(){
            id = $(this).data("one");
            $.ajax({
                url:"ajax/jobpostcommitiondetail.php",
                type:"POST",
                data:{id:id},
                success:function(data)
                {
                    $(".mycommitionscls").html(data);
                }
            })
        })

function job_status(id,status){
      $.ajax({
        url:"ajax/change-status.php",
        data:{jid:id,status:status},
        beforeSend:function(){
        },
        success:function(data){
            $("#msg").html("Record updated successfully").show().fadeOut('slow');
       }
     });
}


</script>
<script src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/pages/table/table_data.js"></script>
</html>