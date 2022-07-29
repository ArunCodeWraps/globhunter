<?php 
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php"); 

$cid = $_POST['cid'];
$iword = $_POST['iword'];
if($cid!=''){
    if($_FILES['file']['size']>0 && $_FILES['file']['error']==''){
      $Image=new SimpleImage();
      $img=time().$_FILES['file']['name'];
      move_uploaded_file($_FILES['file']['tmp_name'],"../upload_images/content/".$img);
    } 
    $obj->query("update $tbl_content set pimg = '$img',iword='$iword' where id='$cid'",-1);
    echo 1;
}

?>



