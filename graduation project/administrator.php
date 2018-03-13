<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<title>管理员页面</title>
<style>

.side-bar{
	top:181px;
	position:fixed;
	width: 15%;
	height: 100%;
	background-color: #fff;
	box-shadow: 4px 0 4px -2px rgba(0, 0, 0, .3);
	overflow: hidden;
}

.side-bar ul{	
	margin-top: 15%;
	height: 15%;
}
	
.side-bar ul li{
	height: 66%;
}
	
.side-bar ul li:first-child {
	background-color: #ddd;
}
	
.side-bar ul li:hover{
	background-color: #ddd;
	cursor: pointer;
}

.side-bar ul li div{
	padding:10% 0 0 16%;
}
	
.side-bar ul li div span{
	color: #474747;
	font-size: 14px;
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
?>
<header id="header">
	<div class="header-tool">
		<div class="header-tool-box" style="max-width: none;">
			<div class="header-user-box">
					<dl>
					<?php 
						echo '<a href="space.php" style="display:inline-block; float:left; margin-right:8px; width:30px; height:30px;"><img style=" width:30px; height:30px;" src="'.@$_SESSION['currentUser'][prof_url].'" /></a>
						<dd style="width:72px;"><span style="padding-right:5px;"></span><a href="space.php" style="padding-left:5px; color: darkcyan;">'.@$_SESSION['currentUser'][name].'</a></dd>
						<dd><span></span><a href="login.php">注销</a></dd>';
					?>
						<dd><span></span><a href="signup.php">消息</a></dd>
						<dd><a href="publish.php">发布</a></dd>
					</dl>
			</div>
			<?php
				if($_SESSION['currentUser']['rule_id']==1){
					echo '<div style="float:left;"><a href="administrator.php">&lt;-管理员页面-&gt</a></div>'; 
				}
			?>
		</div>
	</div>
	<div id="header-1">
		<div id="header-box">
			<div class="header-logo"><a href="index.php">
				<img src="public/images/header_logo.png"/></a>
			</div>
		</div>
	</div>
		
	
	<nav class="nav">
		<ul style="width: 65%;">
 			<li><a href="index.php">首 页</a></li>
  			<li><a href="index-2.php">搭配频道</a></li>
  			<li><a href="index-3.php">搭配达人</a></li>
			<div class="nav-search-box">
				<form class="nav-search" method="post" name="searchform" action="search.php">
				 	<select name="search_type" class="nav-search-type">
						<option>搭配</option>
						<option>用户</option>
					</select>
					<input name="search_name" placeholder="请输入用户名" class="nav-search-input" style="width: 100px;" type="text" maxlength="12" value=""/>
					<select name="search_sex" id="user-sex">
						<option>性别</option>
						<option>男生</option>
						<option>女生</option>
					</select>
					<input name="search_stat" placeholder="身高" class="nav-search-input" style="width: 36px;" type="number" oninput="if(value.length>3)value=value.slice(0,3);" value=""/>
					<input name="search_title" placeholder="请输入图片标题" id="pic_title" class="nav-search-input" style="width: 120px;" type="text" maxlength="9" value=""/>
					<a class="search-img"><input type="submit" style="width: 45px; height: 27px; filter: alpha(opacity=0); -moz-opacity: 0; opacity: 0; cursor: pointer;"/></a> 
				</form>
			</div>
		</ul>
	</nav>
</header>

<main>
	<div class="side-bar">
		<ul>
			<li class="user-bar">
				<div><span>用户管理</span></div>
			</li>
			<li class="pic-bar">
				<div><span>图片管理</span></div>
			</li>
			<li class="comm-bar">
				<div><span>留言管理</span></div>
			</li>
			<div class="clear"></div>
		</ul>
	</div>
	<div class="admin-content" style="height: 1600px;"></div>
	<div class="clear"></div>
</main>


<footer>
<div class="bottom" style="width: 65%; margin: 0 0 0 25%;">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

</body>
<script src="public/js/scroll.js"></script>
<script> 
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
