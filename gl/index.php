
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>o2shenghuo manage login</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <link rel="stylesheet" href="../jq/jquery.mobile-1.4.2.min.css" />
  <script src="../jq/jquery-1.9.1.min.js"></script>
  <script src="../jq/jquery.mobile-1.4.2.min.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
  
 
	
  function resetTextFields()
	  {
		  $("#glname").val("");
		  $("#glpwd").val("");
	  }
  
  function submitform(){
			  
			  if (valid()) {
				  
					$.ajax({
					 type: "POST",
					 url: "./login_chk.php",
					 data: $("#loginform").serialize(),
					 beforeSend: function(XMLHttpRequest){
						  $("#submit").val("LOADING");
						 //ShowLoading();
					 },
					 success: function(msg){
					   if(msg=='success'){
						 $.mobile.changePage("./list.php","slide", true, true);
						//window.location.href='./list.html';
					   }else{
						  $("#message").text("姓名密码错误");
					   }},
  
					 timeout:10000                 
  
				  });
				 
			  }
  }	//end func submitform
	  
	 
			  
  function valid(){
			  if($.trim(($("#glname").val()))==''||$.trim($("#glpwd").val())==''){
  
				  $("#message").text("内容不能为空");
  
				  return false;          
			  }
			  return true;
  };
	  
  resetTextFields();
  $("#submit").click( function(e) {
				  submitform();
  
	  });//end click
			  
  $(document).keyup(function(event){
		if(event.keyCode ==13){
		 submitform();
		}
  });




	
});//end doc.ready
</script>
</head>
<body>
<div data-role="page" data-control-title="Login" id="login">
    <div data-role="header">  
        <h3>
            签到管理
        </h3>
    </div>   
    <div data-role="content" class="ui-content">
       <form id="loginform" action="" method="post">
       <div id="message" style="font-size:9px;color:#F00; height:5px;"></div>
        <div data-role="fieldcontain">         
          <input name="glname" id="glname" placeholder="键入姓名" value="" type="text"> 
          <input name="glpwd" id="glpwd" placeholder="键入密码" value="" type="password">                   
        </div>
        <div data-role="fieldcontain">
    <!--    <input name="submit" id="submit" type="button" value="GO" > -->
    <div><button id="submit" type="button">GO</button></div>
        </div>
         </form>
    </div>
</div>
</body>
</html>