<?php 

include("config.php");

$name = $_POST['name'];

	$sql = "select * from gp_user where name = '".$name."'";
	$res = $link->query($sql);
	while($info = $res->fetch_array()){
		$name = $info['password'];
	}

$array = array("$name");
//这里进行一个些操作，比如数据库交互

echo json_encode($array);//json_encode方式是必须的
	
	mysqli_close($link);
?>