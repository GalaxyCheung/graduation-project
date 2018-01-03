//»Øµ½¶¥²¿
'use strict';

var backButton=$(".backToTop-button");  
	
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
    if ($(window).scrollTop() > $("#header-tool").height()){
        $(".header-tool").addClass("float-top-tool");
	}else{ 
        $(".header-tool").removeClass("float-top-tool");
	}
	
    if ($(window).scrollTop() > $("#header-1").height()-32){
        $(".nav").addClass("float-top-nav");
	}else{ 
        $(".nav").removeClass("float-top-nav");
	}
	
});   

$(window).trigger("scroll");