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
								<div class="page-title">Recruiter List</div>
							</div>
							<div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#ff0b0b;margin-right: -60%;"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="recruiter-addf.php">Add Recruiter</a>&nbsp;<i class="fa fa-plus"></i>
								</li>
								
							</ol>
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
												<th>Company Name</th>
												<th>Email</th>
												<th>Phone</th>
											
												<th style="width: 150px" >Logo</th>
												<th>Edit</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										$sql=$obj->query("select * from $tbl_users where 1=1 and user_type='recruiter'",$debug=-1);
										while($line=$obj->fetchNextObject($sql)){?>
											<tr class="odd">
												<td><?php echo $i; ?></td>
												<td><?php echo $line->name; ?></td>
												<td><?php echo $line->email ?></td>
												<td><?php echo $line->mobile ?></td>
												
												<td><img src="upload_images/user/<?php echo $line->image ?>" style="height: 10%; width: 44%;"></td>
												
												
												  <td>
													<a href="recruiter-addf.php?id=<?php echo $line->id;?>" class="tblEditBtn">
														<i class="fa fa-pencil"></i>
													</a>
													<a href="recruiter-del.php?id=<?php echo $line->id;?>" title="deletel" class="tblDelBtn">
														<i class="fa fa-trash-o"></i>
													</a>
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