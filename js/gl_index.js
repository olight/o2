// JavaScript Document




function resetTextFields()
    {
        $("#glname").val("");
        $("#glpwd").val("");
    }

    
$(document).ready(function(){
	
	//提交
   $("#submit").click( function(e) {

              if (valid()) {
                $.ajax({
                   type: "POST",
                   url: "./login_chk.php",
                   data: $("#loginform").serialize(),
                   success: function(msg){
                     if(msg=='success'){
                        $.mobile.changePage("./list.html","fade", true, true);
                     }else{
                        $("#message").text("姓名密码错误");
                     }
				     
				   error:function(){
					   $("#message").text("请求错误");
					   }
				   timeout:10000                 
                   }

                });
               e.preventDefault();
              }

            });

});


function valid(){
            if($("#glname").val()==''||$("#glpwd").val()==''){

                $("#message").text("内容不能为空");

                return false;          
            }
            return true;
};



