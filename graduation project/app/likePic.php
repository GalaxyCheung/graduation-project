<?php
	include("config.php");
	session_start();

	$pic_id = @$_POST['pic_id'];
	$user_id = @$_POST['user_id'];
	$currU_id =	@$_SESSION['currentUser']['id'];
	$i = 0;

	if(!isset($_SESSION['currentUser'])||$currU_id == ""){
		$i = 1;
	}

	if($i == 0){
		$sql = "insert into gp_pic_like values ('$currU_id','$pic_id')";
		$result = mysqli_query($link,$sql);
	}
	
	$array = array($i,"");
	echo json_encode($array);
	
	mysqli_close($link);
?>