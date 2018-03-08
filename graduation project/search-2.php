<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>检索结果</title>
<link href="public/css/detail.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
</head>

<body>


<?php include("header.php"); ?>
<?php
	class search2 {
		
		public $sqlcount;
		public $pageCount;
		public $curPage;
		public $pageSize;
		public $startRow;
		public $pageNum;
		public $name;
		public $sex;
		public $stature;
		
		function queryPage(){

			include("app/config.php");
			
			$this->name = $_POST['search_name'];
			$this->stature = $_POST['search_stat'];
			$sex = $_POST['search_sex'];
			if($sex == "性别"){
				$this->sex = "";
			}else{
				$this->sex = $sex;
			}
			
			$sqls = "SELECT COUNT(gp_user.id) as total FROM gp_user where 1=1"; 
			if($this->name != ""||$this->name != null)
				$sqls = $sqls." and name like '%".$this->name."%'";
			if($this->sex != ""||$this->sex != null)
				$sqls = $sqls." and sex='".$this->sex."'";
			if($this->stature != ""||$this->stature != null)
				$sqls = $sqls." and stature='".$this->stature."'";
			
			$sqlcount = mysqli_query($link,$sqls);
			$pageCount  = mysqli_fetch_array($sqlcount);
			$this->pageCount = $pageCount['total'];

			$this->curPage = @$_POST[page]?:'1';  

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
		
		
	function querySearch(){
		
			include("app/config.php");
		
			$this->queryPage();
		
			$sql = "select * from gp_user where 1=1";
			if($this->name != ""||$this->name != null)
				$sql = $sql." and name like '%".$this->name."%'";
			if($this->sex != ""||$this->sex != null)
				$sql = $sql." and sex='".$this->sex."'";
			if($this->stature != ""||$this->stature != null)
				$sql = $sql." and stature='".$this->stature."'";
			$sql = $sql." ORDER BY id DESC LIMIT $this->startRow,$this->pageSize";
		
			$result = mysqli_query($link, $sql);
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
								echo "<ul class='user-button'><li><a>关注</a></li></ul>
									<ul class='user-button follow-button'><li><a>私信</a></li></ul>";
							}else{
								echo "<ul class='user-button'><li><a href='space.php'>个人空间</a></li></ul>
									<ul class='user-button'><li><a>查看信息</a></li></ul>";
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

<?php 
	$s2 = new search2();
	$s2->queryPage(); 
?>



	<div class="search-header">
		<div class="search-header-title">
			<h1> <?php
					$str = "";
					if($s2->name!="")$str = "「 ".$s2->name." 」";
					if($s2->sex!="")$str = $str."「 ".$s2->sex." 」";
					if($s2->stature!="")$str = $str."「 ".$s2->stature." cm 」";
					if($str == "")$str = "「所有用户」";
					echo $str;
				?> 的检索结果</h1>
			<h2>共找到 <?php echo $s2->pageCount; ?> 条信息</h2>
		</div>
	</div>



<main>

	<div class="backToTop-button">
		<img src="public/images/回到顶部.png" />
	</div>

	<div class="content-box">
		<div class="content">
			<?php $s2->querySearch(); ?>
			<div class="clear"></div>
		</div>
		
		<div class="content-page">
			<?php
				$curPage = $s2->curPage;
				$pageNum = $s2->pageNum;
				if($curPage<=0||$curPage==""){
					$curPage = 1;
				}else if($curPage > $pageNum){
					$curPage = $pageNum; 
				}
			
				if($curPage!=1){
					if($curPage<=3){
						for ($i=1; $i<$curPage; $i++){
							echo "<a class='page-num' href='javascript:viod(0);'>".$i."</a>";
						}
					}else{
						echo "<a class='prev-page' href='javascript:viod(0);'>上一页&nbsp;&gt;</a>
						<a href='index-2.php?&page=1'>1</a>
							<a>...</a>";
						for ($i=($curPage-2); $i<$curPage; $i++){
							echo "<a class='page-num' href='javascript:viod(0);'>".$i."</a>";
						}
					}
				}
			?>
				<a class="current-page" href="javascript:viod(0);"><?php echo $curPage ?></a>
			<?php
				for ($i=($curPage+1); $i<=$pageNum; $i++){
					echo "<a class='page-num' href='javascript:viod(0);'>".$i."</a>";
				}
				if(($pageNum-$curPage)>=3){
					echo "<a>...</a>
					<a class='next-page' href='javascript:viod(0);'>下一页&nbsp;&gt;</a>";
				}
			?>
			<form style="display: none;" method="post" action="search-2.php" id="changePage">
				<input name="search_name" value="<?php echo $s2->name ?>"/>
				<input name="search_sex" value="<?php echo $s2->sex ?>"/>
				<input name="search_stat" value="<?php echo $s2->stature ?>"/>
				<input name="page" id="page" value=""/>
			</form>
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
	$(".page-num").mousedown(function(){
		var pageNum = $(this).text();
		$("#page").val(pageNum);
		$("#changePage").submit();
	});
	$(".prev-page").mousedown(function(){
		var pageNum = $(".current-page").text();
		$("#page").val(pageNum-1);
		$("#changePage").submit();
	});
	$(".next-page").mousedown(function(){
		var pageNum = $(".current-page").text();
		$("#page").val(pageNum+1);
		$("#changePage").submit();
	});
</script>
</body>
</html>
