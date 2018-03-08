<?php
	include("config.php");

	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$stat = $_POST['stat'];
	$signa = $_POST['signa'];
	$pwd = $_POST['pwd'];
	$new_pwd = $_POST['new_pwd'];
	if($pwd == "")$pwd =1;

	$sql1 = "select count(1) as total from gp_user where name='".$name."'and password='".$pwd."'";

	$result1 = mysqli_query($link, $sql1);
	$rs = mysqli_fetch_array($result1);
	if($rs['total'] == 0){
		$sql = "update gp_user set sex='".$sex."',stature='".$stat."',signature='".$signa."' where name='".$name."'";
		$result = mysqli_query($link, $sql);
		$array = array("$name","$sex","$stat","$signa");
		echo json_encode($array);
	}else{
		$sql = "update gp_user set sex='".$sex."',stature='".$stat."',signature='".$signa."', password='".$new_pwd."' where name='".$name."'";
		$result = mysqli_query($link, $sql);
		$array = array("$name","$sex","$stat","$signa");
		echo json_encode($array);
	}
	mysqli_close($link);

?>