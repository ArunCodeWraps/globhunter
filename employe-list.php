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
								<div class="page-title">Employee List</div>
							</div>
							<div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#ff0b0b;margin-right: -60%;"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="employe-addf.php">Add Employee</a>&nbsp;<i class="fa fa-plus"></i>
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
												<th>Employee Name</th>
												<th>Email</th>
												
												<th>Employee Type</th>
												<th>Job Type</th>
											
												<th style="width: 80px" >Logo</th>
												<th>Status</th>
												<th>Edit</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=0;
										$sql=$obj->query("select * from $tbl_users where 1=1 ",$debug=-1);
										while($line=$obj->fetchNextObject($sql)){?>
											
												<?php if ($line->id !=1 ) {?>
													<tr class="odd">
														<td><?php echo $i; ?></td>
												<td><?php echo $line->name; ?></td>
												<td><?php echo $line->email ?></td>
											
												<td><?php echo $line->user_type ?></td>
												<td><?php echo $line->job_type ?></td>
												
												<td><img src="upload_images/user/<?php echo $line->image ?>" style="height: 10%; width: 44%;"></td>
												<td>
													<select name="orderstatus" onchange="employe_status(<?php echo $line->id; ?>,this.value)">
													<option value="1" <?php if($line->status==1){?> selected <?php } ?>>Enable</option>
													<option value="0" <?php if($line->status==0){?> selected <?php } ?>>Disable</option>
													
													</select>
													</td>
												
												
												  <td>
													<a href="employe-addf.php?id=<?php echo $line->id;?>" class="tblEditBtn">
														<i class="fa fa-pencil"></i>
													</a>
													<a href="employe-del.php?id=<?php echo $line->id;?>" title="deletel" class="tblDelBtn">
														<i class="fa fa-trash-o"></i>
													</a>
												</td>
												</tr>
												<?php } ?>
											
											
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
<script>
    function employe_status(id,status){
          $.ajax({
            url:"ajax/change-status.php",
            data:{employeid:id,status:status},
            beforeSend:function(){
            },
            success:function(data){
                $("#msg").html("Record updated successfully").show().fadeOut('slow');
           }
         });
    }
    </script>
</html>