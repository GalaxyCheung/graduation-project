
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
	
	if(user_name === "" || user_name === null){
		alert("请输入用户名");
		return false;
	}else if(user_name.replace(/[^\u0000-\u00ff]/g,"ab").length <= 4 || user_name.replace(/[^\u0000-\u00ff]/g,"aa").length >= 13){
		alert("用户名应为5~12个字符，请重新输入!");
		return false;
	}else if(user_pass === "" || user_pass === null){
		alert("请输入密码");
		return false;
	}else if(user_pass.replace(/[^\u0000-\u00ff]/g,"aa").length <= 5 || user_pass.replace(/[^\u0000-\u00ff]/g,"aa").length >= 17){
		alert("密码应为6~16个字符，请重新输入!");
		return false;
	}else{
		return false;
	}		
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

	
function checkinfo1(){
	var user_name = $.trim($("#user-login").val());
	var user_pass = $("#user-pass").val();
	var confirm_pass = $("#password").val();
	var user_code = $("#check-code").val();
	var check_code = $("#checkCode").html();
	
	if(user_name === "" || user_name === null){
		alert("请输入用户名");
		return false;
	}else if(user_name.replace(/[^\u0000-\u00ff]/g,"ab").length <= 4 || user_name.replace(/[^\u0000-\u00ff]/g,"aa").length >= 13){
		alert("用户名应为5~12个字符，请重新输入!");
		return false;
	}else if(user_pass === "" || user_pass === null){
		alert("请输入密码");
		return false;
	}else if(user_pass.replace(/[^\u0000-\u00ff]/g,"aa").length <= 5 || user_pass.replace(/[^\u0000-\u00ff]/g,"aa").length >= 17){
		alert("密码应为6~16个字符，请重新输入!");
		return false;
	}else if(confirm_pass === "" || confirm_pass === null){
		alert("请确认您的密码");
		return false;
	}else if(user_pass !== confirm_pass){
		alert("密码不一致，请重新输入");
		return false;
	}else if(user_code === "" || user_code === null){
		alert("请输入验证码");
		return false;
	}else if(user_code !== check_code){
		alert("验证码错误，请重新输入");
		return false;
	}else{
		$(".signup-user-info").addClass("display-none");
		$(".signup-user-data").removeClass("display-none");
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