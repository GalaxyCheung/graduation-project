<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<link href="public/css/admin.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<title>管理员页面</title>
<style>
	
.side-bar ul li:nth-child(2) {
	background-color: #ddd;
}
	
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
	session_start();
	if(!isset($_SESSION['currentUser'])){
		echo "<script>window.location.href = 'login.php';</script>";
	}
	
	include("header-2.php");
	include("app/adminAction.php");
?>



<main>
	<div class="side-bar">
		<ul>
			<li class="user-bar">
				<a href="administrator.php">用户管理</a>
			</li>
			<li class="pic-bar">
				<a href="administrator-2.php">图片管理</a>
			</li>
			<li class="comm-bar">
				<a href="administrator-3.php">留言管理</a>
			</li>
			<div class="clear"></div>
		</ul>
	</div>
	
	<div class="admin-content" style="margin: 3% 0 2% 15%;">
		<div class="admin-header-tool">
			<div class="admin-search-box">
				<form class="admin-search" method="post" name="searchform" action="administator-4.php">
					<input name="search_name" placeholder="请输入用户名" class="admin-search-input" style="width: 100px;" type="text" maxlength="12" value=""/>
					<select name="search_sex" id="user-sex">
						<option>性别</option>
						<option>男生</option>
						<option>女生</option>
					</select>
					<input name="search_stat" placeholder="身高" class="admin-search-input" style="width: 36px;" type="number" oninput="if(value.length>3)value=value.slice(0,3);" value=""/>
					<input name="search_title" placeholder="请输入图片标题" id="pic_title" class="nav-search-input" style="width: 120px;" type="text" maxlength="9" value=""/>
					<input id="search-button" type="submit" value="搜索"/>
				</form>
			</div>
			<div class="clear"></div>
		</div>	
		
		<div class="admin-pic" style="margin-top: 30px;">
			<?php 
				$a1 = new Admin();
				$a1->sqls = "select COUNT(*) as total from gp_pic"; 
				$a1->queryPage();
				$a1->queryPic();
			?>
			
			<div class="content-page" style="float: none; width: 1000px;">
				<div style="float: right;">
					<?php 
						if($a1->curPage<=0||$a1->curPage==""){
							$a1->curPage = 1;
						}else if($a1->curPage > $a1->pageNum){
							$a1->curPage = $a1->pageNum; 
						}

						if($a1->curPage!=1){
							if($a1->curPage<=3){
								for ($i=1; $i<$a1->curPage; $i++){
									echo "<a href='administrator-2.php?page=$i'>".$i."</a>";
								}
							}else{
								echo "<a href='administrator-2.php?page=".($a1->curPage-1)."'>上一页&nbsp;&gt;</a>
										<a href='administrator-2.php'>1</a>
										<a>...</a>";
								for ($i=($a1->curPage-2); $i<$a1->curPage; $i++){
									echo "<a href='administrator-2.php?page=$i'>".$i."</a>";
								}
							}
						}

						echo '<a class="current-page" href="javascript:void(0);">'.$a1->curPage.'</a>';

						for ($i=($a1->curPage+1); $i<=$a1->pageNum; $i++){
							echo "<a href='administrator-2.php?page=$i'>".$i."</a>";
						}
						if(($a1->pageNum-$a1->curPage)>=3){
							echo "<a>...</a>
							<a href='administrator-2.php?page=".($a1->curPage+1)."'>下一页&nbsp;&gt;</a>";
						}
					?>
				</div>
			</div>
		</div>
		
		<div class="admin-comm display-none">
			
		</div>
		
		<div class="clear"></div>
	</div>
</main>


<footer>
<div class="bottom" style="width: 65%; margin: 0 0 0 25%;">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

</body>

