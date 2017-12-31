
'use strict';



	//中部导航
		$(".nav_middle ul li").each(function(i){
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
				
				$(".nav_middle_angle").css({
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








//checkinfo
function checkinfo(){
	
  var name=document.getElementById("user_login").value;
  var pass=document.getElementById("user_pass").value;
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

function checkinfo1(){
	
  var name=document.getElementById("user_login").value;
  var pass=document.getElementById("user_pass").value;
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


var code;
function createCode(n){
  code="";
  var checkCode=document.getElementById("checkCode");
  var sourceStr=new Array("S","A","d","w","4","a","5","o","t","j","N","b","X","z","6","0","1","2","x","n","v");
    for (var i=0; i<n; i++) {
    var charIndex=(sourceStr[Math.floor(Math.random()*21)]);
    code+=charIndex;
  }
  if (checkCode){
    checkCode.className="unchanged";
    checkCode.innerHTML=code;
  }
}