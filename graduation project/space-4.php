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
<style>
	.nav ul li:first-child {
		background-color: #474747;
	}

	.nav ul li:hover {
		background-color: #00c9d0;
	}	
</style>
<body>
	

<?php include("header.php");?>
	
<?php
	$userId = @$_GET['id']?:@$_SESSION['currentUser']['id'];
	class Space4 {
		
		public $pageCount;
		public $curPage;
		public $pageSize;
		public $startRow;
		public $pageNum;
		public $currUserId;
		public $userId;
		
		function queryUser(){
			include("app/config.php");
			
			$userId = @$_GET['id']?:@$_SESSION['currentUser']['id'];
			
			$sql  = "SELECT * FROM gp_user where id='$userId'"; 
			$result = mysqli_query($link,$sql);
			$rs  = mysqli_fetch_array($result);
			$_SESSION['user'] = $rs;
			
			mysqli_free_result($result);
			mysqli_close($link);
		}
		
		function queryPage(){
			include("app/config.php");
			
			$this->currUserId = @$_SESSION['currentUser']['id'];
			$this->userId = @$_GET['id']?:$this->currUserId;
			
			
			$sqls  = "SELECT COUNT(*) as total FROM gp_user inner join gp_pic on gp_user.id=gp_pic.u_id where gp_user.id='$this->userId'"; 

			$sqlcount = mysqli_query($link,$sqls);
			$pageCount  = mysqli_fetch_array($sqlcount);
			$this->pageCount = $pageCount['total']; 	

			$this->curPage = @$_GET[page]?:'1';  

			$this->pageSize = 8;  

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
		
		function queryFollowUser(){

			include("app/config.php");
			$this->queryPage();
			
			$sql = "select * from gp_user_follow inner join gp_user on gp_user_follow.u_id=gp_user.id where gp_user_follow.f_id='$this->userId' ORDER BY gp_user_follow.id DESC LIMIT $this->startRow,$this->pageSize";
			$result = mysqli_query($link,$sql);
			while($rs = mysqli_fetch_array($result)){
				echo  "<div class='detail-header'>
						<div class='header-title'>
							<div class='title-box'>
								<div class='title-user-message'>
									<div class='title-profile-picture'>
										<a href='space.php?id=".@$rs[id]."'><img src='".@$rs[prof_url]."' /></a>
									</div>
									<div class='display-none user-id'>".@$rs[id]."</div>
									<div class='title-user-introduction'>
										<p>".@$rs[name]."</p>
										<p>".@$rs[sex]." / ".@$rs[stature]."<span> cm</span></p>
										<p>".@$rs[signature]."</p>
									</div>
								</div>
								<div class='title-button'>";
				
								if(isset($_SESSION['currentUser'])&&$_SESSION['currentUser']['id']!=$rs['id']){
									if($this->queryFollow($_SESSION['currentUser']['id'],$rs['id'])==0){
										echo "<ul class='user-button follow-button'><li><a>关注</a></li></ul>";
									}else{
										echo "<ul class='user-button followed'><li><a>取消关注</a></li></ul>";
									}
								}
								echo "<ul class='user-button'><li><a href='space.php?id=$rs[id]'>个人空间</a></li></ul>
								</div>
							</div>
						</div>
					</div>";
				}
				if(mysqli_num_rows($result) < 1){
					echo "<div style='margin:80px; 80px;'><h1>还没被别人关注哦</h1></div>";
				}
			mysqli_free_result($result);
			mysqli_close($link);
		}	
		
		function queryFollow($u1,$u2){
			include("app/config.php");
			$sql1 = "select count(*) as total from gp_user_follow where u_id = $u1 and f_id = $u2";
			$result1 = mysqli_query($link,$sql1);
			$rs1 = mysqli_fetch_array($result1);
			return $rs1['total'];
		}
	}
	
	
?>
<?php 
	$s = new Space4();
	$s->queryUser();
?>
	
<div class="space-header">
	<div class="space-header-box">
		<div class="space-user-info">
			<div class="space-profile-picture">
				<img src="<?php echo @$_SESSION['user'][prof_url] ?>" />
			</div>

			<div class="display-none user-id"><?php echo @$_SESSION['user'][id] ?></div>
			<div class="space-user-introduction">
				<p class="user-name"><?php echo @$_SESSION['user'][name] ?></p>
				<div class="display-none">
					<input id="space-user-stature" autofocus type="number" placeholder="身高" oninput="if(value.length>3)value=value.slice(0,3)" value="<?php echo @$_SESSION['user'][stature] ?>" />
					<span> cm /</span>
					<select id="space-user-sex" type="text" placeholder="性别" maxlength="8" value="<?php echo @$_SESSION['user'][sex] ?>">
						<option>男生</option>
						<option>女生</option>
					</select>
					<span style="margin-left: 10px; color: #292020;">修改密码:</span><input id="pwd" class="space-user-pass" type="password" placeholder="原密码" maxlength="16" value="" />
					<input id="new-pwd" class="space-user-pass" type="password" placeholder="新密码" maxlength="16" value="" />
					<input id="cfm-pwd" class="space-user-pass" type="password" placeholder="确认密码" maxlength="16" value="" />
				</div>
				<p class="user-charact"><a class="user-stature"><?php echo @$_SESSION['user'][stature] ?></a> cm /&nbsp;<a class="user-sex"><?php echo @$_SESSION['user'][sex] ?></a></p>
				<input id="space-user-signature" type="text" placeholder="编辑个性签名" maxlength="40" value="<?php echo @$_SESSION['user'][signature] ?>" />
				<p class="user-signature"><?php echo @$_SESSION['user'][signature] ?></p>
				<p class="empty-signature display-none">这个人很懒，什么也没留下</p>
			</div>
			<?php
				if(@$_SESSION['user']['id']==@$_SESSION['currentUser']['id']){
					echo"<div class='edit-info-button'>
							<a id='info-button' href='javascript:void(0);'>编辑个人信息</a>
						</div>

						<div class='edit-info-button display-none'>
							<a id='finsh-button' href='javascript:void(0);'>完成编辑</a>
						</div>";
				}else{
					if(isset($_SESSION['currentUser'])&&$_SESSION['currentUser']['id']!=$_SESSION['user']['id']){
					echo"<div class='title-button' style='margin-top:41px;'>";
						if($s->queryFollow($_SESSION['currentUser']['id'],$_SESSION['user']['id'])==0){
							echo "<ul class='user-button follow-button'><li><a>关注</a></li></ul>";
						}else{
							echo "<ul class='user-button followed'><li><a>取消关注</a></li></ul>";
						}
				echo "</div>";
					}
				}	 
			?>
		</div>
	</div>
	
</div>


<main>

	<div class="nav-middle-box">
		<nav class="nav-middle">
			<ul>
				<?php
					echo "<li><a href='space.php?id=".$userId."'>搭配</a></li>
					<li><a href='space-2.php?id=".$userId."'>喜欢</a></li>
					<li><a href='space-3.php?id=".$userId."'>关注</a></li>
					<li><a href='space-4.php?id=".$userId."'>粉丝</a></li>";
				?>
			</ul>
		</nav>
		<div class="nav-middle-angle"></div>  
	</div>

	
	<div class="backToTop-button">
		<img src="public/images/回到顶部.png" />
	</div>
	
	
	<div class="content-box">
		
		<div class="content">
		
			<?php $s->queryFollowUser(); ?>
		
		</div>
		
		<div class="content-page">
			<?php
				$curPage = $s->curPage;
				$pageNum = $s->pageNum;
			
				if($curPage<=0||$curPage==""){
					$curPage = 1;
				}else if($curPage > $pageNum){
					$curPage = $pageNum; 
				}
			
					if($curPage!=1){
						if($curPage<=3){
							for ($i=1; $i<$curPage; $i++){
								echo "<a href='space-4.php?id=$userId&page=$i'>".$i."</a>";
							}
						}else{
							echo "<a href='space-4.php?page=".($curPage-1)."'>上一页&nbsp;&gt;</a>
							<a href='space-4.php?id=$userId&page=1'>1</a>
								<a>...</a>";
							for ($i=($curPage-2); $i<$curPage; $i++){
								echo "<a href='space-4.php?id=$userId&page=$i'>".$i."</a>";
							}
						}
					}
				?>
					<a class="current-page" href="javascript:void(0);"><?php echo $curPage ?></a>
				<?php
					for ($i=($curPage+1); $i<=$pageNum; $i++){
						echo "<a href='space-4.php?id=$userId&page=$i'>".$i."</a>";
					}
					if(($pageNum-$curPage)>=3){
						echo "<a>...</a>
						<a href='space-4.php?id=$userId&page=".($curPage+1)."'>下一页&nbsp;&gt;</a>";
					}
			?>
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
	
	$(".nav-middle ul li:nth-child(4)").css({
		"background-color" : "#00c9d0"
	});
	
	$(".nav-middle-angle").css({
		"margin-left" : "414px"
	});
	$(document).ready(function(){
		if($(".user-signature").text() === ""|| $(".user-signature").text() === null){
			$(".user-signature").addClass("display-none");
			$(".empty-signature").removeClass("display-none");
		}else{
			$(".empty-signature").addClass("display-none");
			$(".user-signature").removeClass("display-none");
		}
	});
</script>
</body>
</html>
