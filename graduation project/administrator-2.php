<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<link href="public/css/admin.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<script src="public/js/adminstrator.js"></script>
<title>管理员页面</title>
<style>
	
.side-bar ul li:nth-child(2) {
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
	if(!isset($_SESSION['currentUser'])||@$_SESSION['currentUser']['rule_id']==2){
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
				<a href="administrator-2.php">搭配管理</a>
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
		
		<div class="admin-pic">
			<?php 
				$a1 = new Admin();
				$a1->curPage = @$_GET['page']?:1; 
				$a1->sqls = "select COUNT(*) as total from gp_pic"; 
				$a1->queryPage();
				$a1->sql = "select * from gp_pic inner join gp_user on gp_pic.u_id=gp_user.id ORDER BY gp_pic.id DESC LIMIT $a1->startRow,$a1->pageSize";
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
<script src="public/js/adminstrator.js"></script>
</html>
