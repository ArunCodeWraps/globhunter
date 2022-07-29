<?php 

include('../include/config.php');
include("../include/functions.php");


$userId = $_SESSION['sess_admin_id'];
$toUser = $_POST['to_user'];


$sql=$obj->query("select * from tbl_message where 1=1 and (sender_id='$userId' and reciver_id='$toUser') or (sender_id='$toUser' and reciver_id='$userId') and status=1 order by id asc",$debug=-1);


$conversation=array();
while ($line=$obj->fetchNextObject($sql)) {
	
	$obj->query("update tbl_message set read_status='1' where id='$line->id'");

	$message=html_entity_decode($line->message);
	$date=date('d-M-Y h:i A',strtotime($line->datetime));
	$messageData = array('id' =>$line->id,'sender_id'=>$line->sender_id,'reciever_id'=>$line->reciver_id,'message'=>$message,'date'=>$date);
	$conversation[]=$messageData;
}

$response = array('flag' =>'1','conversation'=>$conversation);

echo json_encode($response);
?>