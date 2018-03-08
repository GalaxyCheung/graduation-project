<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>详情</title>
<link href="public/css/detail.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
</head>

<body>

<?php 
	include("header.php"); 
	include("app/config.php");
	
	@$pic_id = $_GET['pic_id'];
	
	$sql_p = "select * from gp_pic where id='".$pic_id."'";
	$result_p = mysqli_query($link, $sql_p);
	$rs_p = mysqli_fetch_array($result_p);
		
	$sql_u = "select * from gp_user where id='".$rs_p['u_id']."'";
	$result_u = mysqli_query($link, $sql_u);
	$rs_u = mysqli_fetch_array($result_u);
	
?> 


<div class="detail-header">
	<div class="header-title">
		<div class="title-box">
			<div class="title-user-message">
				<div class="title-profile-picture">
					<div class="display-none" id="user-id"><?php echo @$rs_u['id']; ?></div>
					<img src="<?php echo @$rs_u['prof_url']; ?>" />
				</div>
				<div class="title-user-introduction">
					<p><?php echo @$rs_u['name']; ?></p>
					<p><?php echo @$rs_u['sex']." / ". @$rs_u['stature']."cm"; ?></p>
					<p class="signa"><?php echo @$rs_u['signature']; ?></p>
				</div>
			</div>
			<div class="title-button">
					<?php 
						if(@$_SESSION['currentUser']['id'] !== @$rs_u['id']){
							echo "<ul class='user-button follow-button'><li><a>关注</a></li></ul>
								<ul class='user-button'><li><a>私信</a></li></ul>";
						}else{
							echo "<ul class='user-button'><li><a href='space.php'>个人空间</a></li></ul>
								<ul class='user-button'><li><a>查看信息</a></li></ul>";
						}
					?>
				
			</div>
		</div>
	</div>
</div>


<div class="backToTop-button">
	<img src="public/images/回到顶部.png" />
</div>
	
<main>
	<div class="detail-content-box">
		<div class="detail-content">
			<div class="detail-picture">
				<div class="display-none" id="pic-id"><?php echo @$rs_p['id']; ?></div>
				<img src="<?php echo @$rs_p['pic_url']; ?>">
					<div class="picture-button"><a href="javascriot:void(0);"><span>▽</span>评论</a></div>
					<?php
						$sql1 = "select count(1) as total from gp_pic_like where u_id = '".@$_SESSION['currentUser']['id']."' and p_id = '".$pic_id."'";
						$result1 = mysqli_query($link,$sql1);
						$rs1 = mysqli_fetch_array($result1);
						if($rs1['total'] == 1||@$rs_u['id']==@$_SESSION['currentUser']['id']){
							echo "<div class='picture-button'><a class='like-button' href='javascriot:void(0);'>已喜欢</a></div>";
						}else{
							echo "<div class='picture-button'><a class='like-button' href='javascriot:void(0);'><span>♡</span>喜欢</a></div>";
						}
						mysqli_free_result($result1);
					?>
			</div>

			<div class="detail-comments">
				<div class="comments-title">
					<p>对「 <?php echo @$rs_p['title']; ?> 」的评论</p>
				</div>
				
				<div class="comments-content">
					
				</div>
			</div>

			<div class="clear"></div>
		</div>

		<div class="detail-picture-introduction">
			<div class="introduction-title">
				<h1><?php echo @$rs_p['title']; ?></h1>
				<h2><?php echo @$rs_p['subtitle']; ?></h2>
			</div>
			<div class="introduction-content">
				<p><?php echo @$rs_p['intro']; ?></p>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</main>


<footer>
<div class="bottom">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

<script src="public/js/scroll.js"></script>
<script src="public/js/javascript.js"></script>
<script>
	$(document).ready(function(){
		if($(".like-button").text == "已喜欢"){
			$(this).removeClass("like-button");
		}
		if($(".signa").text() === ""|| $(".signa").text() === null){
			$(".signa").text("这个人很懒,什么也没留下");
		}
	});
	
	$(".like-button").mousedown(function(){
		var pic_id = $("#pic-id").text();
		var user_id = $("#user-id").text();
		$.ajax({
			url: "app/likePic.php",
			type: "POST",
			dataType: "json",
			data: {
				pic_id: pic_id,
				user_id: user_id
			},
			success:function(data){
				if(data[0] == 0){
					$(".like-button").text("已喜欢");
				}else if(data[0] == 1){
					window.location.href("login.php");
				}
			},
			error:function(data){
				alert('ajax error!'+data[0]);
			}
		});		
	});
</script>
</body>
</html>
