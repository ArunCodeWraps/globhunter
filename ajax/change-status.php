<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
$table=$_REQUEST['table'];  
$id=$_REQUEST['id']; 
$status=$_REQUEST['status'];

$jid=$_REQUEST['jid']; 

if(!empty($id)){
    $obj->query("update $table set status='$status' where id='$id' ",$debug=-1); //die;
}
if(!empty($jid)){
    $obj->query("update $tbl_jobs set job_status='$status' where id='$jid' ",$debug=-1); //die;
}
?>