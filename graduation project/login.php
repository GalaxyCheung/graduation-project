<!doctype html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <title>登录页面</title>
<link href="public/css/signup-login.css" rel="stylesheet" type="text/css">
<link href="public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="public/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="public/js/jquery.cookie.js"></script> 
<script src="public/js/javascript.js"></script>
</head>
  
<body>
    
<?php
	session_start();
	unset($_SESSION['currentUser']);
	@$user = $_GET['user'];
?>
<div class="checkout-header">
	<div class="checkout-header-box">
		<div class="checkout-header-logo">
			<a href="index.php"><img src="public/images/logo-1.png" /></a>
		</div>
	</div>
</div>
     
<div class="checkout-box">
	<div class="checkout-left">
		<div class="checkout-box-left">
			<div class="checkout-inner">
				<form name="login-form" id="login-form" onsubmit="return checkinfo()" method="post"  action="index.php">
					<font class="checkout-title-font"><strong>用户登录</strong></font>
					<p style="margin-top: 50px;">	
						<label for="user-login"><font class="checkout-font"><strong>用户名</strong></font></label>
					</p>
						<input placeholder="用户名为4~12个字符" type="text" name="log" id="user-login" class="input-box" value="<?php echo $user ?>" maxlength="12">
						<span class="error-star">*</span>
						<div class="error-message-box check-name">
							<a class="error-message"></a>
						</div>
					<p>
						<label for="user-pass"><font class="checkout-font"><strong>登录密码</strong></font></label>
					</p>
						<input placeholder="密码为4~16个字符" type="password" name="pwd" id="user-pass" class="input-box" value="" maxlength="16">
						<span class="error-star">*</span>
						<div class="error-message-box check-pass">
							<a class="error-message"></a>
						</div>
					<p>
						<input type="checkbox" id="remember-me" checked="false"><a class="remember-me-a"><strong>记住我</strong></a>
					</p>
					<div class="checkout-button">
						<input type="submit" name="submit" id="submit" value="登录">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="checkout-right">
		<div class="checkout-box-right">
			<div class="checkout-inner-1">
				<font><strong>还没有账号？</strong></font>
					<div class="checkout-button" style="margin-top: 110px;">
						<a href="signup.php"><input type="button" value="注册"></a>
					</div>
			</div>
		</div>
	</div>
</div>

<div style="padding: 8px 0 0; margin: 0 auto;">
<footer>
<div class="bottom">Copyright©2017<a href="index.php">基于PHP的传媒公司网站</a>All rights reserved. By:1440706131 计算机系 张跃聪</div>
</footer>
<br />
</div>
 
<script>
	$(function() {
		if ($.cookie("remember-me")) {
			$("#rememberUser").attr("checked", true);
			$("#user-login").val($.cookie("username"));
			$("#user-pass").val($.cookie("password"));
		}
	});
</script>
 
  </body>
</html>
