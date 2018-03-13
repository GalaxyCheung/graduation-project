<?php
	
	include("config.php");
	session_start();
	
	$current_id = $_SESSION['currentUser']['id'];
	$user_id = $_POST['user_id'];
	
	$sql = "delete from gp_user_follow where u_id = '".$current_id."' and f_id = '".$user_id."'";
	$result = mysqli_query($link,$sql);
	
	echo json_encode($user_id);
?>