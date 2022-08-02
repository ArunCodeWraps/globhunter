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
								<div class="page-title">Manage Referral History </div>
							</div>
							<div class="col-md-6" id="msg"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#ff0b0b;margin-right: -60%;"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>

							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="welcome.php">Home</a>
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
												<th width="200px;">Job Board</th>
												<th>Comapny Detail</th>
												<th>Employee Detail</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										$sql=$obj->query("select a.id,a.candidate_name,a.candidate_email,a.candidate_phone,b.job_title,b.job_code,b.salary,b.job_location,c.name,c.address,c.contact,c.logo from $tbl_job_application as a join $tbl_jobs as b on a.job_id=b.id join $tbl_company as c on b.company_id=c.id  where 1=1",$debug=-1);
										while($line=$obj->fetchNextObject($sql)){?>
											<tr class="odd">
												<td><?php echo $i; ?></td>
												<td><?php echo "Job Title : ".$line->job_title."</br>Code : ".$line->job_code."</br>Salary : ".$line->salary."</br>Location : ".$line->job_location; ?></td>
												<td><?php echo "Company Name : ".$line->name."</br>Address : ".$line->address."</br>Contact : ".$line->contact."</br><img src='upload_images/company/".$line->logo."' style='height: 10%; width: 40%;'>"; ?></td>
												<td><?php echo "Name : ".$line->candidate_name."</br>Email : ".$line->candidate_email."</br>Contact : ".$line->candidate_phone ?></td>
												
												<td>
												<select name="jobstatus" onchange="job_status('tbl_job_application',<?php echo $line->id; ?>,this.value)" style="width: 140px;">
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