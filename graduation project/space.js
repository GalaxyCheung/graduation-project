// JavaScript Document
'use strict'

//游客
if(false){
	$("#info-button").parent().addClass("display-none");
	$(".edit-button").addClass("display-none");
}

//用户本人
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
		
		$("#finsh-button").mousedown(function(){
			var confirm_1 = confirm("是否确认更改");
			if(confirm_1 === true){
				var userStature = $("#space-user-stature").val();
				if(userStature === "" || userStature === null){
					alert("请输入你的身高");
					return false;
				}else if(userStature < 50 || userStature > 270){
					if(userStature < 50){
						$("#space-user-stature").val(50);
					}else{
						$("#space-user-stature").val(270);
					}
					alert("身高范围应为50cm~270cm");
					return false;
				}else{
					$("#info-button").parent().removeClass("display-none");
					$(this).parent().addClass("display-none");

					$(".space-user-introduction").find("div").addClass("display-none");
					$("#space-user-signature").css({
						"display" : "none"
					});

					$(".user-charact").removeClass("display-none");
					$(".user-signature").removeClass("display-none");
				}
			}else{
				return false; 
			}
			
		});
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
		 
	  	editButton.find("a").mousedown(function(){
			
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

			closeButton.find("a").mousedown(function(){
				var confirm_1 = confirm("是否确认编辑");
				if(confirm_1 === true){
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
						editButton.removeClass("display-none");
						closeButton.addClass("display-none");
						deleteButton.addClass("display-none");

						space_h1.addClass("display-none");
						space_h2.addClass("display-none");
						space_cont.addClass("display-none");

						h1_a.removeClass("display-none");
						h2_a.removeClass("display-none");
						cont_a.removeClass("display-none");
						
					}
				}else{
					return false; 
				}
			});	
			
			deleteButton.find("a").mousedown(function(){
				var confirm_3 = confirm("是否删除搭配");
				if(confirm_3 === true){
					
				}else{
					return false; 
				}
			});
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