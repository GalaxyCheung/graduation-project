<?php
	include("config.php");

	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$stat = $_POST['stat'];
	$signa = $_POST['signa'];

	$sql = "update gp_user set sex='".$sex."',stature='".$stat."',signature='".$signa."' where name='".$name."'";
	$result = mysqli_query($link, $sql);
	
	$array = array("$name","$sex","$stat","$signa");
	echo json_encode($array);
	
	mysqli_close($link);

?>