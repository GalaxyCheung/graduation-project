<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>发布搭配</title>
<link href="public/css/detail.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script src="public/js/jquery-2.1.4.min.js"></script>
<style>
.publish-title{
	margin-bottom: 5px; 
	width: 100%;
}
	
.publish-title h2{
	display: inline-block;
}
	
.publish-title h2:first-child{
	margin-left: 5px;
	width:570px;
}
	
.h1_textarea{
	height: 55px;
	margin: 10px 15px 5px 15px;
	border-bottom: 1px solid #ddd;
}
	
.h1_textarea textarea{
	display: block;
	padding-top: 8px;
	margin: 0 auto;
	width: 310px;
	height: 32px;
	font-size: 24px;
	line-height: 26px;
	font-weight: bolder;
	text-align: center;
}	
	
.h2_textarea{
	margin: 8px 15px 0 15px;
}
	
.h2_textarea textarea{
	display: block;
	padding: 3px 0 0 10px;
	margin: 0 auto;
	width: 310px;
	height: 100%;
	font-size: 20px;
	line-height: 26px;
	font-weight: bold;
	}
	
.introduction-content-1{
	width: 350px;
	height: 640px;
	margin: 0px auto 30px auto;
	background-color: #fff;
	border: 1px solid #ddd;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}
	
.detail-picture-introduction h2{
	padding-left: 10px;
	margin-top: 15px;
}
	
.introduction-content-1 textarea{
	display: block;
	padding: 0 5px;
	margin: 15px auto;
	width: 310px;
	height: 600px;
	font-size: 16px;
	line-height: 26px;
}
	
.bottom-button{
	float: right;
	width: 110px;
	height: 35px;
	margin: 15px 10px;
	text-align: center;
	background-color: #B10A0D;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius: 6px;
}

.bottom-button a{
	display: block;
	width: 110px;
	height: 35px;
	font-size: 15px;
	line-height: 30px; 
	letter-spacing: 3px;
	color: #fff; 
}

.bottom-button a span{
	font-size: 18px;
}
	
</style>
</head>

<body>

<header id="header" >
	<div class="header-tool">
		<div class="header-tool-box">
			<div class="header-user-box">
					<dl>
						<dd><span></span><a href="login.php">登录</a></dd>
						<dd><span></span><a href="signup.php">注册</a></dd>
						<dd><span></span><a href="signup.php">消息</a></dd>
						<dd><a href="publish.php">发布</a></dd>
					</dl>
			</div>
		</div>
	</div>
	<div id="header-1">
		<div id="header-box">
			<div class="header-logo"><a href="index.php">
				<img src="public/public/images/header_logo.png"/></a>
			</div>
		</div>
	</div>
		
	<nav class="nav">
		<ul>
 			<li><a href="index.php">首 页</a></li>
  			<li><a href="index-2.php">搭配频道</a></li>
  			<li><a href="index-3.php">搭配达人</a></li>
			<div class="nav-search-box">
					<form class="nav-search">
				 		<select>
							<option>搭配</option>
							<option>用户</option>
						</select>
					 	<input placeholder="请输入搜索内容" class="nav-search-input" type="text" />
					 	<a class="search-img"></a>
					</form>
			</div>
		</ul>
	</nav>
</header>
	
	
<main>
	<div class="detail-content-box">
	<div class="publish-title">
		<h2>发布搭配</h2>
		<h2>标题</h2>
	</div>
		<div class="detail-content">
			<div class="detail-picture">
				<img src="" />
					<div class="bottom-button" id="publish_button"><a href="javascriot:void(0);"><span>√</span>发布</a></div>
					<div class="bottom-button" id="upload_button"><a href="javascriot:void(0);"><span>∧</span>上传图片</a></div>
					
			</div>
		</div>
		
		<div class="detail-picture-introduction">
			<div class="introduction-title">
				<div class="h1_textarea"><textarea id="h1_textarea" maxlength="10"></textarea></div>
				<div class="h2_textarea"><textarea id="h2_textarea" maxlength="22"></textarea></div>
			</div>
			<h2>简介</h2>
			<div class="introduction-content-1">
				<textarea id="cont_textarea" maxlength="300"></textarea>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</main>
	
<footer>
<div class="bottom">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

<script>

$("#publish_button").mousedown(function(){
	var confirm_1 = confirm("是否确认发布");
	if(confirm_1 === true){
		var p_h1 = replaceTextarea1($("#h1_textarea").val());
		var p_h2 = replaceTextarea1($("#h2_textarea").val());
		var p_cont = replaceTextarea1($("#cont_textarea").val());
		var p_img = $(".detail-picture").find("img").attr("src");
		
		if(p_h1 === "" || p_h1 === null){
			alert("请输入标题");
			return;
		}else if(p_h2 === "" || p_h2 === null){
			alert("请输入副标题");
			return;
		}else if(p_cont === "" || p_cont === null){
			alert("请输入介绍内容");
			return;
		}else if(p_img === "" || p_img === null){
			alert("请上传图片");
			return;
		}else{
			return false;
		}
	}else{
		return false; 
	}	
});	
		
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

</body>
</html>