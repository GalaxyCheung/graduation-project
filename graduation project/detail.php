<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>详情</title>
<link href="public/css/detail.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
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
					<img src="<?php echo @$rs_u['prof_url']; ?>" />
				</div>
				<div class="display-none user-id"><?php echo @$rs_u['id']; ?></div>
				<div class="title-user-introduction">
					<p><?php echo @$rs_u['name']; ?></p>
					<p><?php echo @$rs_u['sex']." / ". @$rs_u['stature']."cm"; ?></p>
					<p class="signa"><?php echo @$rs_u['signature']; ?></p>
				</div>
			</div>
			<div class="title-button">
					<?php 
					if(isset($_SESSION['currentUser'])){
						if(@$_SESSION['currentUser']['id'] !== @$rs_u['id']){
							
							$sql0 = "select count(*) as total from gp_user_follow where u_id = '".$_SESSION['currentUser']['id']."' and f_id = '".@$rs_u['id']."'";
								$result0 = mysqli_query($link,$sql0);
								$rs1 = mysqli_fetch_array($result0);
								
								if($rs1['total']==0){
									echo "<ul class='user-button follow-button'><li><a>关注</a></li></ul>";
								}else{
									echo "<ul class='user-button followed'><li><a>取消关注</a></li></ul>";
								}
								echo "<ul class='user-button'><li><a href='space.php?id=$rs_u[id]'>个人空间</a></li></ul>";
							
								mysqli_free_result($result0);
							
						}else{
							echo "<ul class='user-button'><li><a href='space.php'>个人空间</a></li></ul>";
						}
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
					<div class="picture-button"><a href="#comment-textarea"><span>▽</span>评论</a></div>
					<?php
					if(isset($_SESSION['currentUser'])){
						$sql1 = "select count(1) as total from gp_pic_like where u_id = '".@$_SESSION['currentUser']['id']."' and p_id = '".$pic_id."'";
						$result1 = mysqli_query($link,$sql1);
						$rs1 = mysqli_fetch_array($result1);
						if($rs1['total'] == 1||@$rs_u['id']==@$_SESSION['currentUser']['id']){
							echo "<div class='picture-button'><a class='dislike-button' href='javascriot:void(0);'>已喜欢</a></div>";
						}else{
							echo "<div class='picture-button'><a class='like-button' href='javascriot:void(0);'><span>♡</span>喜欢</a></div>";
						}
						mysqli_free_result($result1);
					}
					?>
			</div>

			<div class="detail-comments">
				<div class="comments-title">
					<p>对「 <?php echo @$rs_p['title']; ?> 」的评论</p>
				</div>
				<div class="comments-content">
				<?php 
					$sql2 = "select * from gp_pic_comment inner join gp_user on gp_pic_comment.u_id=gp_user.id where p_id = '".$rs_p['id']."'";
					$result2 = mysqli_query($link,$sql2);
					while($rs2 = mysqli_fetch_array($result2)){
						if($rs2[5] == $rs_u['id']){	
							echo '<div class="comments-box">
									<div class="comment-user" style="float:right;">
										<a href="space.php?id='.@$rs2[5].'"><img class="comment-profile" src="'.@$rs2[prof_url].'"/></a>
										<p class="comment-name">'.@$rs2[name].'</p>
									</div>
									<div class="comment-text" style="left:10px;">
										<div class="display-none comment-id">'.@$rs2[0].'</div>
										<p style="right:0; padding: 5px 10px 0 5px;">'.@$rs2[p_comment].'</p>
										<div class="arrow">
											<div class="user-arrow-1"></div>
											<div class="user-arrow-2"></div>
											<div class="user-arrow-3"></div>
										</div>
										<div class="clear"></div>
									</div>
								</div>';
						}else{	
							echo '<div class="comments-box">
									<div class="comment-user">
										<a href="space.php?id='.@$rs2[5].'"><img class="comment-profile" src="'.@$rs2[prof_url].'"/></a>
										<p class="comment-name">'.@$rs2[name].'</p>
									</div>
									<div class="comment-text">
										<div class="display-none comment-id">'.@$rs2[0].'</div>
										<p>'.@$rs2[p_comment].'</p>
										<div class="arrow">
											<div class="arrow-1"></div>
											<div class="arrow-2"></div>
											<div class="arrow-3"></div>
										</div>
										<div class="clear"></div>
									</div>
								</div>';
						}
					}
					if(mysqli_num_rows($result2) < 1){
						echo "<h1 style='padding:10px 0 25px 10px'>暂无评论</h1>";
					}
					mysqli_close($link);
				?>
					
					<div id="comment-form">
						<textarea class="comment-textarea" maxlength="60"></textarea>
						<input type="button" value="提交"/> 
					</div>
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
		if($(".signa").text() === ""|| $(".signa").text() === null){
			$(".signa").text("这个人很懒,什么也没留下");
		}
		$(".comments-box").last().css({
			"border-bottom" : "none"
		});
	});
	
	
	$(".like-button").mousedown(function(){
		var pic_id = $("#pic-id").text();
		var user_id = $(".user-id").text();
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
					window.location.reload();
				}else if(data[0] == 1){
					window.location.href("login.php");
				}
			},
			error:function(data){
				alert('ajax error!'+data[0]);
			}
		});		
	});
	
	$(".dislike-button").mousedown(function(){
		var pic_id = $("#pic-id").text();
		var user_id = $(".user-id").text();
		$.ajax({
			url: "app/dislikePic.php",
			type: "POST",
			dataType: "json",
			data: {
				pic_id: pic_id,
			},
			success:function(){
				window.location.reload();
			},
			error:function(data){
				alert('ajax error!'+data[0]);
			}
		});		
	});
	
	$("#comment-form input").mousedown(function(){
		var pic_id = $("#pic-id").text();
		var comm_text = $(".comment-textarea").val();
		$.ajax({
			url: "app/addComment.php",
			type: "POST",
			dataType: "json",
			data: {
				comm_text: comm_text,
				pic_id: pic_id
			},
			success:function(data){
				window.location.reload();
			},
			error:function(data){
				alert('ajax error!'+data[0]);
			}
		});	
	});
</script>
</body>
</html>
