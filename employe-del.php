<?php session_start();
include("include/config.php");
include("include/functions.php"); 

$id =$_REQUEST['id'];



	if($id!='')
	{	
	   
	    $sql="delete from $tbl_users where id='$id'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	header("location: clinet-list.php");
	exit();
	
?>
