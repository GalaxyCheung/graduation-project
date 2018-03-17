<?php
class Admin {
	
	public $i;
	
	public $sqlcount;
	public $pageCount;
	public $curPage;
	public $pageSize;
	public $startRow;
	public $pageNum;
	public $sqls;
	
	function queryPage(){
			
	include("app/config.php");

	$sqlcount = mysqli_query($link,$this->sqls);
	$pageCount  = mysqli_fetch_array($sqlcount);
	$this->pageCount = $pageCount['total'];
		
	$this->curPage = @$_GET['page']?:'1'; 

	$this->pageSize = 8;  

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
	
	function queryUser(){
		$i = 0;
		include("app/config.php");
		$sql = "select * from gp_user where rule_id=2 ORDER BY id DESC LIMIT $this->startRow,$this->pageSize";
		$result = mysqli_query($link,$sql);
		while($rs = mysqli_fetch_array($result)){
			echo "<div class='title-box'>
					<div class='edit-button edit-pic-button'>
						<a class='edit' href='javascript:void(0);'><span>∨</span> 编辑用户</a>
					</div>

					<div class='close-button edit-pic-button display-none'>
						<a href='javascript:void(0);'><span>∧</span> 完成编辑</a>
						<a href='javascript:void(0);'><span>∧</span> 取消编辑</a>
						<a href='javascript:void(0);'><span>×</span> 删除用户</a>
					</div>
					
					<div class='title-user-message'>
						<div class='admin-user-box'>
							<div class='display-none user-id'>".@$rs[id]."</div>
							<div class='title-profile-picture'>
								<a href='space.php?id=".@$rs[id]."'><img src='".@$rs[prof_url]."' /></a>
							</div>
							<div class='title-user-introduction'>
								<p>".@$rs[name]."</p>
								<p>".@$rs[sex]." / ".@$rs[stature]."<span> cm</span></p>
								<p>".@$rs[signature]."</p>
							</div>
						</div>
						<div class='edit-user-box display-none'>
							<div class='preview_pic'>
							<input type='file' accept='image/*' value='' id='file' name='pro_url'>
								<img src='".@$rs[prof_url]."' alt='' id='look' />
							</div>
							<input type='text' name='log' id='user-login' class='data-name' value='".@$rs[name]."' maxlength='12' autofocus='autofocus'>
							<select name='sex' id='user-sex' class='data-sex' value='".@$rs[sex]."'>
								<option>男生</option>
								<option>女生</option>
							</select>
							<input type='number' name='stat' id='user-stature' class='data-stature' value='".@$rs[stature]."' oninput='if(value.length>3)value=value.slice(0,3)' />
							<a class='data-stature-a'>cm</a>
							<textarea name='signa' id='user-signature' class='data-signature' maxlength='40'>".@$rs[signature]."</textarea>
							<div class='add-rule'><input id='admin' type='checkbox' /><span>设为管理员</span></div>
						</div>
					</div>
				</div>";
		}
		mysqli_free_result($result);
		mysqli_close($link);
	}
	
	function queryPic(){
		$i = 0;
		include("app/config.php");
		$sql = "select * from gp_pic inner join gp_user on gp_pic.u_id=gp_user.id ORDER BY gp_pic.id DESC LIMIT $this->startRow,$this->pageSize";
		$result = mysqli_query($link,$sql);
		while($rs = mysqli_fetch_array($result)){
			echo "<div class='space-picture-box'>
				<div class='space-picture'>
					<img src='".@$rs[pic_url]."' />
				</div>
				<div class='space-picture-introduction'>
					<div class='edit-button edit-pic-button'>
						<a class='edit' href='javascript:void(0);'><span>∨</span> 编辑搭配</a>
						<a href='detail.php?pic_id=$rs[0]'><span>&lt;</span> 查看搭配</a>
					</div>

					<div class='close-button edit-pic-button display-none'>
						<a href='javascript:void(0);'><span>∧</span> 完成编辑</a>
						<a href='javascript:void(0);'><span>∧</span> 取消编辑</a>
					</div>

					<div class='space-introduction-content'>
						<div class='pic-id display-none'>".@$rs[0]."</div>
						<div class='introduction-title'>
							<textarea class='space-h1 display-none' type='text' placeholder='编辑标题' maxlength='17' value='".@$rs[title]."'></textarea>
							<h1 class='h1-a'><a>".@$rs[title]."</a></h1>
							<textarea class='space-h2 display-none' type='text' placeholder='编辑副标题' maxlength='40' value='".@$rs[subtitle]."'></textarea>
							<h2 class='h2-a'><a>".@$rs[subtitle]."</a></h2>
						</div>
						<div class='introduction-content'>
							<textarea class='space-cont display-none' type='text' placeholder='编辑介绍内容' maxlength='300' value='".@$rs[intro]."'></textarea>	
							<div class='cont-a'><a>".@$rs[intro]."</a></div>
						</div>
						<div class='delete-button display-none'>
								<a href='javascript:void(0);'><span>×</span> 删除搭配</a>
						</div>
						<div class='pic-user-info'>
							<div>
								<a>".@$rs[name]."</a>
								<a>".@$rs[sex]." / ".@$rs[stature]."<span> cm</span></a>
								<a>".@$rs[signature]."&nbsp;</a>
							</div>
						</div>
					</div>
				<div class='clear'></div>
				</div>
			</div>";
		}
		mysqli_free_result($result);
		mysqli_close($link);
	}
}

?>