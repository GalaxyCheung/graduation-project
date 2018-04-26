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
						<dd><a href="publish.php">发布</a></dd>
					</dl>
			</div>
			<?php
				if(@$_SESSION['currentUser']['rule_id']==1){
					echo '<div style="float:left;"><a href="administrator.php">&lt;-管理员页面-&gt</a></div>'; 
				}
			?>
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
 			<li><a href="index.php">首 页</a></li>
  			<li><a href="index-2.php">搭配频道</a></li>
  			<li><a href="index-3.php">搭配达人</a></li>
			<div class="nav-search-box">
				<form class="nav-search" method="post" name="searchform" action="search.php">
				 	<select name="search_type" class="nav-search-type">
						<option>搭配</option>
						<option>用户</option>
					</select>
					<input name="search_name" placeholder="请输入用户名" class="nav-search-input" style="width: 100px;" type="text" maxlength="12" value=""/>
					<select name="search_sex" id="user-sex">
						<option>性别</option>
						<option>男生</option>
						<option>女生</option>
					</select>
					<input name="search_stat" placeholder="身高" class="nav-search-input" style="width: 36px;" type="number" oninput="if(value.length>3)value=value.slice(0,3);" value=""/>
					<input name="search_title" placeholder="请输入图片标题" id="pic_title" class="nav-search-input" style="width: 120px;" type="text" maxlength="9" value=""/>
					<a class="search-img"><input type="submit" style="width: 45px; height: 27px; filter: alpha(opacity=0); -moz-opacity: 0; opacity: 0; cursor: pointer;"/></a> 
				</form>
			</div>
		</ul>
	</nav>
</header>