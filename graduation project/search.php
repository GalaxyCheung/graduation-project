<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>检索结果</title>
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
</head>

<body>

<?php include("header.php"); ?>

<?php
	class search {
		
		public $sqlcount;
		public $pageCount;
		public $curPage;
		public $pageSize;
		public $startRow;
		public $pageNum;
		public $name;
		public $sex;
		public $stature;
		public $title;
		
		function queryPage(){

			include("app/config.php");
			
			$this->name = @$_POST['search_name'];
			$this->stature = @$_POST['search_stat'];
			$this->title = @$_POST['search_title'];
			$sex = @$_POST['search_sex'];
			
			if($sex == "性别"){
				$this->sex = "";
			}else{
				$this->sex = $sex;
			}
			
			$sqls = "SELECT COUNT(gp_user.id) as total FROM gp_user inner join gp_pic on gp_user.id=gp_pic.u_id where 1=1"; 
			if($this->name != ""||$this->name != null)
				$sqls = $sqls." and name like '%".$this->name."%'";
			if($this->sex != ""||$this->sex != null)
				$sqls = $sqls." and sex='".$this->sex."'";
			if($this->stature != ""||$this->stature != null)
				$sqls = $sqls." and stature='".$this->stature."'";
			if($this->title != ""||$this->title != null)
				$sqls = $sqls." and gp_pic.title like '%".$this->title."%'";
			
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
		
			$sql = "select * from gp_user inner join gp_pic on gp_user.id=gp_pic.u_id where 1=1";
			if($this->name != ""||$this->name != null)
				$sql = $sql." and name like '%".$this->name."%'";
			if($this->sex != ""||$this->sex != null)
				$sql = $sql." and sex='".$this->sex."'";
			if($this->stature != ""||$this->stature != null)
				$sql = $sql." and stature='".$this->stature."'";
			if($this->title != ""||$this->title != null)
				$sql = $sql." and gp_pic.title like '%".$this->title."%'";
			$sql = $sql." ORDER BY gp_pic.id DESC LIMIT $this->startRow,$this->pageSize";
		
			$result = mysqli_query($link, $sql);
			while($rs = mysqli_fetch_array($result)){
				echo "<div class='content-picture-box'>
						<div class='content-picture'>
							<a href='detail.php?pic_id=".@$rs[0]."'><img src='".@$rs[pic_url]."' /></a>
						</div>
						<div class='picture-info'>
							<div class='profile-picture'>
								<a href='space.php'><img src='".@$rs[prof_url]."' /></a>
							</div>
							<div class='intro-info'><p>".@$rs[name]." / ".@$rs[sex]." / ".@$rs[stature]."<span> cm</span></p>
							</div>
							<div class='intro-info'><p>".@$rs[title]."</p></div>
							<div style='float:left; width:240px; height:20px;'><a style='float:right; display:block; font-size:10px; line-height:20px;'>".@$rs[time]."</a></div>	
						</div>
					</div>";
			}
			mysqli_free_result($result);
			mysqli_close($link);
		}
	}
?>

<?php 
	$s = new search();
	$s->queryPage(); 
?>

	<div class="search-header">
		<div class="search-header-title">
			<h1> <?php
					$str = "";
					if($s->name!="")$str = "「 ".$s->name." 」";
					if($s->sex!="")$str = $str."「 ".$s->sex." 」";
					if($s->stature!="")$str = $str."「 ".$s->stature." cm 」";
					if($s->title!="")$str = $str."「 ".$s->title." 」";
					if($str == "")$str = "「所有搭配」";
					echo $str;
				?> 的检索结果</h1>
			<h2>共找到 <?php echo $s->pageCount; ?> 条信息</h2>
		</div>
	</div>



<main>

	<div class="backToTop-button">
		<img src="public/images/回到顶部.png" />
	</div>

	<div class="content-box">
		<div class="content">
			<?php
				$s->querySearch();
			?>
			<div class="clear"></div>
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
					if($curPage<=4){
						for ($i=1; $i<$curPage; $i++){
							echo "<a class='page-num' href='javascript:void(0);'>".$i."</a>";
						}
					}else{
						echo "<a class='prev-page' href='javascript:void(0);'>上一页&nbsp;&gt;</a>
						<a href='javascript:void(0);'>1</a>
							<a>...</a>";
						for ($i=($curPage-2); $i<$curPage; $i++){
							echo "<a class='page-num' href='javascript:void(0);'>".$i."</a>";
						}
					}
				}
			?>
				<a class="current-page" href="javascript:void(0);"><?php echo $curPage ?></a>
			<?php
				for ($i=($curPage+1); $i<=$pageNum; $i++){
					echo "<a class='page-num' href='javascript:void(0);'>".$i."</a>";
				}
				if(($pageNum-$curPage)>3){
					echo "<a>...</a>
					<a class='next-page' href='javascript:void(0);'>下一页&nbsp;&gt;</a>";
				}
			?>
			<form style="display: none;" method="post" action="search.php" id="changePage">
				<input name="search_name" value="<?php echo $s->name ?>"/>
				<input name="search_sex" value="<?php echo $s->sex ?>"/>
				<input name="search_stat" value="<?php echo $s->stature ?>"/>
				<input name="search_title" value="<?php echo $s->title ?>"/>
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
