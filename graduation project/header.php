<header id="header">
	<div class="header-tool">
		<div class="header-tool-box">
			<div class="header-user-box">
					<dl>
					<?php 
						session_start();
						if(!isset($_SESSION['currentUser'])){
							echo '<dd><span></span><a href="login.php">登录</a></dd>
								<dd><span></span><a href="signup.php">注册</a></dd>';
						}else{
							echo '<a href="space.php" style="display:inline-block; float:left; margin-right:8px; width:30px; height:30px;"><img style=" width:30px; height:30px;" src="'.@$_SESSION['currentUser'][prof_url].'" /></a>
							<dd style="width:72px;"><span style="padding-right:5px;"></span><a href="space.php" style="padding-left:5px; color: darkcyan;">'.@$_SESSION['currentUser'][name].'</a></dd>
								<dd><span></span><a href="login.php">注销</a></dd>';
						}
					?>
						<dd><span></span><a href="signup.php">消息</a></dd>
						<dd><a href="publish.php">发布</a></dd>
					</dl>
			</div>
		</div>
	</div>
	<div id="header-1">
		<div id="header-box">
			<div class="header-logo"><a href="index.php">
				<img src="public/images/header_logo.png"/></a>
			</div>
		</div>
	</div>
		
	<nav class="nav">
		<ul>
 			<li><a href="index.php?page=1">首 页</a></li>
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