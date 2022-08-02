<?php 
session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();

if($_REQUEST['id']!='')
{	
    $sql="delete from $tbl_job_application where id='".$_REQUEST['id']."'"; 
	$obj->query($sql);
	$sess_msg='Selected record(s) deleted successfully';
	$_SESSION['sess_msg']=$sess_msg;
}

header("location: jobapply-list.php?jid=".$_REQUEST['jid']);
exit();
	
?>
