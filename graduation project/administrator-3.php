<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<link href="public/css/admin.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<title>管理员页面</title>
<style>
	
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
	
	$type = @$_POST['search_type'];
	$name = @$_POST['search_name'];
	$sex = @$_POST['search_sex'];
	$stature = @$_POST['search_stat'];
	$title = @$_POST['search_title'];
	$page = @$_POST['page']?:1;
	
	if($sex == "性别"){
		$sex = "";
	}
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
			<div class="clear"></div>
		</ul>
	</div>
	
	<div class="admin-content" style="margin: 3% 0 2% 15%;">
		<div class="admin-header-tool" style="margin-bottom: 20px;">
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
		
		<div class="search-header">
			<div class="search-header-title">
				<h1> <?php
						$str = "";
						if($name!="")$str = "「 ".$name." 」";
						if($sex!="")$str = $str."「 ".$sex." 」";
						if($stature!="")$str = $str."「 ".$stature." cm 」";
						if($title!="")$str = $str."「 ".$title." 」";
						if($type == "搭配"&&$str == "")$str = "「所有搭配」";
						if($type == "用户"&&$str == "")$str = "「所有用户」";
						echo $str;
					?> 的检索结果</h1>
			</div>
		</div>
		
		<div class="admin-sear">
			<?php 
				$a2 = new Admin();
				$a2->curPage = $page;
				
				if($type=="搭配"){
					$sqls = "SELECT COUNT(gp_pic.id) as total FROM gp_pic inner join gp_user on gp_pic.u_id=gp_user.id where 1=1"; 
					if($name != ""||$name != null)
						$sqls = $sqls." and name like '%".$name."%'";
					if($sex != ""||$sex != null)
						$sqls = $sqls." and sex='".$sex."'";
					if($stature != ""||$stature != null)
						$sqls = $sqls." and stature='".$stature."'";
					if($title != ""||$title != null)
						$sqls = $sqls." and gp_pic.title like '%".$title."%'";
					$a2->sqls = $sqls;
					$a2->queryPage();
					
					$sql = "select * from gp_pic inner join gp_user on gp_pic.u_id=gp_user.id where 1=1";
					if($name != ""||$name != null)
						$sql = $sql." and name like '%".$name."%'";
					if($sex != ""||$sex != null)
						$sql = $sql." and sex='".$sex."'";
					if($stature != ""||$stature != null)
						$sql = $sql." and stature='".$stature."'";
					if($title != ""||$title != null)
						$sql = $sql." and gp_pic.title like '%".$title."%'";
					$sql = $sql." ORDER BY gp_pic.id DESC LIMIT $a2->startRow,$a2->pageSize";
					$a2->sql = $sql;
					$a2->queryPic();
				}else if($type=="用户"){
					$sqls = "SELECT COUNT(gp_user.id) as total FROM gp_user where 1=1"; 
					if($name != ""||$name != null)
						$sqls = $sqls." and name like '%".$name."%'";
					if($sex != ""||$sex != null)
						$sqls = $sqls." and sex='".$sex."'";
					if($stature != ""||$stature != null)
						$sqls = $sqls." and stature='".$stature."'";
					$a2->sqls = $sqls;
					$a2->queryPage();
					
					$sql = "select * from gp_user where 1=1";
					if($name != ""||$name != null)
						$sql = $sql." and name like '%".$name."%'";
					if($sex != ""||$sex != null)
						$sql = $sql." and sex='".$sex."'";
					if($stature != ""||$stature != null)
						$sql = $sql." and stature='".$stature."'";
					$sql = $sql." ORDER BY id DESC LIMIT $a2->startRow,$a2->pageSize";
					$a2->sql = $sql;
					$a2->queryUser();
				}
			?>
			
			<div class="content-page" style="float: none; width: 1000px;">
				<div style="float: right;">
					<?php 
						if($a2->curPage<=0||$a2->curPage==""){
							$a2->curPage = 1;
						}else if($a2->curPage > $a2->pageNum){
							$a2->curPage = $a2->pageNum; 
						}

						if($a2->curPage!=1){
							if($a2->curPage<=3){
								for ($i=1; $i<$a2->curPage; $i++){
									echo "<a class='page-num' href='javascript:void(0);'>".$i."</a>";
								}
							}else{
								echo "<a class='prev-page' href='javascript:void(0);'>上一页&nbsp;&gt;</a>
										<a class='page-num' href='javascript:void(0);'>1</a>
										<a>...</a>";
								for ($i=($a2->curPage-2); $i<$a2->curPage; $i++){
									echo "<a class='page-num' href='javascript:void(0);'>".$i."</a>";
								}
							}
						}

						echo '<a class="current-page" href="javascript:void(0);">'.$a2->curPage.'</a>';

						for ($i=($a2->curPage+1); $i<=$a2->pageNum; $i++){
							echo "<a class='page-num' href='javascript:void(0);'>".$i."</a>";
						}
						if(($a2->pageNum-$a2->curPage)>=3){
							echo "<a>...</a>
							<a class='next-page' href='javascript:void(0);'>下一页&nbsp;&gt;</a>";
						}
					?>
					<form style="display: none;" method="post" action="administrator-3.php" id="changePage">
						<input name="search_type" value="<?php echo $type ?>"/>
						<input name="search_name" value="<?php echo $name ?>"/>
						<input name="search_sex" value="<?php echo $sex ?>"/>
						<input name="search_stat" value="<?php echo $stature ?>"/>
						<input name="search_title" value="<?php echo $title ?>"/>
						<input name="page" id="page" value=""/>
					</form>
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
