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
<?php
	$userId = @$_GET['id']?:@$_SESSION['currentUser']['id'];
	class space {
		
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

			$this->pageSize = 6;  

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
		
		function queryUserPic(){

			include("app/config.php");
			$i = new space();
			$i->queryPage();
			
			$sql = "select * from gp_user inner join gp_pic on gp_user.id=gp_pic.u_id where gp_user.id='$i->userId' ORDER BY gp_pic.id DESC LIMIT $i->startRow,$i->pageSize";
			$result = mysqli_query($link,$sql);
			while($rs = mysqli_fetch_array($result)){
				echo "<div class='space-picture-box'>
						<div class='space-picture'>
							<img src='".@$rs[pic_url]."' />
						</div>
						<div class='space-picture-introduction'>";
					if($i->currUserId==$i->userId){
						echo "<div class='edit-button edit-pic-button'>
								<a href='javascript:void(0);'><span>∨</span> 编辑搭配</a>
								<a href='detail.php?pic_id=$rs[8]'><span>&lt;</span> 查看搭配</a>
							</div>

							<div class='close-button edit-pic-button display-none'>
								<a href='javascript:void(0);'><span>∧</span> 完成编辑</a>
								<a href='javascript:void(0);'><span>∧</span> 取消编辑</a>
							</div>";
					}else{}
						echo"<div class='space-introduction-content'>
								<div class='pic-id display-none'>".@$rs[8]."</div>
								<div class='introduction-title'>
									<textarea class='space-h1 display-none' type='text' placeholder='编辑标题' maxlength='17' value='".@$rs[title]."'></textarea>
									<h1 class='h1-a'><a>".@$rs[title]."</a></h1>
									<textarea class='space-h2 display-none' type='text' placeholder='编辑副标题' maxlength='40' value='".@$rs[subtitle]."'></textarea>
									<h2 class='h2-a'><a>".@$rs[subtitle]."</a></h2>
								</div>
								<div class='introduction-content'>
									<textarea class='space-cont display-none' type='text' placeholder='编辑介绍内容' maxlength='300' value='".@$rs[intro]."'></textarea>	
									<div class='cont-a'><a>".@$rs[intro]."</a>
									</div>
								</div>
							</div>";
					if($i->currUserId==$i->userId){
						echo "<div class='delete-button edit-pic-button display-none'>
								<a href='javascript:void(0);'><span>×</span> 删除搭配</a>
							</div>";
						}else{}
					echo "<div class='clear'></div>
						</div>
					</div>";
				}
			mysqli_free_result($result);
			mysqli_close($link);
		}	
	}
?>
<?php 
	$s = new space();
	$s->queryUser();
?>
	
<div class="space-header">
	<div class="space-header-box">
		<div class="space-user-info">
			<div class="space-profile-picture">
				<img src="<?php echo @$_SESSION['user'][prof_url] ?>" />
			</div>
			
			<div class="space-user-introduction">
				<p class="user-name"><?php echo @$_SESSION['user'][name] ?></p>
				<div class="display-none">
					<input id="space-user-stature" autofocus type="text" placeholder="身高" maxlength="3" value="<?php echo @$_SESSION['user'][stature] ?>" />
					<span> cm /</span>
					<select id="space-user-sex" type="text" placeholder="性别" maxlength="8" value="<?php echo @$_SESSION['user'][sex] ?>">
						<option>男生</option>
						<option>女生</option>
					</select>
				</div>
				<p class="user-charact"><a class="user-stature"><?php echo @$_SESSION['user'][stature] ?></a> cm /&nbsp;<a class="user-sex"><?php echo @$_SESSION['user'][sex] ?></a></p>
				<input id="space-user-signature" type="text" placeholder="编辑个性签名" maxlength="40" value="<?php echo @$_SESSION['user'][signature] ?>" />
				<p class="user-signature"><?php echo @$_SESSION['user'][signature] ?></p>
			</div>
			<?php
				if(@$_SESSION['user']['id']==@$_SESSION['currentUser']['id']){
					echo"<div class='edit-info-button'>
							<a id='info-button' href='javascript:void(0);'>编辑个人信息</a>
						</div>

						<div class='edit-info-button display-none'>
							<a id='finsh-button' href='javascript:void(0);'>完成编辑</a>
						</div>";
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
			<?php
				$s->queryUserPic();
			?>
		</div>
		<div class="content-page">
			<?php
				$s->queryPage();
				$curPage = $s->curPage;
				$pageNum = $s->pageNum;
				$id = $s->userId;
				if($curPage<=0||$curPage==""){
					$curPage = 1;
				}else if($curPage > $pageNum){
					$curPage = $pageNum; 
				}
			
					if($curPage!=1){
						if($curPage<=4){
							for ($i=1; $i<$curPage; $i++){
								echo "<a href='space.php?id=$id&page=$i'>".$i."</a>";
							}
						}else{
							echo "<a href='space.php?page=($curPage-1)'>上一页&nbsp;&gt;</a>
							<a href='space.php?id=$id&page=1'>1</a>
								<a>...</a>";
							for ($i=($s-$curPage-2); $i<$curPage; $i++){
								echo "<a href='space.php?id=$id&page=$i'>".$i."</a>";
							}
						}
					}
				?>
					<a class="current-page" href="javascript:viod(0);"><?php echo $curPage ?></a>
				<?php
					for ($i=($curPage+1); $i<=$pageNum; $i++){
						echo "<a href='space.php?id=$id&page=$i'>".$i."</a>";
					}
					if(($pageNum-$curPage)>3){
						echo "<a>...</a>
						<a href='space.php?id=$id&page=($curPage+1)'>下一页&nbsp;&gt;</a>";
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
<script>
	
</script>
</body>
</html>
