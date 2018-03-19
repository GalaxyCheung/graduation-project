<header id="header">
	<div class="header-tool">
		<div class="header-tool-box" style="max-width: none;">
			<div class="header-user-box">
					<dl>
					<?php 
						echo '<a href="space.php" style="display:inline-block; float:left; margin-right:8px; width:30px; height:30px;"><img style=" width:30px; height:30px;" src="'.@$_SESSION['currentUser'][prof_url].'" /></a>
						<dd style="width:72px;"><span style="padding-right:5px;"></span><a href="space.php" style="padding-left:5px; color: darkcyan;">'.@$_SESSION['currentUser'][name].'</a></dd>
						<dd><span></span><a href="login.php">注销</a></dd>';
					?>
						<dd><a href="publish.php">发布</a></dd>
					</dl>
			</div>
			<?php
				if($_SESSION['currentUser']['rule_id']==1){
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
		<ul style="width: 65%;">
 			<li><a href="index.php">首 页</a></li>
  			<li><a href="index-2.php">搭配频道</a></li>
  			<li><a href="index-3.php">搭配达人</a></li>
		</ul>
	</nav>
</header>