//»Øµ½¶¥²¿
'use strict';

var backButton=$(".backToTop_button");  
	
function backToTop() {  
    $('html,body').animate({  
        scrollTop: 0  
    }, 200);  
}  
	
backButton.on("click", backToTop);  
  
$(window).on("scroll", function () {
    if ($(window).scrollTop() > $(window).height()){ 
        backButton.css({
			"display": "block"
		});  
    }else{
        backButton.css({
			"display": "none"
		});  
    } 
    if ($(window).scrollTop() > $("#header_tool").height()){
        $(".header_tool").addClass("float_top_tool");
	}else{ 
        $(".header_tool").removeClass("float_top_tool");
	}
	
    if ($(window).scrollTop() > $("#header-1").height()-32){
        $(".nav").addClass("float_top_nav");
	}else{ 
        $(".nav").removeClass("float_top_nav");
	}
	
});   

$(window).trigger("scroll");