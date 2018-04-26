<?php
	#取消搭配喜欢
	include("config.php");
	session_start();
	
	$current_id = $_SESSION['currentUser']['id'];
	$pic_id = $_POST['pic_id'];
	
	$sql = "delete from gp_pic_like where u_id = '".$current_id."' and p_id = '".$pic_id."'";
	$result = mysqli_query($link,$sql);
	$sql1 = "update gp_pic set like_num=like_num-1 where id = '".$pic_id."'";
	$result1 = mysqli_query($link,$sql1);
	
	echo json_encode($pic_id);
?>