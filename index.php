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
<script type="text/javascript">

$(document).ready(function(e) {
 
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
				$.ajax({
					 type: "POST",
					 url: "fulnamelogin_chk.php",
					 data: $("#loginform").serialize(),
					 beforeSend: function(XMLHttpRequest){
						  $("#submit").val("LOADING");
						 //ShowLoading();
					 },
					 success: function(msg){
					   if(msg=='success'){
						// $.mobile.changePage("main.php","slide", true, true);
						window.location.href='main.php';
					   }else{
						  $("#message").text("哎呀，您的姓名有误");
						  $("#submit").attr("disabled",false);
						  $("#submit").text("GO");	
						  n=6; //如果验证失败重置读秒为6
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
         <!-- <input name="submit" id="submit" type="button" value="查询" >-->
         <div><button id="submit" type="button" >GO</button></div>
         </form>
        </div>
    </div>
</div>
</body>
</html>