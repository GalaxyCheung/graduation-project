<?php
	#管理员编辑用户信息
	include("config.php");

	$user_id = $_POST['user_id'];
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$stat = $_POST['stat'];
	$signa = $_POST['signa'];	

	$prof_file = @$_FILES['prof_file'];
	$old_prof = $_POST['old_prof'];
	$rule = $_POST['rule'];

	$savadir = "../upload/profile/";
	$deldir = "../".$old_prof;
	
	$sql2 = "update gp_user set name='".$name."',sex='".$sex."',stature='".$stat."',signature='".$signa."'";
	
	if($prof_file != ""&&isset($prof_file)){
		if(unlink(iconv('utf-8','GBK',$deldir))){
			move_uploaded_file($prof_file['tmp_name'],$savadir.iconv('utf-8','GBK',$prof_file['name']));
			$prof_url = 'upload/profile/'.$prof_file['name']; 
			$sql2 .= ",prof_url = '".$prof_url."'";	
		}
	}else if($rule == 1){
		$sql2 .= ",rule_id = '".$rule."'";
	}
	
	$sql2 .= " where id = '".$user_id."'";
	
	$result2 = mysqli_query($link,$sql2);
	$array = array($old_prof,$prof_file['name']);
	echo $array;
	
	mysqli_close($link);
?>