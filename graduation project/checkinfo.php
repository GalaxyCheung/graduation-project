<?php

	include("config.php");

	session_start();

	$username = $_POST['username'];
	$userpass = $_POST['userpass'];
	
	$sql = "select * from gp_user where name = '".$username."' and password = '".$userpass."'";
	$res = $link->query($sql);

	while($info = $res->fetch_array()){ 
		
		$_SESSION['currentUser'] = $info;
		
  		$username =  "";
  		$userpass =  "";
  	}

	$array = array("$username","$userpass");

	echo json_encode($array);
	
	mysqli_close($link);

?>