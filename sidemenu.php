<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	<div id="remove-scroll" class="left-sidemenu">
		<ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
		data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
		<li class="sidebar-toggler-wrapper hide">
			<div class="sidebar-toggler">
				<span></span>
			</div>
		</li>
		<li class="sidebar-user-panel">
			<div class="sidebar-user">
				<div class="sidebar-user-picture">
					<img alt="image" src="assets/img/logo1.png">
				</div>
				<div class="sidebar-user-details">
					<div class="user-role">
						<?php 
						if($_SESSION['user_type']=='admin'){?>
							Administrator
						<?php }else if($_SESSION['user_type']=='sales'){?>
							Sales Account
						<?php }else if($_SESSION['user_type']=='recruiter'){?>
							Recruiter
						<?php }?>
					</div>
				</div>
			</div>
		</li>
		<?php 
		if($_SESSION['user_type']=='admin'){?>
		<li class="nav-item start">
			<a href="#" class="nav-link nav-toggle">
				<i data-feather="airplay"></i>
				<span class="title">Master</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
			</a>
			<ul class="sub-menu">
				<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='country-list.php' || basename($_SERVER['SCRIPT_NAME'])=='country-addf.php'){?> class="nav-item active" <?php }?>>
					<a href="country-list.php" class="nav-link ">
						<span class="title">Manage Country</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='language-list.php' || basename($_SERVER['SCRIPT_NAME'])=='language-addf.php'){?> class="nav-item active" <?php }?>>
					<a href="language-list.php" class="nav-link ">
						<span class="title">Manage Language</span>
					</a>
				</li>			
			</ul>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='job-list.php' || basename($_SERVER['SCRIPT_NAME'])=='job-addf.php'){?> class="nav-item active" <?php }?>>
			<a href="job-list.php" class="nav-link nav-toggle"> <i data-feather="layout"></i>
				<span class="title">Job Board</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='client-list.php' || basename($_SERVER['SCRIPT_NAME'])=='client-addf.php'){?> class="nav-item active" <?php }?>>
			<a href="client-list.php" class="nav-link nav-toggle"> <i data-feather="users"></i>
				<span class="title">All Client</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='admin-client-list.php'){?> class="nav-item active" <?php }?>>
			<a href="admin-client-list.php" class="nav-link nav-toggle"> <i data-feather="user"></i>
				<span class="title">My Client</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='referral-list.php'){?> class="nav-item active" <?php }?>>
			<a href="referral-list.php" class="nav-link nav-toggle"> <i data-feather="gift"></i>
				<span class="title">Referral History</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='terms-addf.php'){?> class="nav-item active" <?php }?> >
			<a href="terms-addf.php" class="nav-link nav-toggle"> <i data-feather="briefcase"></i>
				<span class="title">Terms</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='materials-addf.php'){?> class="nav-item active" <?php }?>>
			<a href="materials-addf.php" class="nav-link nav-toggle"> <i data-feather="layers"></i>
				<span class="title">Materials</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="employe-list.php" class="nav-link nav-toggle"> <i data-feather="smile"></i>
				<span class="title">Employee</span>
			</a>
		</li>
		<?php }else if($_SESSION['user_type']=='sales'){?>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='client-list.php' || basename($_SERVER['SCRIPT_NAME'])=='client-addf.php'){?> class="nav-item active" <?php }?>>
			<a href="client-list.php" class="nav-link nav-toggle"> <i data-feather="user"></i>
				<span class="title">My Clients</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='job-list.php' || basename($_SERVER['SCRIPT_NAME'])=='job-addf.php'){?> class="nav-item active" <?php }?>>
			<a href="job-list.php" class="nav-link nav-toggle"> <i data-feather="layout"></i>
				<span class="title">Job Board</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="javascript:void(0)" class="nav-link nav-toggle"> <i data-feather="gift"></i>
				<span class="title">My profile</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='terms-view.php'){?> class="nav-item active" <?php }?>>
			<a href="terms-view.php" class="nav-link nav-toggle"> <i data-feather="briefcase"></i>
				<span class="title">Terms</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='materials-view.php'){?> class="nav-item active" <?php }?>>
			<a href="materials-view.php" class="nav-link nav-toggle"> <i data-feather="layers"></i>
				<span class="title">Materials</span>
			</a>
		</li>
	<?php }else if($_SESSION['user_type']=='recruiter'){?>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='job-list.php' || basename($_SERVER['SCRIPT_NAME'])=='job-addf.php'){?> class="nav-item active" <?php }?>>
			<a href="job-list.php" class="nav-link nav-toggle"> <i data-feather="layout"></i>
				<span class="title">Job Board</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="javascript:void(0)" class="nav-link nav-toggle"> <i data-feather="user"></i>
				<span class="title">My Profile</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="javascript:void(0)" class="nav-link nav-toggle"> <i data-feather="gift"></i>
				<span class="title">My Referral History</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='terms-view.php'){?> class="nav-item active" <?php }?>>
			<a href="terms-view.php" class="nav-link nav-toggle"> <i data-feather="briefcase"></i>
				<span class="title">Terms</span>
			</a>
		</li>
		<li <?php if(basename($_SERVER['SCRIPT_NAME'])=='materials-view.php'){?> class="nav-item active" <?php }?>>
			<a href="materials-view.php" class="nav-link nav-toggle"> <i data-feather="layers"></i>
				<span class="title">Materials</span>
			</a>
		</li>
	<?php }?>
	</ul>
</div>
</div>