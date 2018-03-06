<?php
	include("config.php");
	
	$pic_id = $_POST['pic_id'];

	$sql = "delete from gp_pic where id='".$pic_id."'";
	$result = mysqli_query($link, $sql);
	
	echo $pic_id;
	mysqli_close($link);

?>