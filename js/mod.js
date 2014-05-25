// JavaScript Document

  $(document).ready(function(e) {
    
	
	$("#mod_submit").click( function(e) {
           //alert($(":checked").length);
              if ($("#modform #riqi").val()!=''&&$("#modform :checked").length>1) {
				 
				
					$.ajax({
						 type: "POST",
						 url: "./mod_insert.php",
						 data: $("#modform").serialize(),
						 dataFilter: function(data,type){
						   var str = data;
						  
						  // str.match(str)
						   if(str.match('stop')=='stop'){
							   data = 'stop'
						   }else{
							  str = str.replace(/<\/?[^>]*>/g,''); //去除HTML tag
							  str = str.replace(/[ | ]*\n/g,'\n'); //去除行尾空白
							  str = str.replace(/\n[\s| | ]*\r/g,'\n'); //去除多余空行
							  str = str.replace(' ',''); //去除多余空格
							  str=str.replace(/&nbsp;/ig,'');//去掉&nbsp;
							  str = str.replace(/\d+/ig,'$&');
							  data =str;
							  console.log(data);					   
						   }
						   return data;
						 },
						 dataType:"text",
						 beforeSend: function(XMLHttpRequest){
							  //$("#submit").val("LOADING");
							 //ShowLoading();
							 $.mobile.loading( "show", {
								text: "提交中",
								textVisible: true,
								theme: "z",
							  });
						 },
						 success: function(msg){						   
							 if($.trim(msg)=='stop'){
							   //$.mobile.loading("hide");  
							   alert("这是一条全新的签到信息，修改失败");
							   $.mobile.loading("hide");
							 }else{
								alert("成功！修改为"+$.trim(msg)+"条人员记录");
								$.mobile.changePage("./list.php?xiangmu="+$("#xiangmu").val()+"","slide", true, true);
							 }
						 },
  
						 timeout:10000                 
  
				  });//end ajax
                               
             }else{
			    alert("日期、人员不能为空");
				//$("#message").fadeIn(2000).text("日期,人员不能为空")
//				.css({"color":"#F00","background-color":"#FF9","text-align":"center"})
//				.fadeOut(5000);
               
				
			 }//end if
       e.preventDefault();
    });//end click
			
			
	
	
  });

