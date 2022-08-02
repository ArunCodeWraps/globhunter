<?php session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();
$id =$_REQUEST['id'];
$ids =$_REQUEST['ids'];



	if($id!='')
	{	
	   
	    $sql="delete from $tbl_company where id='$id'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
		header("location: client-list.php");
	exit();
    }else{
    	  $sql="delete from $tbl_company where id='$ids'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
		header("location: admin-client-list.php");
	exit();
    }
	
	
?>
