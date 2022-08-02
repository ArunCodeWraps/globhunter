<?php 
ob_start(); 
session_start();
include('include/config.php');
include("include/functions.php");
validate_admin();
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
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Dashboard</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Dashboard</li>
							</ol>
						</div>
					</div>
					<!-- start widget -->

					<?php if($_SESSION['user_type']=='admin'){ ?>

					<div class="row state-overview">
						<div class="col-xl-3 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="target"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Jobs</span>
										<span class="info-box-number"><?php echo totalJobs(); ?></span>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="users"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Clients</span>
										<span class="info-box-number"><?php echo totalClient(); ?></span>
									</div>
								</div>
							</div>


							<div class="col-xl-3 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="gift"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Referral</span>
										<span class="info-box-number"><?php echo totalReferral(); ?></span>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="smile"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Employee</span>
										<span class="info-box-number"><?php echo totalEmployee(); ?></span>
									</div>
								</div>
							</div>
					</div>
					<!-- end widget -->
					<!-- start new student list -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card  card-box">
								<div class="card-head">
									<header>New Job List</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview mb-30">
												<thead>
											<tr>
												<th>#</th>
												<?php if($_SESSION['user_type']=='admin'){?>
													<th>POSTED BY</th>
												<?php }?>
												<th>COMPANY</th>
												<th>POSITION</th>
												<th>EST REWARD</th>
												<th>SALARY</th>
												<th>Processing</th>
												<th>Job Status</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										if($_SESSION['user_type']=='admin'){
											$sql=$obj->query("select * from $tbl_jobs where 1=1 order by id desc limit 0,5",$debug=-1);
										}else if($_SESSION['user_type']=='sales'){
											$sql=$obj->query("select * from $tbl_jobs where sales_id='".$_SESSION['sess_admin_id']."'",$debug=-1);
										}else if($_SESSION['user_type']=='recruiter'){
											$sql=$obj->query("select * from $tbl_jobs where job_status not in (1)",$debug=-1);
										}
									
										
										while($line=$obj->fetchNextObject($sql)){?>
											<tr class="odd">
												<td><?php echo $i; ?></td>
												<?php if($_SESSION['user_type']=='admin'){?>
													<td><?php echo getField('name',$tbl_users,$line->sales_id); ?></td>
												<?php }?>
												<td>
													    <?php 
														$clogo= getField('logo',$tbl_company,$line->company_id);
														if (empty($clogo)) {
															$clogo='';
														}  ?>
														<a href="job-detail.php?id=<?php echo $line->id ?>" class="job-list-img"><img src="upload_images/company/<?php echo $clogo ?>"></a>
												</td>
												<td class="company-coloumn">
													<strong><?php echo $line->position ?></strong><br>
													<?php echo getField('name',$tbl_company,$line->company_id); ?>	<p><i class="material-icons f-left">place</i><?php echo $line->job_location; ?></p>
													</td>
												<td>
													<span class="label label-sm label-success"><?php echo number_format($line->salary) ?> USD</span></td>
												<td><?php echo $line->salary ?></td>
												<td><?php echo totalJobApply($line->id) ?> CV</td>
												<td>
												 	<?php if ($line->job_status==1) {
												 		echo 'Open';
												 	} else if($line->job_status==2){
												 		echo 'Processing';
												 	} else if($line->job_status==3){
												 		echo 'Closed';
												 	} else if($line->job_status==4){
												 		echo 'Hidden';
												 	} ?>
												 </td>
											</tr>
										   <?php $i++; } ?>										
										</tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }else if($_SESSION['user_type']=='sales'){ ?>


						<div class="row state-overview">
						<div class="col-xl-6 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="target"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Jobs</span>
										<span class="info-box-number"><?php echo totalJobs(); ?></span>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="users"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Clients</span>
										<span class="info-box-number"><?php echo totalClient(); ?></span>
									</div>
								</div>
							</div>
					</div>
					<!-- end widget -->
					<!-- start new student list -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card  card-box">
								<div class="card-head">
									<header>New Job List</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview mb-30">
												<thead>
											<tr>
												<th>#</th>
												<?php if($_SESSION['user_type']=='admin'){?>
													<th>POSTED BY</th>
												<?php }?>
												<th>COMPANY</th>
												<th>POSITION</th>
												<th>EST REWARD</th>
												<th>SALARY</th>
												<th>Processing</th>
												<th>Job Status</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										if($_SESSION['user_type']=='admin'){
											$sql=$obj->query("select * from $tbl_jobs where 1=1 order by id desc limit 0,5",$debug=-1);
										}else if($_SESSION['user_type']=='sales'){
											$sql=$obj->query("select * from $tbl_jobs where sales_id='".$_SESSION['sess_admin_id']."' order by id desc",$debug=-1);
										}else if($_SESSION['user_type']=='recruiter'){
											$sql=$obj->query("select * from $tbl_jobs where job_status not in (1) order by id desc",$debug=-1);
										}
									
										
										while($line=$obj->fetchNextObject($sql)){?>
											<tr class="odd">
												<td><?php echo $i; ?></td>
												<?php if($_SESSION['user_type']=='admin'){?>
													<td><?php echo getField('name',$tbl_users,$line->sales_id); ?></td>
												<?php }?>
												<td>
													    <?php 
														$clogo= getField('logo',$tbl_company,$line->company_id);
														if (empty($clogo)) {
															$clogo='';
														}  ?>
														<a href="job-detail.php?id=<?php echo $line->id ?>" class="job-list-img"><img src="upload_images/company/<?php echo $clogo ?>"></a>
												</td>
												<td class="company-coloumn">
													<strong><?php echo $line->position ?></strong><br>
													<?php echo getField('name',$tbl_company,$line->company_id); ?>	<p><i class="material-icons f-left">place</i><?php echo $line->job_location; ?></p>
													</td>
												<td>
													<span class="label label-sm label-success"><?php echo number_format($line->salary) ?> USD</span></td>
												<td><?php echo $line->salary ?></td>
												<td><?php echo totalJobApply($line->id) ?> CV</td>
												<td>
												 	<?php if ($line->job_status==1) {
												 		echo 'Open';
												 	} else if($line->job_status==2){
												 		echo 'Processing';
												 	} else if($line->job_status==3){
												 		echo 'Closed';
												 	} else if($line->job_status==4){
												 		echo 'Hidden';
												 	} ?>
												 </td>
											</tr>
										   <?php $i++; } ?>										
										</tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php }else if($_SESSION['user_type']=='recruiter'){ ?>
				

					<div class="row state-overview">
						<div class="col-xl-6 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="target"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Jobs</span>
										<span class="info-box-number"><?php echo totalJobs(); ?></span>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-md-6 col-12">
								<div class="info-box bg-b-green">
									<span class="info-box-icon push-bottom"><i data-feather="users"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Referral</span>
										<span class="info-box-number"><?php echo totalReferral(); ?></span>
									</div>
								</div>
							</div>
					</div>
					<!-- end widget -->
					<!-- start new student list -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card  card-box">
								<div class="card-head">
									<header>New Job List</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview mb-30">
												<thead>
											<tr>
												<th>#</th>
												<?php if($_SESSION['user_type']=='admin'){?>
													<th>POSTED BY</th>
												<?php }?>
												<th>COMPANY</th>
												<th>POSITION</th>
												<th>EST REWARD</th>
												<th>SALARY</th>
												<th>Processing</th>
												<th>Job Status</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										if($_SESSION['user_type']=='admin'){
											$sql=$obj->query("select * from $tbl_jobs where 1=1 order by id desc limit 0,5",$debug=-1);
										}else if($_SESSION['user_type']=='sales'){
											$sql=$obj->query("select * from $tbl_jobs where sales_id='".$_SESSION['sess_admin_id']."' order by id desc",$debug=-1);
										}else if($_SESSION['user_type']=='recruiter'){
											$sql=$obj->query("select * from $tbl_jobs where job_status not in (1) order by id desc",$debug=-1);
										}
									
										
										while($line=$obj->fetchNextObject($sql)){?>
											<tr class="odd">
												<td><?php echo $i; ?></td>
												<?php if($_SESSION['user_type']=='admin'){?>
													<td><?php echo getField('name',$tbl_users,$line->sales_id); ?></td>
												<?php }?>
												<td>
													    <?php 
														$clogo= getField('logo',$tbl_company,$line->company_id);
														if (empty($clogo)) {
															$clogo='';
														}  ?>
														<a href="job-detail.php?id=<?php echo $line->id ?>" class="job-list-img"><img src="upload_images/company/<?php echo $clogo ?>"></a>
												</td>
												<td class="company-coloumn">
													<strong><?php echo $line->position ?></strong><br>
													<?php echo getField('name',$tbl_company,$line->company_id); ?>	<p><i class="material-icons f-left">place</i><?php echo $line->job_location; ?></p>
													</td>
												<td>
													<span class="label label-sm label-success"><?php echo number_format($line->salary) ?> USD</span></td>
												<td><?php echo $line->salary ?></td>
												<td><?php echo totalJobApply($line->id) ?> CV</td>
												<td>
												 	<?php if ($line->job_status==1) {
												 		echo 'Open';
												 	} else if($line->job_status==2){
												 		echo 'Processing';
												 	} else if($line->job_status==3){
												 		echo 'Closed';
												 	} else if($line->job_status==4){
												 		echo 'Hidden';
												 	} ?>
												 </td>
											</tr>
										   <?php $i++; } ?>										
										</tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>	

					<!-- end new student list -->
				</div>
			</div>
			
		</div>
		<div class="page-footer">
			<?php include("footer.php"); ?>
		</div>
	</div>
</body>
</html>