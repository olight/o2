// JavaScript Document

  $(document).ready(function(e) {
    
	
	$("#add_submit").click( function(e) {
           //alert($(":checked").length);
              if ($("#addform #riqi").val()!=''&&$("#addform :checked").length>1) {
				 
				
					$.ajax({
						 type: "POST",
						 url: "./add_insert.php",
						 data: $("#addform").serialize(),
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
							 if($.trim(msg)=='same'){
							   //$.mobile.loading("hide");  
							   alert("此活动日期库里有啦，请返回到列表中更新记录");
							   $.mobile.loading("hide");
							 }else{
								alert("成功！强行插入了"+msg+"条人员记录");
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

