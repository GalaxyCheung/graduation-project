<?php
	$log = $_POST['log'];
	$pwd = $_POST['pwd'];
	$sex = $_POST['sex'];
	$stat = $_POST['stat'];
	$signa = $_POST['signa'];
		 

$file=$_FILES['pro_url'];

//保存图片 
$savadir='../upload/profile/';  

move_uploaded_file($file['tmp_name'],$savadir.iconv('utf-8','GBK',$file['name']));

$pro_url = 'upload/profile/'.$file['name'];  


//写入数据库
include("config.php");
	
$sql = "insert into gp_user VALUES ('NULL','$log','$pwd','$sex','$stat','$signa','$pro_url','2')";
$result = mysqli_query($link, $sql);

header("Location: ../login.php?user=$log");

mysqli_free_result($result);
mysqli_close($link);
?>