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
								<div class="page-title">Manage Job Application <br> <span style="color:#6673fc; font-size: 15px;">For <?php echo getField('job_title',$tbl_jobs,$_REQUEST['jid']) ?></span></div>
							</div>
							<div class="col-md-6" id="msg"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#ff0b0b;margin-right: -60%;"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
							<?php if($_SESSION['user_type']=='recruiter'){?>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item"
										href="job-list.php">Back Job List</a>&nbsp;<i class="fa fa-angle-right"></i></li>
								<li><a class="parent-item" href="jobapply-addf.php?jid=<?php echo $_REQUEST['jid']; ?>">Add Job Application</a>&nbsp;<i class="fa fa-plus"></i>
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
												<th>Candidate Name</th>
												<th>Email</th>
												<th>Contact</th>
												<th>Country</th>
												<th>Status</th>
												<?php if($_SESSION['user_type']=='admin'){?>
												<th>Action</th>
												<?php }?>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										$sql=$obj->query("select * from $tbl_job_application where rec_id='".$_SESSION['sess_admin_id']."' and job_id=".$_REQUEST['jid']."",$debug=-1);
									
										
										while($line=$obj->fetchNextObject($sql)){?>
											<tr class="odd">
												<td><?php echo $i; ?></td>
												<td><?php echo $line->candidate_name ?></td>
												<td><?php echo $line->candidate_email ?></td>
												<td><?php echo $line->candidate_phone ?></td>
												<td><?php echo getField('country',$tbl_country,$line->candidate_country_id); ?></td>
												<td>
													<select name="jobstatus" onchange="job_status('tbl_job_application',<?php echo $line->id; ?>,this.value)" style="width: 140px;" <?php if($_SESSION['user_type']=='recruiter'){?> disabled="disabled" <?php }?>>
													<option value="1" <?php if($line->status==1){?> selected <?php } ?>>Yet to process</option>
													<option value="2" <?php if($line->status==2){?> selected <?php } ?>>Ready to submit</option>
													<option value="3" <?php if($line->status==3){?> selected <?php } ?>>Under Review</option>
													<option value="4" <?php if($line->status==4){?> selected <?php } ?>>Interview</option>
													<option value="5" <?php if($line->status==5){?> selected <?php } ?>>Offers</option>
													<option value="6" <?php if($line->status==6){?> selected <?php } ?>>Rejected</option>
													<option value="7" <?php if($line->status==7){?> selected <?php } ?>>Under guarantee,</option>
													<option value="8" <?php if($line->status==8){?> selected <?php } ?>>Expired</option>
													</select>
												</td>
												<?php if($_SESSION['user_type']=='admin'){?>
												  <td>
													<a href="jobapply-addf.php?jid=<?php echo $_REQUEST['jid']; ?>&id=<?php echo $line->id;?>" class="tblEditBtn">
													<i class="fa fa-pencil"></i>
													</a>
													<a href="jobapply-del.php?jid=<?php echo $_REQUEST['jid']; ?>&id=<?php echo $line->id;?>" title="deletel" class="tblDelBtn">
													<i class="fa fa-trash-o"></i>
													</a>
												</td>
												<?php }?>
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
<script type="text/javascript">
function job_status(table,id,status){
      $.ajax({
        url:"ajax/change-status.php",
        data:{id:id,status:status,table:table},
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