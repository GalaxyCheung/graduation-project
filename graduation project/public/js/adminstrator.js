// JavaScript Document

'use strict';
//侧边导航栏固定
	$(document).ready(function(){
		var h = 149-$(window).scrollTop();
		if ($(window).scrollTop() > 71){
			$(".side-bar").css({
				"top" : "71px"
			});
		}else if($(window).scrollTop()<71&&$(window).scrollTop()>0){ 
			$(".side-bar").css({
				"top" : h
			});
		}
	});
	
	$(window).on("scroll", function () {
		var h = 149-$(window).scrollTop();
		if ($(window).scrollTop() > 71){
			$(".side-bar").css({
				"top" : "71px"
			});
		}else if($(window).scrollTop()<71&&$(window).scrollTop()>0){ 
			$(".side-bar").css({
				"top" : h
			});
		}else{
			$(".side-bar").css({
				"top" : "181px"
			});
		}
	});   
	
//用户信息修改操作
	
/*头像更改*/  	
$(function(){
	$("#file").change(function(){
		var docObj = document.getElementById("file");
		var imgObjPreview = document.getElementById("look");
		
		var filepath = $(this).val();
		var extStart = filepath.lastIndexOf(".");
		var ext = filepath.substring(extStart,filepath.length).toUpperCase();
		
		var file_size = this.files[0].size;
		
		var size = file_size / 1024;

		if(ext!==".BMP"&&ext!==".PNG"&&ext!==".GIF"&&ext!==".JPG"&&ext!==".JPEG"){
			$(".check-pro a").html("请选择一个格式正确的图片");
			return false;
		}else if(size > 10240){
			$(".check-pro a").html("上传的图片大小不能超过10M");
			return false;
		}else{
			$(".check-pro a").html("");
		}
		
		if (docObj.files && docObj.files[0]) {
			imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
		}else{
			imgObjPreview.src = docObj.files[0].getAsDataURL();
		}
			return true;
		});
});

	$(".title-box").each(function(){
		var editButton = $(this).find(".edit-button");
		var closeButton = $(this).find(".close-button");
			
		var u_b1 = $(this).find(".admin-user-box");
		var u_b2 = $(this).find(".edit-user-box");
		var old_prof = $(this).find("#look").attr("src");
		
		var box = $(this);
		
	  	editButton.find(".edit").first().mousedown(function(){
			if($(".edit-button").hasClass("display-none")){
				alert("请先完成其他编辑操作");
				return;
			}else{
				editButton.addClass("display-none");
				closeButton.removeClass("display-none");

				u_b1.addClass("display-none");
				u_b2.removeClass("display-none");
			}
		});
		
		closeButton.find("a").first().mousedown(function(){
			
		var user_id = box.find(".user-id").text();
		var prof_file = box.find("#file").get(0).files[0];
		var name = box.find("#user-login").val();
		var sex = box.find("#user-sex").val();
		var stat = box.find("#user-stature").val();
		var signa = box.find("#user-signature").val();
		var rule = box.find("#admin").prop("checked");
			
		if(rule === true){
			rule = 1;
		}else{
			rule = 2;
		}
		var formData = new FormData();
		formData.append('user_id',user_id);
		formData.append('prof_file',prof_file);
		formData.append('old_prof',old_prof);
		formData.append('name',name);
		formData.append('sex',sex);
		formData.append('stat',stat);
		formData.append('signa',signa);
		formData.append('rule',rule);
			
		var confirm_1 = confirm("是否确认更改");
		if(confirm_1 === true){
			if(name === "" || name === null){
				alert("请输入用户名");
				return false;
			}else if(name.replace(/[^\u0000-\u00ff]/g,"ab").length <= 4 || name.replace(/[^\u0000-	\u00ff]/g,"aa").length >= 13){
				alert("用户名应为5~12个字符，请重新输入");
				return false;
			}else if(stat === "" || stat === null){
				alert("请输入身高");
				return false;
			}else if(stat < 50 || stat > 270){
				if(stat < 50){
					box.find("#user-stature").val(50);
					return false;
				}else{
					box.find("#user-stature").val(270);
					return false;
				}
				alert("身高范围应为50cm~270cm");
				return false;
			}else{
				$.ajax({
					url:"app/editUser.php",
					type:"POST",
					data:formData,
					dataType:"text",
					cache: false,
					processData: false,
    				contentType: false,
					success: function(){
						window.location.reload();
					},
					error: function(){
						alert("Ajax error!");
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

			u_b2.addClass("display-none");
			u_b1.removeClass("display-none");
		});
		
		closeButton.find("a").eq(2).mousedown(function(){
			var user_id = box.find(".user-id").text();
			var confirm_3 = confirm("是否删除改用户");
			if(confirm_3 === true){
				$.ajax({
					url:"app/deleteUser.php",
					type:"post",
					dataType:"json",
					data:{
						user_id: user_id,
						old_prof: old_prof
					},
					success:function(){
						alert("删除成功");
						window.location.reload();
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



//图片信息修改操作
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
		
	  	editButton.find(".edit").first().mousedown(function(){
			
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
							alert("编辑成功");
							window.location.reload();
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
						alert("删除成功");
						window.location.reload();
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

//隐藏表单更换页数
	$(".page-num").mousedown(function(){
		var pageNum = $(this).text();
		$("#page").val(pageNum);
		$("#changePage").submit();
	});
	$(".prev-page").mousedown(function(){
		var pageNum = $(".current-page").text();
		$("#page").val(pageNum-1);
		$("#changePage").submit();
	});
	$(".next-page").mousedown(function(){
		var pageNum = $(".current-page").text();
		$("#page").val(pageNum+1);
		$("#changePage").submit();
	});