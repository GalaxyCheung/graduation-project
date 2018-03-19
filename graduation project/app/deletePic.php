<?php
	#删除搭配
	include("config.php");
	
	$pic_id = $_POST['pic_id'];
	$pic_url = $_POST['pic_url'];
	
	$upload_path = "../".$pic_url;
		
	if(unlink(iconv('utf-8','GBK',$upload_path))){
		$sql = "delete from gp_pic where id='".$pic_id."'";
		$result = mysqli_query($link, $sql);
		echo $pic_id;
		mysqli_close($link);
	}
	

?>