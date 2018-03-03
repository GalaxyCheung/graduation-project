<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>基于PHP的传媒公司网站</title>
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<style>
	.nav-middle ul li:first-child{
		background-color: #00c9d0;
	}	
	
</style>
</head>


<body>

<?php include("header.php"); ?>

<div class="slide-box">
	<div id="arrow-left"><img src="public/images/arrowleft.jpg" /></div>
	<div id="arrow-right"><img src="public/images/arrowright.jpg" /></div>
	<div id="news">
		<div  id="newsBox">
			<div class="slide-pic">
					<ul>
						<li>
						<a href="detail.php"><img src="public/images/boys/20160103232318793_500.jpg" /></a>
							<div class="picture-info">
							<div class="profile-picture">
								<a href="space.php"><img src="public/images/AI.png" /></a>
							</div>
							<div class="user-info"></div>
							<div class="picture-caption"></div>
							</div>
						</li> 
						<li><a href="detail.php"><img src="public/images/boys/20170217082007173_500.jpg" /></a></li> 
						<li><a href="Ps.php"><img src="public/images/girls/20171225233703502_500.jpg" /></a></li>
						<li><a href="Ai.php"><img src="public/images/girls/20171226150828053_500.jpg" /></a></li>
						<li><a href="Pr.php"><img src="public/images/boys/20171222065120588_500.jpg" /></a></li>
					</ul>
			</div>
		</div>
	</div>
</div>

<div class="image-list-box">
	<div class="list-title">
		<div class="list-title-font">人气排名</div>
	</div>
	<div class="image-list">
		<ul>
			<div class="img-rank">
				<span>No.1</span>
				<span>No.2</span>
				<span>No.3</span>
				<span>No.4</span>
				<span>No.5</span>
			</div>
			<li><a href="space.php"><img src="public/images/boys/20160103232318793_500.jpg"/></a></li> 
			<li><a href="Dw.php"><img src="public/images/boys/20170217082007173_500.jpg"/></a></li> 
			<li><a href="Ps.php"><img src="public/images/girls/20171225233703502_500.jpg"/></a></li>
			<li><a href="Ai.php"><img src="public/images/girls/20171226150828053_500.jpg"/></a></li>
			<li><a href="Pr.php"><img src="public/images/boys/20171222065120588_500.jpg"/></a></li>
			<div class="clear"></div>
		</ul>
	</div>
</div>


<main>

	<div class="nav-middle-box">
		<nav class="nav-middle">
			<ul>
 				<li><a href="javascript:void(0)">不 限</a></li>
 				<li><a href="javascript:void(0)">男 生<img class="img-boys" src="public/images/boy.png" /></a></li>
 				<li><a href="javascript:void(0)">女 生<img class="img-girls" src="public/images/girl.png"/></a></li>
			</ul>
		</nav>
		<div class="nav-middle-angle"></div>  
	</div>

	<div class="backToTop-button">
		<img src="public/images/回到顶部.png" />
	</div>

	<div class="content-box">
		<div class="content">
		
			<?php 
				include("app/config.php");
				
				$sql = "select * from gp_pic inner join gp_user on gp_pic.u_id=gp_user.id ORDER BY gp_pic.id DESC";
				$result = mysqli_query($link,$sql);
				while($rs = mysqli_fetch_array($result)){
					echo "<div class='content-picture-box'>
							<div class='content-picture'>
								<a href='detail.php?pic_id=".@$rs[0]."'><img src='".@$rs[pic_url]."' /></a>
							</div>
							<div class='picture-info'>
								<div class='profile-picture'>
									<a href='space.php'><img src='".@$rs[prof_url]."' /></a>
								</div>
								<div class='intro-info'><p>".@$rs[name]." / ".@$rs[sex]." / ".@$rs[stature]."</p>
								</div>
								<div class='intro-info'><p>".@$rs[title]."</p></div>	
							</div>
						</div>";
				}
			?>
			
			<div class="clear"></div>
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

<script>

	//图片滚动
	var area = document.getElementById("newsBox");
	var aleft = document.getElementById("arrow-left");
	var aright = document.getElementById("arrow-right");
	area.scrollLeft = 0;
	var time = 2800;
	var myScroll;
	function left(){
		if(area.scrollLeft>=300*4){
			area.scrollLeft=0;
		}else{
			area.scrollLeft+=300;
		}
	}
	myScroll = setInterval('left()',time);
	
	area.onmouseover = function(){
		clearInterval(myScroll);
	}
	
	area.onmouseout = function(){
		myScroll = setInterval('left()',time);
	}
	
	aleft.onclick = function(){
		if(area.scrollLeft<300){
	 	area.scrollLeft+=300*4;
	 }else{
	 clearInterval(myScroll);
	 	area.scrollLeft-=300;
	 myScroll = setInterval('left()',time);
	 }
 	}
	
 	aright.onclick = function(){
 		clearInterval(myScroll);
		var scrollL = area.scrollLeft+300;
		if(scrollL>=300*4){
			area.scrollLeft = 0;
		}else{
			area.scrollLeft+=300;
		}
		myScroll = setInterval('left()',time);
 	}
	
	$(".slide-box").mouseenter(function(){
		$("#arrow-left").css({
			"display" : "block"
		});
		$("#arrow-right").css({
			"display" : "block"
		});
	});
	
	$(".slide-box").mouseleave(function(){
		$("#arrow-left").css({
			"display" : "none"
		});
		$("#arrow-right").css({
			"display" : "none"
		});
	});
	
//缩略图
	$(".image-list ul li").each(function(i){
		$(this).mouseenter(function(ev){
			$(this).find("img").css({
			});
			area.scrollLeft = 300*i;
			clearInterval(myScroll);
		})
		$(this).mouseleave(function(ev){
			$(this).find("img").css({
			});
			myScroll = setInterval('left()',time);
		})
	})
	
</script>

<script src="public/js/scroll.js"></script>
<script src="public/js/javascript.js"></script>
</body>
</html>
