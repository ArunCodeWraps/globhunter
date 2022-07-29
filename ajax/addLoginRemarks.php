<?php 
include("../include/config.php");
include("../include/functions.php"); 

$user_id = $_REQUEST['user_id'];
$remarks = $_REQUEST['remarks'];
$dt = date('y-m-d',$_REQUEST['dt']);



if($_SESSION['user_type']=='admin'){
    $sql = $obj->query("select id from $tbl_login_time_remark where user_id='$user_id' and date(login_date)='$dt'",-1); //die;
    $numRows = $obj->numRows();
    if($numRows>0){
    	$obj->query("update $tbl_login_time_remark set user_id='$user_id',remarks='$remarks',login_date='$dt' where user_id='$user_id' and date(login_date)='$dt'",-1);
    }else{
    	$obj->query("insert into $tbl_login_time_remark set user_id='$user_id',remarks='$remarks',login_date='$dt'",-1);
    }
}
?>

