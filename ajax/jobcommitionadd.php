<?php 
include("../include/config.php");
include("../include/functions.php"); 
$id = $_REQUEST['id'];
$commition = $_REQUEST['commition'];
$obj->query("update $tbl_jobs set commition='$commition',job_status=2 where id='$id'",-1);// die;
echo 1;
?>
