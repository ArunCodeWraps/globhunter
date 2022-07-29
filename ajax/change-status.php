<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
  

$id=$_REQUEST['id'];
$status=$_REQUEST['status'];
if(!empty($id)){
    $whr="";
    if($status==1){
        $whr = ",status=1";
    }else if($status==0){
        $whr = ",status=0";
    }
    $obj->query("update $tbl_country set status='$status' where id='$id' ",$debug=-1); //die;

}


?>