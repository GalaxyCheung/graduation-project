// JavaScript Document
var http_request = false;
function createRequest(url){
	'use strict';
	http_request = false;
	if(window.XMLHttpRequest){//Mozila
		http_request = new XMLHttpRequest();
		if(http_request.overrideMimeType){
			http_request.onreadystatechange("text/xml");
		}
	}else if(window.ActiveXObject){
		try{
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
			http_request = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){}
	}
	}
	if(http_request){
		alert("不能创建 XMLHTTP 实例!");
		return false;
	}
	http_request.onreadystatechange = alertContents; //指定响应方法
	//发出 HTTP 请求
	http_request.open("GET".url,true);
	http_request.send(null);
}

function alertContents(){
	'use strict';
	if(http_request.readyState === 4){
		if(http_request.readyState === 200){
			alert(http_request.responseText);
		}else{
			alert("您请求的页面发现错误");
		}
	}
}