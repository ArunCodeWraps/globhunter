<?php session_start();
include("include/config.php");
include("include/functions.php"); 
validate_admin();
$id =$_REQUEST['id'];



	if($id!='')
	{	
	   
	    $sql="delete from $tbl_country where id='$id'"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	header("location: country-list.php");
	exit();
	
?>
