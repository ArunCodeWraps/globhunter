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
					<div class="row ">
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Total Client</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">589</h3>
											<div class="progress">
												<div class="progress-bar l-bg-red" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline15"><canvas
													style="display: inline-block; width: 200px; height: 44px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Total Client</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">589</h3>
											<div class="progress">
												<div class="progress-bar l-bg-red" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline12"><canvas
													style="display: inline-block; width: 367px; height: 70px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Total Job</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">48</h3>
											<div class="progress">
												<div class="progress-bar l-bg-green" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline9"><canvas
													style="display: inline-block; width: 167px; height: 70px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Visitors</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">2,479</h3>
											<div class="progress">
												<div class="progress-bar l-bg-orange" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline16" class="text-center"><canvas
													style="display: inline-block; width: 215px; height: 70px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end widget -->
					<!-- chart start -->
					<div class="row">
						<div class="col-12 col-sm-12 col-lg-6">
							<div class="card">
								<div class="card-head">
									<header>Chart</header>
								</div>
								<div class="card-body">
									<div id="chart2"></div>
									<div class="row">
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Target</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$15.3k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Last
												week</p>
											<h5>
												<i class="fa fa-arrow-circle-down col-red ms-1 me-1"></i>$2.8k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted text-truncate">Last
												Month</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$12.5k
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-lg-6">
							<div class="card">
								<div class="card-head">
									<header>Chart</header>
								</div>
								<div class="card-body">
									<div id="schart3"></div>
									<div class="row">
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Target</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$15.3k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Last
												week</p>
											<h5>
												<i class="fa fa-arrow-circle-down col-red ms-1 me-1"></i>$2.8k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted text-truncate">Last
												Month</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$12.5k
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
	
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
														<th>No</th>
														<th>Name</th>
														<th>Assigned Professor</th>
														<th>Date Of Admit</th>
														<th>Fees</th>
														<th>Branch</th>
														<th>Edit</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Jens Brincker</td>
														<td>Kenny Josh</td>
														<td>27/05/2016</td>
														<td>
															<span class="label label-sm label-success">paid</span>
														</td>
														<td>Mechanical</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Mark Hay</td>
														<td> Mark</td>
														<td>26/05/2017</td>
														<td>
															<span class="label label-sm label-warning">unpaid </span>
														</td>
														<td>Science</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Anthony Davie</td>
														<td>Cinnabar</td>
														<td>21/05/2016</td>
														<td>
															<span class="label label-sm label-success ">paid</span>
														</td>
														<td>Commerce</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>4</td>
														<td>David Perry</td>
														<td>Felix </td>
														<td>20/04/2016</td>
														<td>
															<span class="label label-sm label-danger">unpaid</span>
														</td>
														<td>Mechanical</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Anthony Davie</td>
														<td>Beryl</td>
														<td>24/05/2016</td>
														<td>
															<span class="label label-sm label-success ">paid</span>
														</td>
														<td>M.B.A.</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>6</td>
														<td>Alan Gilchrist</td>
														<td>Joshep</td>
														<td>22/05/2016</td>
														<td>
															<span class="label label-sm label-warning ">unpaid</span>
														</td>
														<td>Science</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>7</td>
														<td>Mark Hay</td>
														<td>Jayesh</td>
														<td>18/06/2016</td>
														<td>
															<span class="label label-sm label-success ">paid</span>
														</td>
														<td>Commerce</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>8</td>
														<td>Sue Woodger</td>
														<td>Sharma</td>
														<td>17/05/2016</td>
														<td>
															<span class="label label-sm label-danger">unpaid</span>
														</td>
														<td>Mechanical</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end new student list -->
				</div>
			</div>
			<!-- end page content -->
			<!-- start chat sidebar -->
			<div class="chat-sidebar-container" data-close-on-body-click="false">
				<div class="chat-sidebar">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#quick_sidebar_tab_1" class="nav-link active tab-icon" data-bs-toggle="tab"> <i
									class="material-icons">chat</i>Chat
								<span class="badge badge-danger">4</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#quick_sidebar_tab_3" class="nav-link tab-icon" data-bs-toggle="tab"> <i
									class="material-icons">settings</i>
								Settings
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<!-- Start User Chat -->
						<div class="tab-pane active chat-sidebar-chat in active show" role="tabpanel"
							id="quick_sidebar_tab_1">
							<div class="chat-sidebar-list">
								<div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd"
									data-wrapper-class="chat-sidebar-list">
									<div class="chat-header">
										<h5 class="list-heading">Online</h5>
									</div>
									<ul class="media-list list-items">
										<li class="media"><img class="media-object" src="assets/img/user/user3.jpg"
												width="35" height="35" alt="...">
											<i class="online dot"></i>
											<div class="media-body">
												<h5 class="media-heading">John Deo</h5>
												<div class="media-heading-sub">Spine Surgeon</div>
											</div>
										</li>
										<li class="media">
											<div class="media-status">
												<span class="badge badge-success">5</span>
											</div> <img class="media-object" src="assets/img/user/user1.jpg"
												width="35" height="35" alt="...">
											<i class="busy dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Rajesh</h5>
												<div class="media-heading-sub">Director</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user5.jpg"
												width="35" height="35" alt="...">
											<i class="away dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Jacob Ryan</h5>
												<div class="media-heading-sub">Ortho Surgeon</div>
											</div>
										</li>
										<li class="media">
											<div class="media-status">
												<span class="badge badge-danger">8</span>
											</div> <img class="media-object" src="assets/img/user/user4.jpg"
												width="35" height="35" alt="...">
											<i class="online dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Kehn Anderson</h5>
												<div class="media-heading-sub">CEO</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user2.jpg"
												width="35" height="35" alt="...">
											<i class="busy dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Sarah Smith</h5>
												<div class="media-heading-sub">Anaesthetics</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user7.jpg"
												width="35" height="35" alt="...">
											<i class="online dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Vlad Cardella</h5>
												<div class="media-heading-sub">Cardiologist</div>
											</div>
										</li>
									</ul>
									<div class="chat-header">
										<h5 class="list-heading">Offline</h5>
									</div>
									<ul class="media-list list-items">
										<li class="media">
											<div class="media-status">
												<span class="badge badge-warning">4</span>
											</div> <img class="media-object" src="assets/img/user/user6.jpg"
												width="35" height="35" alt="...">
											<i class="offline dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Jennifer Maklen</h5>
												<div class="media-heading-sub">Nurse</div>
												<div class="media-heading-small">Last seen 01:20 AM</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user8.jpg"
												width="35" height="35" alt="...">
											<i class="offline dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Lina Smith</h5>
												<div class="media-heading-sub">Ortho Surgeon</div>
												<div class="media-heading-small">Last seen 11:14 PM</div>
											</div>
										</li>
										<li class="media">
											<div class="media-status">
												<span class="badge badge-success">9</span>
											</div> <img class="media-object" src="assets/img/user/user9.jpg"
												width="35" height="35" alt="...">
											<i class="offline dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Jeff Adam</h5>
												<div class="media-heading-sub">Compounder</div>
												<div class="media-heading-small">Last seen 3:31 PM</div>
											</div>
										</li>
										<li class="media"><img class="media-object" src="assets/img/user/user10.jpg"
												width="35" height="35" alt="...">
											<i class="offline dot"></i>
											<div class="media-body">
												<h5 class="media-heading">Anjelina Cardella</h5>
												<div class="media-heading-sub">Physiotherapist</div>
												<div class="media-heading-small">Last seen 7:45 PM</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- End User Chat -->
						<!-- Start Setting Panel -->
						<div class="tab-pane chat-sidebar-settings" role="tabpanel" id="quick_sidebar_tab_3">
							<div class="chat-sidebar-settings-list slimscroll-style">
								<div class="chat-header">
									<h5 class="list-heading">Layout Settings</h5>
								</div>
								<div class="chatpane inner-content ">
									<div class="settings-list">
										<div class="setting-item">
											<div class="setting-text">Sidebar Position</div>
											<div class="setting-set">
												<select
													class="sidebar-pos-option form-control input-inline input-sm input-small ">
													<option value="left" selected="selected">Left</option>
													<option value="right">Right</option>
												</select>
											</div>
										</div>
										<div class="setting-item">
											<div class="setting-text">Header</div>
											<div class="setting-set">
												<select
													class="page-header-option form-control input-inline input-sm input-small ">
													<option value="fixed" selected="selected">Fixed</option>
													<option value="default">Default</option>
												</select>
											</div>
										</div>
										<div class="setting-item">
											<div class="setting-text">Footer</div>
											<div class="setting-set">
												<select
													class="page-footer-option form-control input-inline input-sm input-small ">
													<option value="fixed">Fixed</option>
													<option value="default" selected="selected">Default</option>
												</select>
											</div>
										</div>
									</div>
									<div class="chat-header">
										<h5 class="list-heading">Account Settings</h5>
									</div>
									<div class="settings-list">
										<div class="setting-item">
											<div class="setting-text">Notifications</div>
											<div class="setting-set">
												<div class="switch">
													<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
														for="switch-1">
														<input type="checkbox" id="switch-1" class="mdl-switch__input"
															checked>
													</label>
												</div>
											</div>
										</div>
										<div class="setting-item">
											<div class="setting-text">Show Online</div>
											<div class="setting-set">
												<div class="switch">
													<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
														for="switch-7">
														<input type="checkbox" id="switch-7" class="mdl-switch__input"
															checked>
													</label>
												</div>
											</div>
										</div>
										<div class="setting-item">
											<div class="setting-text">Status</div>
											<div class="setting-set">
												<div class="switch">
													<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
														for="switch-2">
														<input type="checkbox" id="switch-2" class="mdl-switch__input"
															checked>
													</label>
												</div>
											</div>
										</div>
										<div class="setting-item">
											<div class="setting-text">2 Steps Verification</div>
											<div class="setting-set">
												<div class="switch">
													<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
														for="switch-3">
														<input type="checkbox" id="switch-3" class="mdl-switch__input"
															checked>
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="chat-header">
										<h5 class="list-heading">General Settings</h5>
									</div>
									<div class="settings-list">
										<div class="setting-item">
											<div class="setting-text">Location</div>
											<div class="setting-set">
												<div class="switch">
													<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
														for="switch-4">
														<input type="checkbox" id="switch-4" class="mdl-switch__input"
															checked>
													</label>
												</div>
											</div>
										</div>
										<div class="setting-item">
											<div class="setting-text">Save Histry</div>
											<div class="setting-set">
												<div class="switch">
													<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
														for="switch-5">
														<input type="checkbox" id="switch-5" class="mdl-switch__input"
															checked>
													</label>
												</div>
											</div>
										</div>
										<div class="setting-item">
											<div class="setting-text">Auto Updates</div>
											<div class="setting-set">
												<div class="switch">
													<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
														for="switch-6">
														<input type="checkbox" id="switch-6" class="mdl-switch__input"
															checked>
													</label>
												</div>
											</div>
										</div>
									</div>
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
</html>