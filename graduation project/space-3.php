<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人空间</title>
<link href="public/css/detail.css" rel="stylesheet" type="text/css">
<link href="public/css/space.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
</head>

<body>
	

<?php include("header.php");?>
	
<div class="space-header">
	<div class="space-header-box">
		<div class="space-user-info">
			<div class="space-profile-picture">
				<img src="public/images/AI.png" />
			</div>
			
			<div class="space-user-introduction">
				<p class="user-name">咋撒啊</p>
				<div class="display-none">
					<input id="space-user-stature" autofocus type="text" placeholder="身高" maxlength="3" value="" />
					<span>cm /</span>
					<select id="space-user-sex" type="text" placeholder="性别" maxlength="8" value="">
						<option>男生</option>
						<option>女生</option>
					</select>
				</div>
				<p class="user-charact"><a class="user-stature">162</a> cm /&nbsp;<a class="user-sex">男生</a></p>
				<input id="space-user-signature" type="text" placeholder="编辑个性签名" maxlength="40" value="" />
				<p class="user-signature">1</p>
			</div>
			
			<div class="edit-info-button">
				<a id="info-button" href="javascript:void(0);">编辑个人信息</a>
			</div>
			
			<div class="edit-info-button display-none">
				<a id="finsh-button" href="javascript:void(0);">完成编辑</a>
			</div>
		</div>
	</div>
	
</div>
	

<main>

	<div class="nav-middle-box">
		<nav class="nav-middle">
			<ul>
 				<li><a href="space.php">搭配</a></li>
 				<li><a href="space-2.php">喜欢</a></li>
 				<li><a href="space-3.php">关注</a></li>
 				<li><a href="space-4.php">粉丝</a></li>
			</ul>
		</nav>
		<div class="nav-middle-angle"></div>  
	</div>

	
	<div class="backToTop-button">
		<img src="public/images/回到顶部.png" />
	</div>
	
	
	<div class="content-box">
		
		
		<div class="detail-header">
			<div class="header-title">
				<div class="title-box">
					<div class="title-user-message">
						<div class="title-profile-picture">
							<img src="public/images/AI.png" />
						</div>
						<div class="title-user-introduction">
							<p>1</p>
							<p>1</p>
							<p>1</p>
						</div>
					</div>
					<div class="title-button">
						<ul class="button-follow">
							<li><a>取消关注</a></li>
						</ul>
						<ul class="button-chat">
							<li><a>私信</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="content-page">
					<a href="javascript:void(0)">&lt;&nbsp;上一页</a>
					<a class="current-page" href="javascript:void(0)">1</a>
					<a href="javascript:void(0)">2</a>
					<a href="javascript:void(0)">3</a>
					<a href="javascript:void(0)">4</a>
					<a href="javascript:void(0)">5</a>
					<a>...</a>
					<a href="javascript:void(0)">下一页&nbsp;&gt;</a>
		</div>
			<div class="clear"></div>
	</div>
</main>


<footer>
<div class="bottom">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

<script src="public/js/scroll.js"></script>
<script src="public/js/space.js"></script>
<script src="public/js/javascript.js"></script>

<script>
	$(".nav-middle ul li:first-child").css({
		"background-color" : "#444447"
	});
	
	$(".nav-middle ul li:nth-child(3)").css({
		"background-color" : "#00c9d0"
	});
	
	$(".nav-middle-angle").css({
		"margin-left" : "292px"
	});
</script>
</body>
</html>
