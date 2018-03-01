<!doctype html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <title>注册页面</title>
<link href="public/css/signup-login.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="public/js/jquery-1.6.1.min.js"></script>
<style>
input[type="file"]{
	position: absolute;
	width: 80px; 
	height: 80px;
	filter: alpha(opacity=0);
	-moz-opacity: 0; 
	opacity: 0; 
	cursor: pointer;
}	
</style>
</head>
  
<body onload="createCode(4)"> 
  
  
<div class="checkout-header">
	<div class="checkout-header-box">
		<div class="checkout-header-logo">
			<a href="index.php"><img src="public/images/logo-1.png" /></a>
		</div>
	</div>
</div>

		<div class="sign-box">
			<div class="signup-inner">
				<form name="loginform" id="loginform" onsubmit="return checkinfo_2()" method="post" action="app/signupAction.php" enctype="multipart/form-data">
					<div class="signup-user-info">
						<font class="checkout-title-font"><strong>注册成为用户</strong></font>
						
						<p style="margin-top: 15px;">	
							<label for="user-login"><font class="checkout-font"><strong>用户名</strong></font>
							</label>
						</p>
						<div class="check-name">
								<input placeholder="用户名为4~12个字符" type="text" name="log" id="user-login" class="input-box" value="" maxlength="12">
								<span class="error-star">*</span>
							<div class="error-message-box">
								<a class="error-message"></a>
							</div>
						</div>
						
						<p>
							<label for="user-pass"><font class="checkout-font"><strong>登录密码</strong></font>
							</label>
						</p>
						<div class="check-pass">
							<input placeholder="密码为6~16个字符" type="password" name="pwd" id="user-pass" class="input-box" value="" maxlength="16">
							<span class="error-star">*</span>
							<div class="error-message-box">
								<a class="error-message"></a>
							</div>
						</div>
						
						<p>
							<label for="user-pass"><font class="checkout-font"><strong>确认密码</strong></font>
							</label>
						</p>
						<div class="check-cfmpass">
							<input placeholder="确认密码应与密码一致" type="password" name="pwd" id="password" class="input-box" value="" maxlength="16">
							<span class="error-star">*</span>
							<div class="error-message-box">
								<a class="error-message"></a>
							</div>
						</div>
						
						<p>
							<label for="user-pass"><font class="checkout-font"><strong>验证码</strong></font>
							</label>
						</p>
						<div class="check-code">
							<input placeholder="区分大小写" name="checkCode" type="text" id="check-code" maxlength="4" /> 
							 <div onclick="createCode(4)" readonly id="checkCode"></div>
							<span class="error-star">*</span>
							<div class="error-message-box">
								<a class="error-message"></a>
							</div>
						 </div>
						
						<div class="checkout-button">
							<input type="button" onClick="checkinfo_1()" name="submit" value="下一步">
						</div>
				 	</div>
				 	
					<div class="signup-user-data display-none">
						<font class="checkout-title-font"><strong>完善您的用户信息</strong></font>
						
						<p style="margin-top: 15px;">	
							<label for="user-picture"><font class="checkout-font"><strong>头像</strong></font><br>
							
							<label for="upload-file">
								<div class="preview_pic">
				   					<input type="file" accept="image/*" value="" id="file" name="pro_url">
									<img src="" alt="" id="look" />
								</div>
							</label>
								
							</label>
						</p>
						
						<p>		
							<label for="user-sex"><font class="checkout-font"><strong>性别</strong></font>
							</label>
						</p>
						<select name="sex" id="user-sex" class="data-sex" value="">
							<option>男生</option>
							<option>女生</option>
						</select>
						<span class="error-star">*</span>
						
						<p>	
							<label for="user-stature"><font class="checkout-font"><strong>身高</strong></font>
							</label>
						</p>
						<input type="number" name="stat" id="user-stature" class="data-stature" value="" oninput="if(value.length>3)value=value.slice(0,3)" />
						<a class="data-stature-a">cm</a>
						<span class="error-star" style="margin-left: 10px;">*</span>
						<div class="error-message-box check-stat">
							<a class="error-message"></a>
						</div>
						
						<p>	
							<label for="user-stature"><font class="checkout-font"><strong>个性签名</strong></font>
							</label>
						</p>
						<textarea name="signa" id="user-signature" class="data-signature" value="" maxlength="40"></textarea>
						
						<div class="checkout-button">
							<input type="submit" name="submit" id="submit" value="注册">
						</div>
					</div>
					<div class="clear"></div>
					  
				</form>
			</div>
		</div>
	  

<footer>
<div class="bottom">Copyright&copy;2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>

<script src="javascript.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#file").change(function(){
					var docObj = document.getElementById("file");
					var imgObjPreview = document.getElementById("look");
					if (docObj.files && docObj.files[0]) {
			            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要已下方式
			            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
			        } else {
			            //IE下，使用滤镜
			            docObj.select();
			            var imgSrc = document.selection.createRange().text;
			            var localImagId = document.getElementById("localImag");
			            //图片异常的捕捉，防止用户修改后缀来伪造图片
			            try {
			            	localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
			            	localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
			            } catch(e) {
			            	alert("您上传的图片格式不正确，请重新选择!");
			            	return false;
			            }
			            document.selection.empty();
			        }
			        return true;
			    })
			})
	</script>
</body>
</html>
