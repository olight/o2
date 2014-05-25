<?php 
if(isset($_GET['wxkey'])){  
   $wxkey = str_replace(" ","",$_GET['wxkey']);
   if($wxkey!=""){
	   setcookie('wxkey',$wxkey,time()+60*60*24*15);
	   }  
}else{
  
   setcookie('wxkey',0,time()+60*60*24*15);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>o2shenghuo login</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="jq/jquery.mobile-1.4.2.min.css" />
  <script src="jq/jquery-1.9.1.min.js"></script>
  <script src="jq/jquery.mobile-1.4.2.min.js"></script>
  <script src="jq/jquery.cookie.js"></script>
<script type="text/javascript">
function onBridgeReady(){
     document.addEventListener('WeixinJSBridgeReady', function onBridgeReady()  {
	   WeixinJSBridge.call('hideOptionMenu');
	   });
	  }
	  //$(document).ready(function(){
	
		
			  onBridgeReady();

$(document).ready(function(e) {
  
  if($.cookie("wxkey")!=0){
	$("#wxkey").val($.cookie("wxkey"));
	function djstz(i){
		//var i = 6;
		var c;
		tz();
		function tz(){		  
			     i--
				 $("#submit").text("微信验证自动登陆中("+i+")")			 
				 c=setTimeout(tz,1000)
				 if(i==0){
					 $("#submit").text("跳转中..")		
					 clearTimeout(t);
					  window.location.href='main.php';	
	
				 };//end if		
		};
					
	}	
	
  	$.ajax({
					 type: "POST",
					 url: "fulnamelogin_chk.php",
					 data: {wxkey:$.cookie("wxkey")},
					 beforeSend: function(XMLHttpRequest){
						  $("#submit").val("LOADING");
					 },
					 success: function(msg){
					   if(msg=='success_wxlogin'){
						   //console.log(djs());
						   $("#fullname").attr("disabled",true);
						   $("#submit").attr("disabled",true);
						   $("#submit").text("检测到微信，登陆中...");
						   djstz(6);
						   				
						
					   
					   }else if(msg=='false_wxnull_namnull'){
						  $("#message").text("新的微信盆友，输入姓名:");
					   
					   }else{
						  $("#message").text("在自动检测微信时出现的莫名错误");
					   
					   }},
  
					 timeout:10000                 
  
				 });//end ajax
  }	;

 
  function resetTextFields()
	  {
		  $("#fullname").val("");	
		  $("#submit").attr("disabled",false);	
	  }
  
 
	

			  
  function valid(){
			  if($.trim(($("#fullname").val()))==''){
  
				  $("#message").text("内容不能为空");
  
				  return false;          
			  }else{
				   return true;
			  }
			   
			 
			  
  };
	  
  resetTextFields();
  $("#submit").click( function(e) {
		if (valid()){ 
		  $("#submit").attr("disabled",true);
		  buttonCountSubmit();
		}
  });//end click
			  
  $(document).keyup(function(event){
		if(event.keyCode ==13){
		 
			if (valid()){ 
			  $("#submit").attr("disabled",true);
			  buttonCountSubmit();
			}
		           		 
		}
  });//end keyup




	
});//end doc.ready
 
 function submitform(){
			  
			
				$("#submit").attr("disabled",true);
				//$("#fullname").attr("disabled",true);
				$.ajax({
					 type: "POST",
					 url: "fulnamelogin_chk.php",
					 data: $("#loginform").serialize(),
					 beforeSend: function(XMLHttpRequest){
						  $("#submit").val("LOADING");
						 //ShowLoading();
					 },
					 success: function(msg){
					   if(msg=='success_withoutwx'){
						// $.mobile.changePage("main.php","slide", true, true);
						window.location.href='main.php';
					   }else if(msg=='success_savedwx'){
						alert('您的微信已绑定成功！');
						window.location.href='main.php';
					   }else if(msg=='false_hadwx'){
						  $("#message").text("此人已绑定其他微信");
						  $("#submit").attr("disabled",false);
						  $("#submit").text("GO");
						   n=6;	
					   }else if(msg=='false_errnam'){
						  $("#message").text("姓名有误或不存在");
						  $("#submit").attr("disabled",false);
						  $("#submit").text("GO");
						   n=6;	
						  
					   }else if(msg=='false_withoutwx_errnam'){
						  $("#message").text("输入的姓名有误或不存在");
						  $("#submit").attr("disabled",false);
						  $("#submit").text("GO");
						   n=6;	//如果验证失败重置读秒
						   
					   }},
  
					 timeout:10000                 
  
				 });//end ajax
				 
			
  }	//end func submitform


	var t;
	var n=6;  
	  
	function buttonCountSubmit(){
				 
				 n--
				 $("#submit").text("等待("+n+")")			 
				 t=setTimeout("buttonCountSubmit()",1000)
				 if(n==0){
					 $("#submit").text("提交中..")		
					 submitform();
					 clearTimeout(t);
	
				 };//end if				 
	} //end func b C Submit

</script>
</head>
<body>
<div data-role="page" data-control-title="Login" id="page1">
    <div data-role="header">  
        <h3>
           我的邮氧生活
        </h3>
    </div>   
    <div data-role="content" class="ui-content">
       <div id="message" style="font-size:12px;color:#F00; height:5px;"></div>
        <div data-role="fieldcontain">
         
         <form id="loginform" action="" method="post">
          <input name="fullname" id="fullname" placeholder="键入中文姓名查询" value="" type="text" onKeyDown="if(event.keyCode==13) return false;">              
         <input  id="wxkey" name="wxkey" type="hidden" value="" >
         <div><button id="submit" type="button" >GO</button></div>
         </form>
        </div>
    </div>
</div>
</body>
</html>