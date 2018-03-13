<?php
	
	include("config.php");
	session_start();
	
	$current_id = $_SESSION['currentUser']['id'];
	$pic_id = $_POST['pic_id'];
	
	$sql = "delete from gp_pic_like where u_id = '".$current_id."' and p_id = '".$pic_id."'";
	$result = mysqli_query($link,$sql);
	
	echo json_encode($pic_id);
?>