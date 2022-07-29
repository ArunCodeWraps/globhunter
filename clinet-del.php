<?php session_start();
include("include/config.php");
include("include/functions.php"); 

$id =$_REQUEST['id'];
$ids =$_REQUEST['ids'];



	if($id!='')
	{	
	   
	    $sql="delete from $tbl_company where id='$id'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
		header("location: clinet-list.php");
	exit();
    }else{
    	  $sql="delete from $tbl_company where id='$ids'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
		header("location: admin-clinet-list.php");
	exit();
    }
	
	
?>
