// JavaScript Document
'use strict'

	$("#info_button").mousedown(function(){
		
		$("#space_user_stature").val($(".user_stature").text());
		$("#space_user_signature").val($(".user_signature").text());
		$("#space_user_sex").val($(".user_sex").text());
			
		$("#finsh_button").parent().removeClass("display-none");
		$(this).parent().addClass("display-none");
		
		$(".space_user_introduction").find("div").removeClass("display-none");
		$("#space_user_signature").css({
			"display" : "block"
		});
		
		$(".user_charact").addClass("display-none");
		$(".user_signature").addClass("display-none");
		
		$("#finsh_button").mousedown(function(){
			
			if(confirm('确认更改') === true){
				var userStature = $("#space_user_stature").val();
				if(userStature === ""||userStature === null){
					alert("请输入你的身高");
					return;
				}else if(userStature < 80 || userStature > 200){
					alert("输入错误");
					return;
				}else{
					$("#info_button").parent().removeClass("display-none");
					$(this).parent().addClass("display-none");

					$(".space_user_introduction").find("div").addClass("display-none");
					$("#space_user_signature").css({
						"display" : "none"
					});

					$(".user_charact").removeClass("display-none");
					$(".user_signature").removeClass("display-none");
				}
			}else{
				return false; 
			}
			
		});
	});
	
	
	$(".space_picture_introduction").each(function(){
		var editButton = $(this).find(".edit_button");
		var closeButton = $(this).find(".close_button");
		var deleteButton = $(this).find(".delete_button");
		var space_h1 = $(this).find(".space_h1");
		var space_h2 = $(this).find(".space_h2");
		var space_cont = $(this).find(".space_cont");
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
				if(confirm('确认编辑') === true){
					var s_h1 = space_h1.val();
					var s_h2 = space_h2.val();
					var s_cont = space_cont.val();
					if(s_h1 === ""||s_h1 === null){
						alert("请输入标题");
						return;
					}else if(s_h2 === ""||s_h2 === null){
						alert("请输入副标题");
						return;
					}else if(s_cont === ""||s_cont === null){
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
				if(confirm('删除搭配') === true){
					
				}else{
					return false; 
				}
			});
		});
	});
	