<script src="public/js/scroll.js"></script>
<script>  
	$(document).ready(function(){
		var h = 149-$(window).scrollTop();
		if ($(window).scrollTop() > 71){
			$(".side-bar").css({
				"top" : "71px"
			});
		}else if($(window).scrollTop()<71&&$(window).scrollTop()>0){ 
			$(".side-bar").css({
				"top" : h
			});
		}
	});
	
	$(window).on("scroll", function () {
		var h = 149-$(window).scrollTop();
		if ($(window).scrollTop() > 71){
			$(".side-bar").css({
				"top" : "71px"
			});
		}else if($(window).scrollTop()<71&&$(window).scrollTop()>0){ 
			$(".side-bar").css({
				"top" : h
			});
		}else{
			$(".side-bar").css({
				"top" : "181px"
			});
		}
	});   
		$(".space-picture-introduction").each(function(){
		var editButton = $(this).find(".edit-button");
		var closeButton = $(this).find(".close-button");
		var deleteButton = $(this).find(".delete-button");
		var space_h1 = $(this).find(".space-h1");
		var space_h2 = $(this).find(".space-h2");
		var space_cont = $(this).find(".space-cont");
		var h1_a = $(this).find(".h1-a");
		var h2_a = $(this).find(".h2-a");
		var cont_a = $(this).find(".cont-a");
		var pic_id = $(this).find(".pic-id");
		var pic_url = $(this).parents().find(".space-picture");
		
	  	editButton.find(".edit").first().mousedown(function(){
			
			if($(".edit-button").hasClass("display-none")){
				alert("请先完成其他编辑操作");
				return;
			}else{
				space_h1.val(h1_a.find("a").text());
				space_h2.val(h2_a.find("a").text());
				space_cont.val(cont_a.find("a").text());

				editButton.addClass("display-none");
				closeButton.removeClass("display-none");
				deleteButton.removeClass("display-none");

				space_h1.removeClass("display-none");
				space_h2.removeClass("display-none");
				space_cont.removeClass("display-none");

				h1_a.addClass("display-none");
				h2_a.addClass("display-none");
				cont_a.addClass("display-none");
			}
		});
		
		closeButton.find("a").first().mousedown(function(){
				
			var confirm_1 = confirm("是否确认编辑");
			if(confirm_1 === true){
				var p_id = pic_id.html();
				var s_h1 = replaceTextarea1(space_h1.val());
				var s_h2 = replaceTextarea1(space_h2.val());
				var s_cont = replaceTextarea1(space_cont.val());
				
				if(s_h1 === "" || s_h1 === null){
					alert("请输入标题");
					return;
				}else if(s_h2 === "" || s_h2 === null){
					alert("请输入副标题");
					return;
				}else if(s_cont === "" || s_cont === null){
					alert("请输入介绍内容");
					return;
				}else{
					$.ajax({
						url:"app/editPicInfo.php",
						type:"post",
						dataType:"json",
						data:{
							pic_id:p_id,
							title:s_h1,
							subtitle:s_h2,
							intro:s_cont
						},
						success:function(){
							alert("编辑成功");
							window.location.reload();
						}
					});
				}
			}else{
				return false; 
			}
		});	
		
		closeButton.find("a").eq(1).mousedown(function(){
			
			editButton.removeClass("display-none");
			closeButton.addClass("display-none");
			deleteButton.addClass("display-none");

			space_h1.addClass("display-none");
			space_h2.addClass("display-none");
			space_cont.addClass("display-none");

			h1_a.removeClass("display-none");
			h2_a.removeClass("display-none");
			cont_a.removeClass("display-none");
		});
		
		deleteButton.find("a").mousedown(function(){
			var p_id = pic_id.html();
			var p_url = pic_url.find("img").attr("src");
			
			var confirm_3 = confirm("是否删除搭配");
			if(confirm_3 === true){
				$.ajax({
					url:"app/deletePic.php",
					type:"post",
					dataType:"json",
					data:{
						pic_id:p_id,
						pic_url:p_url
					},
					success:function(){
						alert("删除成功");
						window.location.reload();
					},
					error:function(){
						alert("删除失败");
					}
				}); 
			}else{
				return false;
			}
		});
	});
	
//文本域换行符替换

	function replaceTextarea1(str){
		var reg = new RegExp("\r\n","g");
		var reg1 = new RegExp(" ","g");

		str = str.replace(reg,"＜br＞");
		str = str.replace(reg1,"＜p＞");

		return str;
	}

	function replaceTextarea2(str){
		var reg = new RegExp("＜br＞","g");
		var reg1 = new RegExp("＜p＞","g");

		str = str.replace(reg,"\r\n");
		str = str.replace(reg1," ");

		return str;
	}
	
</script>
</html>
