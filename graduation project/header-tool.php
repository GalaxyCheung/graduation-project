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
							echo '<dd><span></span><a href="space.php" style="color: darkcyan;">'.@$_SESSION['currentUser'][name].'</a></dd>
								<dd><span></span><a href="login.php">注销</a></dd>';
						}
					?>
						<dd><span></span><a href="signup.php">消息</a></dd>
						<dd><a href="publish.php">发布</a></dd>
					</dl>
			</div>
		</div>
</div>