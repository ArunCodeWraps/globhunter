<?php 

include('../include/config.php');
include("../include/functions.php");


$userId = $_SESSION['sess_admin_id'];
$toUser = $_POST['to_user'];
//$message = $obj->escapestring($_POST['message']);
$message = $_POST['message'];

$obj->query("insert into tbl_message set sender_id='$userId',reciver_id='$toUser',message='$message',status=1",$debug=-1);

$date=date('d-M-Y h:i A');
$response = array('flag' =>'1','date'=>$date);

echo json_encode($response);

?>