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

<?php 
	class Index {
		
		public $sqlcount;
		public $pageCount;
		public $curPage;
		public $pageSize;
		public $startRow;
		public $pageNum;
		
		function queryPage(){
			
			include("app/config.php");
			
			$sqls  = "SELECT COUNT(id) as total FROM gp_pic";  
			$sqlcount = mysqli_query($link,$sqls);  
			$pageCount  = mysqli_fetch_array($sqlcount);  
			$this->pageCount = $pageCount['total']; 

			$this->curPage = @$_GET[page]?:'1';  

			$this->pageSize = 9;  

			$this->startRow = ($this->curPage-1) * $this->pageSize; 
			$this->pageNum = ceil($this->pageCount/$this->pageSize);

			if($this->curPage<=0||$this->curPage==""||!isset($this->curPage)){
				$this->curPage= 1;
			}else if($this->curPage > $this->pageNum){
				$this->curPage = $this->pageNum; 
			}
			mysqli_free_result($sqlcount);
			mysqli_close($link);
		}
		
		function queryPicBySex(){
			
			include("app/config.php");
			
			$sql = "select * from gp_pic inner join gp_user on gp_pic.u_id=gp_user.id ORDER BY gp_pic.id DESC LIMIT $this->startRow,$this->pageSize";

			$result = mysqli_query($link,$sql);
			while($rs = mysqli_fetch_array($result)){
				echo "<div class='content-picture-box'>
						<div class='content-picture'>
							<a href='detail.php?pic_id=".@$rs[0]."'><img src='".@$rs[pic_url]."' /></a>
						</div>
						<div class='picture-info'>
							<div class='profile-picture'>
								<a href='space.php?id=".@$rs[id]."'><img src='".@$rs[prof_url]."' /></a>
							</div>
							<div class='intro-info'><p>".@$rs[name]." / ".@$rs[sex]." / ".@$rs[stature]."<span> cm</span></p>
							</div>
							<div class='intro-info'><p>".@$rs[title]."</p></div>
							<div style='float:left; width:240px; height:20px;'><a style='float:right; display:block; font-size:10px; line-height:20px;'>".@$rs[time]."</a></div>	
						</div>
					</div>";
			}
		}
		
		function queryPicRank(){
			
			include("app/config.php");
			
			$sql = "select * from gp_pic inner join gp_user on gp_pic.u_id=gp_user.id ORDER BY gp_pic.like_num DESC  LIMIT 0,5";

			$result = mysqli_query($link,$sql);
			while($rs = mysqli_fetch_array($result)){
				echo "<li>
						<a href='detail.php?pic_id=".@$rs[0]."'><img src='".@$rs[pic_url]."' /></a>
							<div class='picture-info'>
							<div class='profile-picture'>
								<a href='space.php?id=".@$rs[id]."'><img src='".@$rs[prof_url]."' /></a>
							</div>
							<div class='user-info'>
								<p>".@$rs[name]." / ".@$rs[sex]." / ".@$rs[stature]."<span> cm</span></p>
								<p>".@$rs[title]."</p>
							</div>
							<div style='float:left; width:240px; height:20px;'><a style='float:right; display:block; font-size:9px; line-height:20px;'>".@$rs[time]."</a></div>
						</li>";
			}
		}
		
		function queryPicRank1(){
			
			include("app/config.php");
			
			$sql = "select * from gp_pic ORDER BY like_num DESC LIMIT 0,5";

			$result = mysqli_query($link,$sql);
			while($rs = mysqli_fetch_array($result)){
				echo "<li><a href='detail.php?pic_id=".@$rs[0]."'><img src='".@$rs[pic_url]."'/></a></li>";
			}
		}
	}
	$i = new Index();
	$i->queryPage();
?>


<div class="slide-box">
	<div id="arrow-left"><img src="public/images/arrowleft.jpg" /></div>
	<div id="arrow-right"><img src="public/images/arrowright.jpg" /></div>
	<div id="news">
		<div  id="newsBox">
			<div class="slide-pic">
					<ul>
						<?php $i->queryPicRank(); ?>
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
			<?php $i->queryPicRank1(); ?>
		</ul>
	</div>
</div>


<main>

	<div class="nav-middle-box">
		<nav class="nav-middle">
			<ul>
 				<li><a href="index-2.php">不 限</a></li>
 				<li><a href="index-2.php?sex=男生">男 生<img class="img-boys" src="public/images/boy.png" /></a></li>
 				<li><a href="index-2.php?sex=女生">女 生<img class="img-girls" src="public/images/girl.png"/></a></li>
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
				$i->queryPicBySex();
			?>
			<div class="clear"></div>
		</div>
		
		<div class="content-page">
			<?php
				$curPage = $i->curPage;
				$pageNum = $i->pageNum;
		
				if($curPage<=0||$curPage==""){
					$curPage = 1;
				}else if($curPage > $pageNum){
					$curPage = $pageNum; 
				}
			
				if($curPage!=1){
					if($curPage<=3){
						for ($i=1; $i<$curPage; $i++){
							echo "<a href='index.php?page=$i'>".$i."</a>";
						}
					}else{
						echo "<a href='index.php?page=".($curPage-1)."'>上一页&nbsp;&gt;</a>
						<a href='index.php?page=1'>1</a>
							<a>...</a>";
						for ($i=($curPage-2); $i<$curPage; $i++){
							echo "<a href='index.php?page=$i'>".$i."</a>";
						}
					}
				}
			?>
				<a class="current-page" href="javascript:viod(0);"><?php echo $curPage ?></a>
			<?php
				for ($i=($curPage+1); $i<=$pageNum; $i++){
					echo "<a href='index.php?page=$i'>".$i."</a>";
				}
				if(($pageNum-$curPage)>=3){
					echo "<a>...</a>
					<a href='index.php?page=".($curPage+1)."'>下一页&nbsp;&gt;</a>";
				}
			?>		
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
