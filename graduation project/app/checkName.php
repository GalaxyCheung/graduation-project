<?php
	#检测注册时用户名是否存在
	include("config.php");
	
	$username = $_POST['username'];

	$sql = "select * from gp_user where name = '".$username."'";
	$res = $link->query($sql);

	while($info = $res->fetch_array()){
  		$username =  "";
  	}

	$array = array("$username");

	echo json_encode($array);
	
	mysqli_free_result($res);
	mysqli_close($link);

?>