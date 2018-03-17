<?php
	include("config.php");
	
	$user_id = $_POST['user_id'];
	$old_prof = $_POST['old_prof'];
	
	$delpath = "../".$old_prof;
		
	if(unlink(iconv('utf-8','GBK',$delpath))){
		$sql = "delete from gp_user where id='".$user_id."'";
		$result = mysqli_query($link, $sql);
		echo $user_id;
		mysqli_close($link);
	}
	

?>