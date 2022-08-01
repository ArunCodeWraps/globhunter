<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
$clinetId=$_REQUEST['clinetid'];  
$employeId=$_REQUEST['employeid'];
$langId=$_REQUEST['langid'];
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
if(!empty($langId)){
    $whr="";
    if($status==1){
        $whr = ",status=1";
    }else if($status==0){
        $whr = ",status=0";
    }
    $obj->query("update $tbl_language set status='$status' where id='$langId' ",$debug=-1); //die;

}
if(!empty($employeId)){
    $whr="";
    if($status==1){
        $whr = ",status=1";
    }else if($status==0){
        $whr = ",status=0";
    }
    $obj->query("update $tbl_users set status='$status' where id='$employeId' ",$debug=-1); //die;

}
if(!empty($clinetId)){
    $whr="";
    if($status==1){
        $whr = ",status=1";
    }else if($status==0){
        $whr = ",status=0";
    }
    $obj->query("update $tbl_company set status='$status' where id='$clinetId' ",$debug=-1); //die;

}


?>