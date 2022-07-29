<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
  

$emp_id=$_POST['emp_id'];
$leavetype=$_POST['leavetype'];  


 if ($_POST['emp_id']) {

 	 $today = date('Y-m-d');
     $sql=$obj->query("select entitlement from $tbl_entitlement where emp_id='".$emp_id."' and leave_type='".$leavetype."' and date(period_from) <= '$today' and date(period_to) >= '$today' ",$debug=-1);
     $result = $obj->fetchNextObject($sql);
    
     $leaveBal = $obj->query("select sum(leave_day) as leave_days from $tbl_leave where user_id='$emp_id' and status=2");
     $leaveResult = $obj->fetchNextObject($leaveBal);
   
     if($result->entitlement==''){
     	echo 0;
     }else{
     	echo $result->entitlement-$leaveResult->leave_days;
     }
  }


?>