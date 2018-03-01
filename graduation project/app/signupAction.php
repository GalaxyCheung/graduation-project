<?php
	$log = $_POST['log'];
	$pwd = $_POST['pwd'];
	$sex = $_POST['sex'];
	$stat = $_POST['stat'];
	$signa = $_POST['signa'];
		
//1、判断是不是有效文件  
if(!is_uploaded_file($_FILES['pro_url']['tmp_name'])){  
    echo "<script>alert('请上传一个有效文件');location.href='signup.php';</script>";  
    exit(0);  
}     
//2、判断文件格式  
$file=@$_FILES['pro_url'];//var_dump($file);die;  
$isoktype=array("image/jpeg","image/pjpeg","image/gif");  
if(!in_array($file['type'],$isoktype)){  
    echo "<script>alert('请上传一个格式正确的文件');location.href='signup.php';</script>";  
    exit(0);      
}     
//3、判断图片大小  
$isoksize=102400;  
if($isoksize<$file["size"]){  
    echo "<script>alert('文件过大');location.href='signup.php';</script>";  
    exit(0);          
}  
  
//执行保存操作  
$savadir='upload/profile/';  
move_uploaded_file($file['tmp_name'],$savadir.$file['name']);//第一个参数是待上传文件的地址，第二个是上传后文件的地址  

$pro_url=$savadir.$file['name'];  


//数据录入
include("config.php");
	
$sql = "insert into gp_user VALUES ('NULL','$log','$pwd','$sex','$stat','$signa','$pro_url','2')";
$result = mysqli_query($link, $sql);

header("Location: login.php?user=$log");

mysqli_close($link);
?>