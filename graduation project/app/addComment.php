
<?php
	#添加评论
	include("config.php");
	session_start();

	$user_id = $_SESSION['currentUser']['id'];
	$pic_id = $_POST['pic_id'];
	$comm_text = $_POST['comm_text'];
	$d = date("Y-m-d H:i:s");

	$sql = "insert into gp_pic_comment values('NULL','$user_id','$pic_id','$comm_text','$d')";
	$result = mysqli_query($link,$sql);
	$rs = mysqli_insert_id($link);
	
	$array = array($rs);
	echo json_encode($array);
	
	mysqli_close($link);
?>