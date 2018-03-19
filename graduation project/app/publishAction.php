<?php
	#发布搭配
	session_start();
	$currentUser_id = @$_SESSION['currentUser']['id'];
	$title = $_POST['title'];
	$subtitle = $_POST['subtitle'];
	$intro = $_POST['intro'];
	$d = date("Y-m-d H:i:s");
	
	$file=$_FILES['pic_url'];

	include("config.php");
	
	$savadir='../upload/photo library/';  
	$pic_url = 'upload/photo library/'.$file['name']; 
	
	
	move_uploaded_file($file['tmp_name'],$savadir.iconv("utf-8","GBK",$file['name']));  

	$sql = "insert into gp_pic VALUES ('NULL','$title','$subtitle','$intro','$pic_url','0','$d','$currentUser_id')";
	$result = mysqli_query($link, $sql);

	$pic_id = mysqli_insert_id($link);

	header("Location: ../detail.php?pic_id=$pic_id");

	mysqli_free_result($result);
	mysqli_close($link);

?>