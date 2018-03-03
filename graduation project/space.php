<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人空间</title>
<link href="public/css/space.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<style>
	.nav-middle ul li:first-child{
		background-color: #00c9d0;
	}	
	
	.nav-middle-angle{
		margin-left: 48px;
	}
</style>
</head>

<body>
	

<?php include("header.php");?>
	
<div class="space-header">
	<div class="space-header-box">
		<div class="space-user-info">
			<div class="space-profile-picture">
				<img src="<?php echo @$_SESSION['currentUser'][prof_url] ?>" />
			</div>
			
			<div class="space-user-introduction">
				<p class="user-name"><?php echo @$_SESSION['currentUser'][name] ?></p>
				<div class="display-none">
					<input id="space-user-stature" autofocus type="text" placeholder="身高" maxlength="3" value="<?php echo @$_SESSION['currentUser'][stature] ?>" />
					<span> cm /</span>
					<select id="space-user-sex" type="text" placeholder="性别" maxlength="8" value="<?php echo @$_SESSION['currentUser'][sex] ?>">
						<option>男生</option>
						<option>女生</option>
					</select>
				</div>
				<p class="user-charact"><a class="user-stature"><?php echo @$_SESSION['currentUser'][stature] ?></a> cm /&nbsp;<a class="user-sex"><?php echo @$_SESSION['currentUser'][sex] ?></a></p>
				<input id="space-user-signature" type="text" placeholder="编辑个性签名" maxlength="40" value="<?php echo @$_SESSION['currentUser'][signature] ?>" />
				<p class="user-signature"><?php echo @$_SESSION['currentUser'][signature] ?></p>
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
		
		<div class="content">
			
			<div class="space-picture-box">
				
				<div class="space-picture">
					<img src="public/images/boys/20160103232318793_500.jpg" />
				</div>
				
				<div class="space-picture-introduction">

					<div class="edit-button edit-pic-button">
						<a href="javascript:void(0);"><span>∨</span> 编辑搭配</a>
					</div>

					<div class="close-button edit-pic-button display-none">
						<a href="javascript:void(0);"><span>∧</span> 完成编辑</a>
					</div>
					
					<div class="space-introduction-content">
						<div class="introduction-title">
							<textarea class="space-h1 display-none" type="text" placeholder="编辑标题" maxlength="17" value=""></textarea>
							<h1 class="h1-a"><a>1233121321321321</a></h1>
							<textarea class="space-h2 display-none" type="text" placeholder="编辑副标题" maxlength="40" value=""></textarea>
							<h2 class="h2-a"><a>12312132132132132</a></h2>
						</div>
						<div class="introduction-content">
							<textarea class="space-cont display-none" type="text" placeholder="编辑介绍内容" maxlength="300" value=""></textarea>	
							<div class="cont-a"><a>12312132132132112132132132112132132132112132132131213213213211213213213212132</a>
							</div>
						</div>
					</div>
					
					<div class="delete-button edit-pic-button display-none">
						<a href="javascript:void(0);"><span>×</span> 删除搭配</a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			
			
			<div class="space-picture-box">
				
				<div class="space-picture">
					<img src="public/images/boys/20160103232318793_500.jpg" />
				</div>
				
				<div class="space-picture-introduction">

					<div class="edit-button edit-pic-button">
						<a href="javascript:void(0);"><span>∨</span> 编辑搭配</a>
					</div>

					<div class="close-button edit-pic-button display-none">
						<a href="javascript:void(0);"><span>∧</span> 完成编辑</a>
					</div>
					
					<div class="space-introduction-content">
						<div class="introduction-title">
							<textarea class="space-h1 display-none" type="text" placeholder="编辑标题" maxlength="17" value=""></textarea>
							<h1 class="h1-a"><a>1233121321321321</a></h1>
							<textarea class="space-h2 display-none" type="text" placeholder="编辑副标题" maxlength="40" value=""></textarea>
							<h2 class="h2-a"><a>12312132132132132</a></h2>
						</div>
						<div class="introduction-content">
							<textarea class="space-cont display-none" type="text" placeholder="编辑介绍内容" maxlength="300" value=""></textarea>	
							<div class="cont-a"><a>12312132132132112132132132112132132132112132132131213213213211213213213212132</a>
							</div>
						</div>
					</div>
					
					<div class="delete-button edit-pic-button display-none">
						<a href="javascript:void(0);"><span>×</span> 删除搭配</a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			
			
			<div class="space-picture-box">
				
				<div class="space-picture">
					<img src="public/images/boys/20160103232318793_500.jpg" />
				</div>
				
				<div class="space-picture-introduction">

					<div class="edit-button edit-pic-button">
						<a href="javascript:void(0);"><span>∨</span> 编辑搭配</a>
					</div>

					<div class="close-button edit-pic-button display-none">
						<a href="javascript:void(0);"><span>∧</span> 完成编辑</a>
					</div>
					
					<div class="space-introduction-content">
						<div class="introduction-title">
							<textarea class="space-h1 display-none" type="text" placeholder="编辑标题" maxlength="17" value=""></textarea>
							<h1 class="h1-a"><a>1233121321321321</a></h1>
							<textarea class="space-h2 display-none" type="text" placeholder="编辑副标题" maxlength="40" value=""></textarea>
							<h2 class="h2-a"><a>12312132132132132</a></h2>
						</div>
						<div class="introduction-content">
							<textarea class="space-cont display-none" type="text" placeholder="编辑介绍内容" maxlength="300" value=""></textarea>	
							<div class="cont-a"><a>12312132132132112132132132112132132132112132132131213213213211213213213212132</a>
							</div>
						</div>
					</div>
					
					<div class="delete-button edit-pic-button display-none">
						<a href="javascript:void(0);"><span>×</span> 删除搭配</a>
					</div>
					<div class="clear"></div>
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
</body>
</html>
