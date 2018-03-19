<?php
	#个人空间编辑搭配信息
	include("config.php");
	
	$pic_id = $_POST['pic_id'];
	$title = $_POST['title'];
	$subtitle = $_POST['subtitle'];
	$intro = $_POST['intro'];

	$sql = "update gp_pic set title='".$title."',subtitle='".$subtitle."',intro='".$intro."' where id='".$pic_id."'";
	$result = mysqli_query($link, $sql);
	
	echo $pic_id;
	mysqli_close($link);

?>