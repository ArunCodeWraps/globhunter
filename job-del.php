<?php session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();

$id =$_REQUEST['id'];
$jid =$_REQUEST['jid'];



	if($id!='')
	{	
	   
	    $sql="delete from $tbl_jobs where id='$id'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }


    if($jid!='')
	{	
	   
	    $sql="update $tbl_jobs set job_status=2 where id='$jid'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) updated successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	header("location: job-list.php");
	exit();
	
?>
