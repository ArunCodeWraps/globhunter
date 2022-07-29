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
			<!-- end sidebar menu -->
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Job List</div>
							</div>
							<div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#ff0b0b;margin-right: -60%;"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
							<?php if($_SESSION['user_type']!='recruiter'){?>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="job-addf.php">Add Job</a>&nbsp;<i class="fa fa-plus"></i>
								</li>								
							</ol>
							<?php }?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xl-12">
							<div class="card-box">
								<div class="card-body ">									
									<table
										class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
										id="example4">
										<thead>
											<tr>
												<th>#</th>
												<th>Company</th>
												<th>Position</th>
												<th>EST Reward</th>
												<th>Salary</th>
												<th>Processing</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										if($_SESSION['user_type']=='admin'){
											$sql=$obj->query("select * from $tbl_jobs where 1=1",$debug=-1);
										}else if($_SESSION['user_type']=='sales'){
											$sql=$obj->query("select * from $tbl_jobs where sales_id='".$_SESSION['sess_admin_id']."'",$debug=-1);
										}else if($_SESSION['user_type']=='recruiter'){
											$sql=$obj->query("select * from $tbl_jobs where sales_id='".$_SESSION['sess_admin_id']."'",$debug=-1);
										}
									
										
										while($line=$obj->fetchNextObject($sql)){?>
											<tr class="odd">
												<td><?php echo $i; ?></td>
												<td><?php echo getField('name',$tbl_company,$line->company_id); ?></td>
												<td><?php echo $line->position ?></td>
												<td><?php echo $line->salary ?></td>
												<td><?php echo $line->salary ?></td>
												<td><?php echo "0 CV" ?></td>
												
												  <td>
													<a href="job-addf.php?id=<?php echo $line->id;?>" class="tblEditBtn">
														<i class="fa fa-pencil"></i>
													</a>
													<a href="job-del.php?id=<?php echo $line->id;?>" title="deletel" class="tblDelBtn">
														<i class="fa fa-trash-o"></i>
													</a>
													<?php
													if($line->job_status==1){?>
													<a href="job-del.php?jid=<?php echo $line->id;?>" title="deletel" class="tblDelBtn">
														<span class="label label-info label-mini">Post</span>
													</a>
													<?php }?>
												</td>
											</tr>
										   <?php $i++; } ?>
											
										</tbody>
									</table>
								</div>
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
<script src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/pages/table/table_data.js"></script>
</html>