<?php
	$sql=$obj->query("select * from $tbl_users where id=".$_SESSION['sess_admin_id'],$debug=-1);
	$resultt=$obj->fetchNextObject($sql);
 ?>
<div class="page-header navbar navbar-fixed-top">
<div class="page-header-inner ">
<div class="page-logo">
<a href="welcome.php">
<span class="logo-default"><?php echo SITE_TITLE; ?></span> </a>
</div>
<!-- logo end -->
<ul class="nav navbar-nav navbar-left in">
<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
</ul>
<!-- start mobile menu -->
<a class="menu-toggler responsive-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
<span></span>
</a>
<div class="top-menu">
<ul class="nav navbar-nav pull-right">
<li><a class="fullscreen-btn"><i data-feather="maximize"></i></a></li>

<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
<a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
data-close-others="true">
<i data-feather="bell"></i>
<span class="badge headerBadgeColor1"> 6 </span>
</a>
<ul class="dropdown-menu">
<li class="external">
<h3><span class="bold">Notifications</span></h3>
<span class="notification-label purple-bgcolor">New 6</span>
</li>
<li>
<ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
<li>
<a href="javascript:;">
<span class="time">just now</span>
<span class="details">
<span class="notification-icon circle deepPink-bgcolor"><i
class="fa fa-check"></i></span>
Congratulations!. </span>
</a>
</li>
<li>
<a href="javascript:;">
<span class="time">3 mins</span>
<span class="details">
<span class="notification-icon circle purple-bgcolor"><i
class="fa fa-user o"></i></span>
<b>John Micle </b>is now following you. </span>
</a>
</li>
<li>
<a href="javascript:;">
<span class="time">7 mins</span>
<span class="details">
<span class="notification-icon circle blue-bgcolor"><i
class="fa fa-comments-o"></i></span>
<b>Sneha Jogi </b>sent you a message. </span>
</a>
</li>
<li>
<a href="javascript:;">
<span class="time">12 mins</span>
<span class="details">
<span class="notification-icon circle pink"><i
class="fa fa-heart"></i></span>
<b>Ravi Patel </b>like your photo. </span>
</a>
</li>
<li>
<a href="javascript:;">
<span class="time">15 mins</span>
<span class="details">
<span class="notification-icon circle yellow"><i
class="fa fa-warning"></i></span> Warning! </span>
</a>
</li>
<li>
<a href="javascript:;">
<span class="time">10 hrs</span>
<span class="details">
<span class="notification-icon circle red"><i
class="fa fa-times"></i></span> Application error. </span>
</a>
</li>
</ul>
<div class="dropdown-menu-footer">
<a href="javascript:void(0)"> All notifications </a>
</div>
</li>
</ul>
</li>

<li class="dropdown dropdown-user">
<a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
data-close-others="true">
<img alt="" class="img-circle " src="upload_images/user/<?php echo $resultt->image; ?>" />
<span class="username username-hide-on-mobile"><?php echo $resultt->name; ?>
</a>
<ul class="dropdown-menu dropdown-menu-default">
<li>
<a href="profile.php">
<i class="icon-user"></i> Profile </a>
</li>
<li>
<a href="change-password.php">
<i class="icon-settings"></i> Change Password
</a>
</li>											
<li>
<a href="logout.php">
<i class="icon-logout"></i> Log Out </a>
</li>
</ul>
</li>
<li class="dropdown dropdown-quick-sidebar-toggler">
<a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right"
data-upgraded=",MaterialButton">
<i class="material-icons">more_vert</i>
</a>
</li>
</ul>
</div>
</div>
</div>

<div class="settingSidebar">
<a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
</a>
<div class="settingSidebar-body ps-container ps-theme-default">
<div class=" fade show active">
<div class="setting-panel-header">Setting Panel
</div>
<div class="quick-setting slimscroll-style">
<ul id="themecolors">
<li>
<p class="sidebarSettingTitle">Sidebar Color</p>
</li>
<li class="complete">
<div class="theme-color sidebar-theme">
<a href="#" data-theme="white"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="dark"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="blue"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="indigo"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="cyan"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="green"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="red"><span class="head"></span><span
class="cont"></span></a>
</div>
</li>
<li>
<p class="sidebarSettingTitle">Header Brand color</p>
</li>
<li class="theme-option">
<div class="theme-color logo-theme">
<a href="#" data-theme="logo-white"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="logo-dark"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="logo-blue"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="logo-indigo"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="logo-cyan"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="logo-green"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="logo-red"><span class="head"></span><span
class="cont"></span></a>
</div>
</li>
<li>
<p class="sidebarSettingTitle">Header color</p>
</li>
<li class="theme-option">
<div class="theme-color header-theme">
<a href="#" data-theme="header-white"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="header-dark"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="header-blue"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="header-indigo"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="header-cyan"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="header-green"><span class="head"></span><span
class="cont"></span></a>
<a href="#" data-theme="header-red"><span class="head"></span><span
class="cont"></span></a>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>