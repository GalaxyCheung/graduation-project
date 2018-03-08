<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>基于PHP的传媒公司网站</title>
<link href="public/css/detail.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<style>
	.nav ul li:first-child{
		background-color: #444447;
	}	
	
	.nav ul li:nth-child(3){
		background-color: #00c9d0;
	}	
	
	.nav-middle-box{
		margin-top: 40px;
	}
</style>
</head>


<body>

<?php include("header.php"); ?>

<?php
	class index3 {
		
		public $sex;
		public $sqlcount;
		public $pageCount;
		public $curPage;
		public $pageSize;
		public $startRow;
		public $pageNum;
		
		function queryPage(){
			
			include("app/config.php");
			$this->sex = @$_GET[sex];
			
			if($this->sex == ""){
				$sqls  = "SELECT COUNT(*) as total FROM gp_user"; 
			}else{
				$sqls  = "SELECT COUNT(*) as total FROM gp_user where sex='$this->sex'"; 
			} 

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
		
		function queryUserBySex(){

			include("app/config.php");
			
			if($this->sex == ""){
				$sql = "select * from gp_user ORDER BY id DESC LIMIT $this->startRow,$this->pageSize";
			}else{
				$sql = "select * from gp_user where sex='$this->sex' ORDER BY id DESC LIMIT $this->startRow,$this->pageSize";
			}
			$result = mysqli_query($link,$sql);
			while($rs = mysqli_fetch_array($result)){
				echo "<div class='detail-header'>
						<div class='header-title'>
							<div class='title-box'>
								<div class='title-user-message'>
									<div class='title-profile-picture'>
										<img src='".@$rs[prof_url]."' />
									</div>
									<div class='title-user-introduction'>
										<p>".@$rs[name]."</p>
										<p>".@$rs[sex]." / ".@$rs[stature]."<span> cm</span></p>
										<p>".@$rs[signature]."</p>
									</div>
								</div>
								<div class='title-button'>";
							if(@$_SESSION['currentUser']['id'] !== @$rs['id']||!isset($_SESSION['currentUser'])){
								echo "<ul class='user-button'><li><a>私信</a></li></ul>
									<ul class='user-button follow-button'><li><a>关注</a></li></ul>
									<ul class='user-button'><li><a href='space.php?id=$rs[id]'>个人空间</a></li></ul>";
							}else{
								echo "
									<ul class='user-button'><li><a>查看信息</a></li></ul>
									<ul class='user-button'><li><a href='space.php'>个人空间</a></li></ul>";
							}
							echo "</div>
							</div>
						</div>
					</div>";
			}
			mysqli_free_result($result);
			mysqli_close($link);
		}	
	}
?>

<main>

	<div class="nav-middle-box">
		<nav class="nav-middle">
			<ul>
 				<li><a href="index-3.php">不 限</a></li>
 				<li><a href="index-3.php?sex=男生">男 生<img class="img-boys" src="public/images/boy.png" /></a></li>
 				<li><a href="index-3.php?sex=女生">女 生<img class="img-girls" src="public/images/girl.png"/></a></li>
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
				$i1 = new index3();
				$i1->queryPage();
				$i1->queryUserBySex();
			?>
			<div class="clear"></div>
		</div>
		
		<div class="content-page">
			<?php
				$curPage = $i1->curPage;
				$pageNum = $i1->pageNum;
				$sex = $i1->sex;
				if($curPage<=0||$curPage==""){
					$curPage = 1;
				}else if($curPage > $pageNum){
					$curPage = $pageNum; 
				}
			
					if($curPage!=1){
						if($curPage<=3){
							for ($i=1; $i<$curPage; $i++){
								echo "<a href='index-3.php?sex=$sex&page=$i'>".$i."</a>";
							}
						}else{
							echo "<a href='index-3.php?page=".($curPage-1)."'>上一页&nbsp;&gt;</a>
							<a href='index-3.php?sex=$sex&page=1'>1</a>
								<a>...</a>";
							for ($i=($curPage-2); $i<$curPage; $i++){
								echo "<a href='index-3.php?sex=$sex&page=$i'>".$i."</a>";
							}
						}
					}
				?>
					<a class="current-page" href="javascript:viod(0);"><?php echo $curPage ?></a>
				<?php
					for ($i=($curPage+1); $i<=$pageNum; $i++){
						echo "<a href='index-3.php?sex=$sex&page=$i'>".$i."</a>";
					}
					if(($pageNum-$curPage)>=3){
						echo "<a>...</a>
						<a href='index-3.php?sex=$sex&page=".($curPage+1)."'>下一页&nbsp;&gt;</a>";
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
<script src="public/js/javascript.js"></script>
<script>
	$(document).ready(function(){
		
		var url = location.search; 
		var sex = decodeURI(url.substr(5));
		if(sex === "男生"){
			$(".nav-middle ul li:first-child").css({
				"background-color" : "#444447"
			});

			$(".nav-middle ul li:nth-child(2)").css({
				"background-color" : "#00c9d0"
			});

			$(".nav-middle-angle").css({
				"margin-left" : "170px"
			});
		}else if(sex === "女生"){
			$(".nav-middle ul li:first-child").css({
				"background-color" : "#444447"
			});

			$(".nav-middle ul li:nth-child(3)").css({
				"background-color" : "#00c9d0"
			});

			$(".nav-middle-angle").css({
				"margin-left" : "292px"
			});
		}else{
			$(".nav-middle ul li:first-child").css({
				"background-color": "#00c9d0"
			});
			$(".nav-middle-angle").css({
				"margin-left": "48px"
			});
		}
	});
</script>
</body>
</html>
