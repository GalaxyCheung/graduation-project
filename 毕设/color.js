
	//导航栏变色
	function colorTurn(){
		$(".nav ul li a").mousedown(function(){
			$(this).css({
				"color" : "#150303",
				"font-size" : "15px"
			});
			$(this).parent().siblings().find("a").css({
				"color" : "#FFF",
				"font-size" : "14px"
			});
		});
		$(".nav_middle ul li").each(function(i){
			var angle_left = 100*i+40;
			$(this).mousedown(function(){
				var isGirls = $(".nav_girls").css("display");
				$(this).css({
					"background-color" : "#00c9d0"
				});
				if(isGirls === "none"){
					$(this).siblings().css({
						"background-color" : "#444447"
					});
				}else{
					$(this).siblings().css({
						"background-color" : "#C72864"
					});
				 }
				$(".nav_middle_angle").css({
					"margin-left" : angle_left
				});
			});
		});
		}
		
		/*点击女生*/
	function girlsColor(){
		$(".header_sex_option ul li:nth-child(2)").find("a").mousedown(function(){
			$("#boy_option").attr("id","boy_option-1");
			$("#girl_option-1").attr("id","girl_option");
			$(".search_img").css({
				"background" : "url(images/girl_search.png) no-repeat 50%"
			});
			$("#header_search_input").css({
				"border": "1px solid #C72864"
			});
			$(".img_girls").css({
				"z-index" : 1	
			});
			$(".img_boys").css({
				"z-index" : "-1"
			});
			$(".nav_girls").css({
				"display" : "block"
			});
			$(".nav_boys").css({
				"display" : "none"
			});
			$(".nav_boys ul li:first-child").find("a").css({
				"color" : "#150303",
				"font-size" : "15px"
			});
			$(".nav_boys ul li:first-child").siblings().find("a").css({
				"color" : "#FFF",
				"font-size" : "14px"
			});
			$(".list_title").css({
				"background-color" : "#C72864"
			});
			$(".nav_middle").css({
				"background-color" : "#C72864"
			});
			$(".nav_middle ul li").css({
				"background-color" : "#C72864"
			});
			$(".nav_middle ul li:first-child").css({
				"background-color" : "#00c9d0"
			});
			$(".nav_middle_angle").css({
				"margin-left" : "40px"
			});
		});
	}
		/*点击男生*/
	function boysColor(){
		$(".header_sex_option ul li:first-child").find("a").mousedown(function(){
			$("#boy_option-1").attr("id","boy_option");
			$("#girl_option").attr("id","girl_option-1");
			$(".search_img").css({
				"background" : "url(images/boy_search.png) no-repeat 50%"
			});
			$("#header_search_input").css({
				"border": "1px solid #444447"
			});
			$(".img_girls").css({
				"z-index" : "-1"	
			});
			$(".img_boys").css({
				"z-index" : 1
			});
			$(".nav_boys").css({
				"display" : "block"
			});
			$(".nav_girls").css({
				"display" : "none"
			});
			$(".nav_girls ul li:first-child").find("a").css({
				"color" : "#150303",
				"font-size" : "15px"
			});
			$(".nav_girls ul li:first-child").siblings().find("a").css({
				"color" : "#FFF",
				"font-size" : "14px"
			});
			$(".list_title").css({
				"background-color" : "#444447"
			});
			$(".nav_middle").css({
				"background-color" : "#444447"
			});
			
			$(".nav_middle ul li").css({
				"background-color" : "#444447"
			});
			$(".nav_middle ul li:first-child").css({
				"background-color" : "#00c9d0"
			});
			$(".nav_middle_angle").css({
				"margin-left" : "40px"
			});
		});
	}
	colorTurn();
	boysColor();
	girlsColor();
		/*
		$(".header_sex_option ul li a").mousedown(function(ev){
			$(this).parent().css({
				"background-color" : "#444447",
			});
			$(this).css({
				"color" : "#000"
			});
			$(this).parent().siblings().css({
				"background-color" : "#000"
			});
			$(this).parent().siblings().find("a").css({
				"color" : "#FFF"
			});
		});
		*/
	