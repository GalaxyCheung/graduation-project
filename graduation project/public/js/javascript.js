
'use strict';


	//中部导航
		$(".nav-middle ul li").each(function(i){
			$(this).attr("index",i);
			
			var angle_left = 122*i+48;
			
			$(this).mouseenter(function(){
				
				if($(this).css("background-color") === "rgb(0, 201, 208)"){
					var diffcolor = $(this).index();
				}
				$(this).css({
					"background-color" : "#00c9d0"
				});	
				
				
			$(this).mousedown(function(){
				$(this).css({
					"background-color" : "#00c9d0"
				});
				
				$(this).siblings().css({
					"background-color" : "#444447"
				});
				
				$(".nav-middle-angle").css({
					"margin-left" : angle_left
				});
				diffcolor = $(this).index();
			});
				
			$(this).mouseleave(function(){
				if(diffcolor !== $(this).index()){
					$(this).css({
						"background-color" : "#444447"
						});
					}
				});
			});
		});





		
function checkinfo(){
	var user_name = $("#user-login").val();
	var user_pass = $("#user-pass").val();
	
	function check_name(){
		if(user_name === "" || user_name === null){
			$(".check-name a").html("请输入用户名");
			return false;
		}else if(user_name.replace(/[^\u0000-\u00ff]/g,"ab").length <= 4 || user_name.replace(/[^\u0000-	\u00ff]/g,"aa").length >= 13){
			$(".check-name a").html("用户名应为5~12个字符，请重新输入");
			return false;
		}else{
			$.ajax({
				url: "app/checkinfo.php",
				type: "POST",
				dataType: "json",
				data: {username: user_name,userpass: user_pass},
				error: function(){  
					alert('Error loading XML document');  
				},  
				success: function(data) {
					if (data[0] !== ""&&data[1] !== ""){
						$(".check-name a").html("用户名或密码错误，请重新输入");
						return;
					} else {
						if($("#remember-me").is(":checked")){
							$.cookie("remember-me", "true", {expires: 1});
							$.cookie("username", user_name, {expires: 1});
							$.cookie("password", user_pass, {expires: 1});
							window.location.href="index.php";
							return false;
						}else{
							$.cookie("rememberUser", "false", {expires: -1});
							$.cookie("userName", '', {expires: -1});
							$.cookie("passWord", '', {expires: -1});
							window.location.href="index.php";
							return false;
						}
					}
				}
			});
			
		}
	}
	function check_pass(){
		if(user_pass === "" || user_pass === null){
			$(".check-pass a").html("请输入密码");
			return false;
		}else if(user_pass.length <= 5 || user_pass.length >= 17){
			$(".check-pass a").html("密码应为6~16个字符，请重新输入");
			return false;
		}else{
			$(".check-pass a").html("");
		}
	}
	
	check_name();
	check_pass();
	
	return false;
}
	
/*
//checkinfo
function checkinfo(){
	
  var name=document.getElementById("user-login").value;
  var pass=document.getElementById("user-pass").value;
  var input=document.getElementById("input1").value;
  
if(name==""||name==null){
alert("用户名为空，请重新输入!");
return false;}
else if(name.length<3||name.length>10){
alert("用户名应为4~10个字符，请重新输入!");
return false;}
else{
if(pass==""||pass==null){
alert("密码为空，请重新输入!");
return false;}
else if(pass.length<3||pass.length>17){
alert("密码应为4~16个字符，请重新输入!");
return false;}

if(input==code){
	}
else{
alert("验证码不正确，请重新输入!");
return false;}
}
}
*/
	
	$("#user-login").focus(function(){
	$("#user-login").blur(function(){
		
		var user_name = $.trim($("#user-login").val());
		
		if(user_name === "" || user_name === null){
			$(".check-name a").html("请输入用户名");
			return false;
		}else if(user_name.replace(/[^\u0000-\u00ff]/g,"ab").length <= 4 || user_name.replace(/[^\u0000-	\u00ff]/g,"aa").length >= 13){
			$(".check-name a").html("用户名应为5~12个字符，请重新输入");
			return false;
		}else{		
				$.ajax({
					url: "app/checkName.php",
					type: "POST",
					dataType: "json",
					data: {username: user_name},
					error: function(){  
						alert('Error loading XML document');  
					},  
					success: function(data) {
						if (data[0] === "") {
							$(".check-name a").html("「 "+user_name + " 」 已被注册");
							return false;
						} else {
							$(".check-name a").html("「 "+user_name + " 」 可以注册");
						}
					}
				});
			}
		});
	});

