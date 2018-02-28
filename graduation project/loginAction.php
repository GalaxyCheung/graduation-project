<?php
	include("config.php");
	
	$log = $_POST['log'];
	$pwd = $_POST['pwd'];
		
	$sql = "select * from gp_user where name='$log' and password='$pwd'";
	$result = mysqli_query($link, $sql);
	$test = mysqli_fetch_array($result);

	if(!$test){
		
	}else{
		$curr_user = $test['id'];
		header("Location: index.php?=$curr_user");
	}
	mysqli_close($link);
?>