<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="public/css/admin.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<title>管理员页面</title>
<style>

.side-bar ul li:first-child {
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
	<div class="backToTop-button">
		<img src="public/images/回到顶部.png" />
	</div>
	<div class="side-bar">
		<ul>
			<li class="user-bar">
				<a href="administrator.php">用户管理</a>
			</li>
			<li class="pic-bar">
				<a href="administrator-2.php">图片管理</a>
			</li>
			<div class="clear"></div>
		</ul>
	</div>
	
	<div class="admin-content" style="margin: 3% 0 2% 15%;">
		<div class="admin-header-tool">
			<div class="admin-search-box">
				<form class="admin-search" method="post" name="searchform" action="administrator-3.php">
				 	<select name="search_type" class="nav-search-type">
						<option>搭配</option>
						<option>用户</option>
					</select>
					<input name="search_name" placeholder="请输入用户名" class="admin-search-input" style="width: 100px;" type="text" maxlength="12" value=""/>
					<select name="search_sex" id="user-sex">
						<option>性别</option>
						<option>男生</option>
						<option>女生</option>
					</select>
					<input name="search_stat" placeholder="身高" class="admin-search-input" style="width: 36px;" type="number" oninput="if(value.length>3)value=value.slice(0,3);" value=""/>
					<input name="search_title" placeholder="请输入图片标题" id="pic_title" class="nav-search-input" style="width: 120px;" type="text" maxlength="9" value=""/>
					<input id="search-button" type="submit" value="搜索"/>
				</form>
			</div>
			<div class="clear"></div>
		</div>	
		
		<div class="admin-user">
			<?php 
				$a0 = new Admin();
				$a0->curPage = @$_GET['page']?:1;
				$a0->sqls = "SELECT COUNT(*) as total FROM gp_user where rule_id=2"; 
				$a0->queryPage();
				$a0->sql = "select * from gp_user where rule_id=2 ORDER BY id DESC LIMIT $a0->startRow,$a0->pageSize";
				$a0->queryUser();
			?>
			<div class="content-page" style="float: none; width: 927px;">
				<div style="float: right;">
					<?php 
						if($a0->curPage<=0||$a0->curPage==""){
							$a0->curPage = 1;
						}else if($a0->curPage > $a0->pageNum){
							$a0->curPage = $a0->pageNum; 
						}

						if($a0->curPage!=1){
							if($a0->curPage<=3){
								for ($i=1; $i<$a0->curPage; $i++){
									echo "<a href='administrator.php?page=$i'>".$i."</a>";
								}
							}else{
								echo "<a href='administrator.php?page=".($a0->curPage-1)."'>上一页&nbsp;&gt;</a>
										<a href='administrator.php'>1</a>
										<a>...</a>";
								for ($i=($a0->curPage-2); $i<$a0->curPage; $i++){
									echo "<a href='administrator.php?page=$i'>".$i."</a>";
								}
							}
						}

						echo '<a class="current-page" href="javascript:void(0);">'.$a0->curPage.'</a>';

						for ($i=($a0->curPage+1); $i<=$a0->pageNum; $i++){
							echo "<a href='administrator.php?page=$i'>".$i."</a>";
						}
						if(($a0->pageNum-$a0->curPage)>=3){
							echo "<a>...</a>
							<a href='administrator.php?page=".($a0->curPage+1)."'>下一页&nbsp;&gt;</a>";
						}
					?>
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>
</main>


<footer>
<div class="bottom" style="width: 65%; margin: 0 0 0 25%;">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

</body>

<script src="public/js/scroll.js"></script>
<script src="public/js/adminstrator.js"></script>
</html>
