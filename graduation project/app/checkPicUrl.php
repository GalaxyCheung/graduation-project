<?php
	$file_name = $_POST['file_name'];

	include("config.php");
	
	$pic_url = 'upload/photo library/'.$file_name; 

	$sql1 = "select count(1) as total from gp_pic where pic_url = '".$pic_url."'";
	$result1 = mysqli_query($link, $sql1);
	$rs1 = mysqli_fetch_array($result1);

	$array = array($rs1['total']);
	echo json_encode($array);

	mysqli_free_result($result1);
	mysqli_close($link);
?>