function checkinfo_1(){
	
	var i = 0;
	
	function check_name(){

		var user_name = $.trim($("#user-login").val());
		if($(".check-name a").text() === "「 "+user_name + " 」 可以注册"){
			i++;
			}
		}
	
	function check_pass(){
		
		var user_pass = $("#user-pass").val();
		
		if(user_pass === "" || user_pass === null){
			$(".check-pass a").html("请输入密码");
			return false;
		}else if(user_pass.length <=5 || user_pass.length >= 16){
			$(".check-pass a").html("密码应为6~16个字符，请重新输入");
			return false;
		}else{
			$(".check-pass a").html("");
			i++;
		}
	}
	
	function cfm_pass(){
		
		var confirm_pass = $("#password").val();
		var user_pass = $("#user-pass").val();
		
		if(confirm_pass === "" || confirm_pass === null){
			$(".check-cfmpass a").html("请确认您的密码");
			return false;
		}else if(user_pass !== confirm_pass){
			$(".check-cfmpass a").html("确认密码与密码不一致，请重新输入");
			return false;
		}else{
			$(".check-cfmpass a").html("");
			i++;
		}
	}
	
	function check_code(){
		
		var user_code = $("#check-code").val();
		var code = $("#checkCode").html();
		
		if(user_code === "" || user_code === null){
			$(".check-code a").html("请输入验证码");
			return false;
		}else if(user_code !== code){
			$(".check-code a").html("验证码错误，请重新输入");
			return false;
		}else{
			$(".check-code a").html("");
			i++;
		}
	}
	
	
	check_name();
	check_pass();
	cfm_pass();
	check_code();
	
	if(i === 4){
		$(".signup-user-info").addClass("display-none");
		$(".signup-user-data").removeClass("display-none");		
	}else{
		return false;
	}
}

 
function checkinfo_2(){
	
	var i = 0;
	
	function check_stat(){
		
		var user_stat = $(".data-stature").val();
		
		if(user_stat === "" || user_stat === null){
			$(".check-stat a").html("请输入您的身高");
			return false;
		}else if(user_stat < 50 || user_stat > 270){
			if(user_stat < 50){
					$(".data-stature").val("50");
				}else{
					$(".data-stature").val("270");
				}
			$(".check-stat a").html("身高范围应为50cm~270cm");
			return false;
		}else{
			i++;
		}
	}
	function check_pro(){
		var filepath = $("#file").val();

		if(filepath === ""){
			$(".check-pro a").html("请上传您的头像");
			return false;
		}else{
			i++;
		}
	}
		check_stat();
		check_pro();
	
	if(i ===2){
		return true;
	}else{
		return false;
	}
}
/*
function checkinfo1(){
	
  var name=document.getElementById("user-login").value;
  var pass=document.getElementById("user-pass").value;
  var input=document.getElementById("input1").value;
  var password=document.getElementById("password").value;
  
if(name==""||name==null){
alert("用户名为空，请重新输入!");
return false;}
else if(name.length<3||name.length>10){
alert("用户名应为4~10个字符，请重新输入!");
return false;}
else{
if(pass==""||pass==null){
alert("密码为空，请重新输入!");
return false;}
else if(pass.length<3||pass.length>17){
alert("密码应为4~16个字符，请重新输入!");
return false;}

if(input==code){
	}
else{
alert("验证码不正确，请重新输入!");
return false;}
}

if(password==""||password==null){
alert("密码为空，请重新输入!");
return false;}
else if(password.length<3||password.length>17){
alert("确认密码应为4~16个字符，请重新输入!");
return false;}
else if(password!=pass){
alert("密码与确认密码不一致，请重新输入!");
return false;}
}
*/

var code;
function createCode(n){
  code="";
  var checkCode=document.getElementById("checkCode");
  var sourceStr=new Array("m","8","d","w","4","a","5","Q","t","j","p","b","X","z","6","0","1","2","x","n","v","O","o","q","P","Z");
    for (var i=0; i<n; i++) {
    var charIndex=(sourceStr[Math.floor(Math.random()*21)]);
    code+=charIndex;
  }
  if (checkCode){
    checkCode.className="unchanged";
    checkCode.innerHTML=code;
  }
}

$(".nav-search-type").change(function(){
	var t = $(this).find("option:selected").text();
	if(t === "搭配"){
		$("#pic_title").removeClass("display-none");
		$(".nav-search").attr("action","search.php");
	}else{
		$("#pic_title").addClass("display-none");
		$(".nav-search").attr("action","search-2.php");
	}
});