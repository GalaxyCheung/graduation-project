<?php
	#添加关注
	include("config.php");
	session_start();
	
	$current_id = $_SESSION['currentUser']['id'];
	$user_id = $_POST['user_id'];
	
	$sql = "insert into gp_user_follow values('NULL','$current_id','$user_id')";
	$result = mysqli_query($link,$sql);
	
	echo json_encode($user_id);
?>