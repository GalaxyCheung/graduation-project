<?php
	include("config.php");
	session_start();

	$sex = '男生';
	
	$sqls  = "SELECT COUNT(*) as total FROM gp_user inner join gp_pic on gp_user.id=gp_pic.u_id where sex='$sex'";  
	
	$sqlcount = mysqli_query($link,$sqls);
	$pageCount  = mysqli_fetch_array($sqlcount);
	$pageCount = $pageCount['total']; 	

	$curPage = @$_GET[page]?:'1';  
	
	$pageSize = 9;  
	
	$startRow = ($curPage-1) * $pageSize; 
	$pageNum = ceil($pageCount/$pageSize);

	if($curPage <=0){
		$curPage= 1;
	}else if($curPage > $pageNum){
		$curPage = $pageNum; 
	}
	
	$sql = "select * from gp_user inner join gp_pic on gp_user.id=gp_pic.u_id where sex='$sex' ORDER BY gp_pic.id DESC LIMIT $startRow,$pageSize";
	
	$result = mysqli_query($link,$sql);
	
	while($rs = mysqli_fetch_array($result)){
		var_dump($rs);
	}
	
	mysqli_free_result($sqlcount);
	mysqli_free_result($result);
	mysqli_close($link);
?>