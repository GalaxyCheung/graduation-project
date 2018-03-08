// JavaScript Document
'use strict'


	$("#info-button").mousedown(function(){
		
		$("#space-user-stature").val($(".user-stature").text());
		$("#space-user-signature").val($(".user-signature").text());
		$("#space-user-sex").val($(".user-sex").text());
		
		$("#finsh-button").parent().removeClass("display-none");
		$(this).parent().addClass("display-none");

		$(".space-user-introduction").find("div").removeClass("display-none");
		$("#space-user-signature").css({
				"display" : "block"
		});

		$(".user-charact").addClass("display-none");
		$(".user-signature").addClass("display-none");
		$(".empty-signature").addClass("display-none");
		
	});

	$("#finsh-button").mousedown(function(){
		var name = $(".user-name").text();
		var stat = $("#space-user-stature").val();
		var sex = $("#space-user-sex").val();
		var signa = $("#space-user-signature").val();
		var pwd = $.trim($("#pwd").val());
		var new_pwd = $.trim($("#new-pwd").val());
		var cfm_pwd = $.trim($("#cfm-pwd").val());
		
		var confirm_1 = confirm("是否确认更改");
		if(confirm_1 === true){
			var userStature = $("#space-user-stature").val();
			if(userStature === "" || userStature === null){
				alert("请输入你的身高");
				return;
			}else if(userStature < 50 || userStature > 270){
				if(userStature < 50){
					$("#space-user-stature").val(50);
				}else{
					$("#space-user-stature").val(270);
				}
				alert("身高范围应为50cm~270cm");
				return;
			}else if(pwd !== ""&&(pwd.length < 5 || pwd.length >17)){
				alert("原密码应为6~16个字符，请重新输入");
				return;
			}else if(new_pwd !== ""&&(new_pwd.length < 5 || new_pwd.length >17)){
				alert("新密码应为6~16个字符，请重新输入");
				return;
			}else if(new_pwd !== cfm_pwd){
				alert("新密码与原密码不一致");
				return;
			}else if(pwd !== ""&&new_pwd === ""){
				alert("请输入新密码");
			}else{
				$.ajax({
					url:"app/editUserInfo.php",
					type:"post",
					dataType:"json",
					data:{
						name:name,
						stat:stat,
						sex:sex,
						signa:signa,
						pwd:pwd,
						new_pwd:new_pwd
					},
					success: function(data){
						$(".user-sex").html(data[1]);
						$(".user-stature").html(data[2]);
						$(".user-signature").html(data[3]);
						
						$("#pwd").val("");
						$("#new-pwd").val("");
						$("#cfm-pwd").val("");
						
						$("#info-button").parent().removeClass("display-none");
						$("#finsh-button").parent().addClass("display-none");
						
						$(".space-user-introduction").find("div").addClass("display-none");
						$("#space-user-signature").css({
							"display" : "none"
						});
						$(".user-charact").removeClass("display-none");
						
						if(data[3] === ""){
							$(".user-signature").addClass("display-none");
							$(".empty-signature").removeClass("display-none");
						}else{
							$(".empty-signature").addClass("display-none");
							$(".user-signature").removeClass("display-none");
						}
					},
					error: function(){
						alert("原密码错误");
					}
				});
				}
			}else{
				return false;
			}
		});
	
	
	$(".space-picture-introduction").each(function(){
		var editButton = $(this).find(".edit-button");
		var closeButton = $(this).find(".close-button");
		var deleteButton = $(this).find(".delete-button");
		var space_h1 = $(this).find(".space-h1");
		var space_h2 = $(this).find(".space-h2");
		var space_cont = $(this).find(".space-cont");
		var h1_a = $(this).find(".h1-a");
		var h2_a = $(this).find(".h2-a");
		var cont_a = $(this).find(".cont-a");
		var pic_id = $(this).find(".pic-id");
		var pic_url = $(this).parents().find(".space-picture");
		
	  	editButton.find("a").first().mousedown(function(){
			
			if($(".edit-button").hasClass("display-none")){
				alert("请先完成其他编辑操作");
				return;
			}else{
				space_h1.val(h1_a.find("a").text());
				space_h2.val(h2_a.find("a").text());
				space_cont.val(cont_a.find("a").text());

				editButton.addClass("display-none");
				closeButton.removeClass("display-none");
				deleteButton.removeClass("display-none");

				space_h1.removeClass("display-none");
				space_h2.removeClass("display-none");
				space_cont.removeClass("display-none");

				h1_a.addClass("display-none");
				h2_a.addClass("display-none");
				cont_a.addClass("display-none");
			}
		});
		
		closeButton.find("a").first().mousedown(function(){
				
			var confirm_1 = confirm("是否确认编辑");
			if(confirm_1 === true){
				var p_id = pic_id.html();
				var s_h1 = replaceTextarea1(space_h1.val());
				var s_h2 = replaceTextarea1(space_h2.val());
				var s_cont = replaceTextarea1(space_cont.val());
				
				if(s_h1 === "" || s_h1 === null){
					alert("请输入标题");
					return;
				}else if(s_h2 === "" || s_h2 === null){
					alert("请输入副标题");
					return;
				}else if(s_cont === "" || s_cont === null){
					alert("请输入介绍内容");
					return;
				}else{
					$.ajax({
						url:"app/editPicInfo.php",
						type:"post",
						dataType:"json",
						data:{
							pic_id:p_id,
							title:s_h1,
							subtitle:s_h2,
							intro:s_cont
						},
						success:function(){
							window.location.href = "detail.php?pic_id="+p_id;
						}
					});
				}
			}else{
				return false; 
			}
		});	
		
		closeButton.find("a").eq(1).mousedown(function(){
			
			editButton.removeClass("display-none");
			closeButton.addClass("display-none");
			deleteButton.addClass("display-none");

			space_h1.addClass("display-none");
			space_h2.addClass("display-none");
			space_cont.addClass("display-none");

			h1_a.removeClass("display-none");
			h2_a.removeClass("display-none");
			cont_a.removeClass("display-none");
		});
		
		deleteButton.find("a").mousedown(function(){
			var p_id = pic_id.html();
			var p_url = pic_url.find("img").attr("src");
			
			var confirm_3 = confirm("是否删除搭配");
			if(confirm_3 === true){
				$.ajax({
					url:"app/deletePic.php",
					type:"post",
					dataType:"json",
					data:{
						pic_id:p_id,
						pic_url:p_url
					},
					success:function(){
						window.location.href = "space.php";
					},
					error:function(){
						alert("删除失败");
					}
				}); 
			}else{
				return false;
			}
		});
	});
	
//文本域换行符替换

function replaceTextarea1(str){
	var reg = new RegExp("\r\n","g");
	var reg1 = new RegExp(" ","g");

	str = str.replace(reg,"＜br＞");
	str = str.replace(reg1,"＜p＞");

	return str;
}

function replaceTextarea2(str){
	var reg = new RegExp("＜br＞","g");
	var reg1 = new RegExp("＜p＞","g");

	str = str.replace(reg,"\r\n");
	str = str.replace(reg1," ");

	return str;
}

function edUserInfo(){
	
}