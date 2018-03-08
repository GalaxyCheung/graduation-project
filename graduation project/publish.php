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
	display: inline-block;
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
	
input[type="file"]{
	position: absolute;
	margin: 15px 10px;
	width: 110px;
	height: 35px;
	filter: alpha(opacity=0); 
	-moz-opacity: 0;
	opacity: 0;
	cursor: pointer;
}
	
input[type="submit"]{
	position: absolute; 
	margin: 15px 10px;
	width: 110px;
	height: 35px;
	filter: alpha(opacity=0);
	-moz-opacity: 0;
	opacity: 0;
	cursor: pointer;
}
</style>
</head>

<body>

<?php 
	include("header.php");
	if(!isset($_SESSION['currentUser'])){
		header("Location: ./login.php");
	}
?>	
	
<main>
	<div class="detail-content-box">
	<div class="publish-title">
		<h2>发布搭配</h2>
		<h2>标题</h2>
	</div>
		<form name="publish-form" id="publish-form" onsubmit="return check_pic_info()" method="post" action="app/publishAction.php" enctype="multipart/form-data">
			<div class="detail-content">
				<div class="detail-picture">
					<img alt="" src="" id="look"/>
					<div style="margin-left: 270px;">
						<input type="file" accept="image/*" value="" id="file" name="pic_url">
						<div class="bottom-button" id="upload_button"><a href="javascriot:void(0);"><span>∧</span>上传图片</a></div>
						<input type="submit" id="submit">
						<div class="bottom-button" id="publish_button"><a href="javascriot:void(0);"><span>√</span>发布</a></div>
					</div>
				</div>
			</div>

			<div class="detail-picture-introduction">
				<div class="introduction-title">
					<div class="h1_textarea"><textarea name="title" id="h1_textarea" maxlength="10"></textarea></div>
					<div class="h2_textarea"><textarea name="subtitle" id="h2_textarea" maxlength="22"></textarea></div>
				</div>
				<h2>简介</h2>
				<div class="introduction-content-1">
					<textarea name="intro" id="cont_textarea" maxlength="300"></textarea>
				</div>
			</div>
		</form>
		<div class="clear"></div>
	</div>
</main>
	
<footer>
<div class="bottom">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

<script>

function check_pic_info(){
	var confirm_1 = confirm("是否确认发布");
	if(confirm_1 === true){
		var p_h1 = replaceTextarea1($("#h1_textarea").val());
		var p_h2 = replaceTextarea1($("#h2_textarea").val());
		var p_cont = replaceTextarea1($("#cont_textarea").val());
		var p_img = $(".detail-picture").find("img").attr("src");
		
		if(p_h1 === "" || p_h1 === null){
			$("#h1_textarea").focus();
			alert("请输入标题");
			return false;
		}else if(p_h2 === "" || p_h2 === null){
			$("#h2_textarea").focus();
			alert("请输入副标题");
			return false;
		}else if(p_cont === "" || p_cont === null){
			$("#cont_textarea").focus();
			alert("请输入介绍内容");
			return false;
		}else if(p_img === "" || p_img === null){
			alert("请上传图片");
			return false;
		}else{
			return true;
		}
	}else{
		return false; 
	}	
}
		
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
	
$(function(){
	$("#file").change(function(){
		var docObj = document.getElementById("file");
		var imgObjPreview = document.getElementById("look");
		var file_name = docObj.files[0].name;
		
		var filepath = $(this).val();
		var extStart = filepath.lastIndexOf(".");
		var ext = filepath.substring(extStart,filepath.length).toUpperCase();
		
		var file_size = this.files[0].size;
		
		var size = file_size / 1024;
		
		if(ext!==".BMP"&&ext!==".PNG"&&ext!==".GIF"&&ext!==".JPG"&&ext!==".JPEG"){
			alert("请选择一个格式正确的图片");
			return false;
		}else if(size > 10240){
			alert("上传的图片大小不能超过10M");
			return false;
		}else{
			$.ajax({
				url:"app/checkPicUrl.php",
				type:"post",
				dataType:"json",
				data:{
					file_name:file_name
				},
				success: function(data){
					if(data[0]==1){
						$(".detail-picture").find("img").attr("src","");
						alert("您上传的图片已存在 ");
					}
				}
			});
		}
		
		if (docObj.files && docObj.files[0]) {
			imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
		}else{
			imgObjPreview.src = docObj.files[0].getAsDataURL();
		}
			return true;
		});
});
	
</script>

<script src="public/js/javascript.js"></script>
</body>
</html>