<?php
	include("include/config.php");
	include("include/functions.php");
	
	$time = date('H:i:s');
	$ip = get_ip_address();
	$obj->query("insert into $tbl_login_time set user_id='".$_SESSION['sess_admin_id']."',login_time='$time',type='Logout',ip='$ip'",$debug=-1); 

	$_SESSION['sess_msg']='';
	$_SESSION['sess_admin_id']='';
	$_SESSION['username']='';
	$_SESSION['user_type']='';
	
	
session_destroy();
header("Location: index.php");

?>