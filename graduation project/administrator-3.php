<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<link href="public/css/admin.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<title>管理员页面</title>
<style>
	
.side-bar ul li:nth-child(3) {
	background-color: #ddd;
}
	
.nav ul li:first-child {
	background-color: #474747;
}

.nav ul li:hover {
	background-color: #00c9d0;
}
</style>
</head>

<body>
<?php 
	session_start();
	if(!isset($_SESSION['currentUser'])){
		echo "<script>window.location.href = 'login.php';</script>";
	}
	
	include("header-2.php");
	include("app/adminAction.php");
?>



<main>
	<div class="side-bar">
		<ul>
			<li class="user-bar">
				<a href="administrator.php">用户管理</a>
			</li>
			<li class="pic-bar">
				<a href="administrator-2.php">图片管理</a>
			</li>
			<li class="comm-bar">
				<a href="administrator-3.php">留言管理</a>
			</li>
			<div class="clear"></div>
		</ul>
	</div>
	
	<div class="admin-content" style="margin: 3% 0 2% 15%;">
		
		<div class="admin-pic">
			<?php 
				$a1 = new Admin();
				$a1->sqls = "select COUNT(*) as total from gp_pic"; 
				$a1->queryPage();
				$a1->queryPic();
			?>
			
			<div class="content-page" style="float: none; width: 1000px;">
				<div style="float: right;">
					<?php 
						if($a1->curPage<=0||$a1->curPage==""){
							$a1->curPage = 1;
						}else if($a1->curPage > $a1->pageNum){
							$a1->curPage = $a1->pageNum; 
						}

						if($a1->curPage!=1){
							if($a1->curPage<=3){
								for ($i=1; $i<$a1->curPage; $i++){
									echo "<a href='administrator-2.php?page=$i'>".$i."</a>";
								}
							}else{
								echo "<a href='administrator-2.php?page=".($a1->curPage-1)."'>上一页&nbsp;&gt;</a>
										<a href='administrator-2.php'>1</a>
										<a>...</a>";
								for ($i=($a1->curPage-2); $i<$a1->curPage; $i++){
									echo "<a href='administrator-2.php?page=$i'>".$i."</a>";
								}
							}
						}

						echo '<a class="current-page" href="javascript:void(0);">'.$a1->curPage.'</a>';

						for ($i=($a1->curPage+1); $i<=$a1->pageNum; $i++){
							echo "<a href='administrator-2.php?page=$i'>".$i."</a>";
						}
						if(($a1->pageNum-$a1->curPage)>=3){
							echo "<a>...</a>
							<a href='administrator-2.php?page=".($a1->curPage+1)."'>下一页&nbsp;&gt;</a>";
						}
					?>
				</div>
			</div>
		</div>
		
		<div class="admin-comm display-none">
			
		</div>
		
		<div class="clear"></div>
	</div>
</main>


<footer>
<div class="bottom" style="width: 65%; margin: 0 0 0 25%;">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

</body>

<script src="public/js/scroll.js"></script>
<script>  
	$(document).ready(function(){
		var h = 149-$(window).scrollTop();
		if ($(window).scrollTop() > 71){
			$(".side-bar").css({
				"top" : "71px"
			});
		}else if($(window).scrollTop()<71&&$(window).scrollTop()>0){ 
			$(".side-bar").css({
				"top" : h
			});
		}
	});
	
	$(window).on("scroll", function () {
		var h = 149-$(window).scrollTop();
		if ($(window).scrollTop() > 71){
			$(".side-bar").css({
				"top" : "71px"
			});
		}else if($(window).scrollTop()<71&&$(window).scrollTop()>0){ 
			$(".side-bar").css({
				"top" : h
			});
		}else{
			$(".side-bar").css({
				"top" : "181px"
			});
		}
	});   
	
</script>
</html>
