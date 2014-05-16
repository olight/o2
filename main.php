<?php include('./inc/conn.php'); ?>
<?php 
session_start();

if(isset($_GET['wxkey'])){  
   $wxkey = str_replace(" ","",$_GET['wxkey']);
   if($wxkey!=""){
	   setcookie('wxkey',$wxkey,time()+60*60*24*15);
	   }  
}else{
   $wxkey="";
}


if(isset($_COOKIE['fullname'])&&isset($_COOKIE['xiangmu'])&&isset($_COOKIE['yhnum'])){   
   $xiangmu = $_COOKIE['xiangmu'];
   $yhnum = $_COOKIE["yhnum"];
}else{
	if(isset($_SESSION["fullname"])&&isset($_SESSION["xiangmu"])&&isset($_SESSION['yhnum'])){
		 $xiangmu = $_SESSION['xiangmu'];  
		 $yhnum = $_SESSION["yhnum"];    	
	}else{
	     header("Location: index.php");
	}
}


			
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">

<!--  <link rel="stylesheet" href="jq/jquery.mobile-1.4.2.min.css" />-->
    <link rel="stylesheet" href="jq/jquery.mobile-1.3.2.min.css">
    <script src="jq/jquery-1.9.1.min.js"></script>
    <script src="jq/jquery.mobile-1.4.2.min.js"></script>
    <script src="jq/jquery.cookie.js"></script>
    <script src="js/highcharts.js"></script>
	<script type="text/javascript">
	function WeiXinCloseBtn() {
	  if (typeof WeixinJSBridge == "undefined") {
		closeWin()
	   } else {
		 WeixinJSBridge.call('closeWindow'); 
	  }
    }
	function onBridgeReady(){
     document.addEventListener('WeixinJSBridgeReady', function onBridgeReady()  {
	   WeixinJSBridge.call('hideOptionMenu');
	   });
	  }
	  //$(document).ready(function(){
	
		
			  onBridgeReady();
		 

	  //});
		function closeWin(){
			//alert('cl')		
		  var keys=document.cookie.match(/[^ =;]+(?=\=)/g); 
		  if (keys) { 
			for (var i = keys.length; i--;) 
			document.cookie=keys[i]+'=0;expires=' + new Date( 0).toUTCString() 
			window.location.href='index.php';
		  } 
		
		}
	  
	  $(document).ready(function(){$("#fname").text($.cookie('fullname').charAt(0))});
	
	  
	  function clearWxkey(){
	  if($.cookie('wxkey')!=0||$.cookie('wxkey')!=""){
		  }
	  }
    
    $(document).ready(function () {
		  var chart;  
		  var yqdata=[];
		  var kzdata=[];
		  var dsdata=[]; 
		   
		  $.ajax({    
			  url: 'areacharts_get.php',    
			  dataType:"json",    
			  async:false,  
			  success:function(point){  
			 // alert(point);
			  var obj=eval(point);  
		
				for(var i in obj.dengshan) {
				    dsdata.push([obj.dengshan[i].qdrq, parseInt(obj.dengshan[i].yhsl)]);
				}
				
				console.log(dsdata);
				
				for(var i in obj.yuqiu) {
				    yqdata.push([obj.yuqiu[i].qdrq, parseInt(obj.yuqiu[i].yhsl)]);
				}
				console.log(yqdata);
				
				for(var i in obj.kuaizou) {
				    kzdata.push([obj.kuaizou[i].qdrq, parseInt(obj.kuaizou[i].yhsl)]);
				}
				console.log(kzdata);
				
				
		  },    
			  error: function(){alert('error!')},    
		  });  
							   
        $('#container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: '累计参加(人)'
            },
            subtitle: {
                text: ' '
            },
			credits: {
            enabled: false
            },
            plotOptions:{},
            xAxis: {
                labels: {                                      
                },
         
                tickInterval:1
                
            },
            yAxis: {
                title: {
                    text: ' '
                },
                labels: {                    
                }
            },
            tooltip: {                
            },
            series: [{
                name: '羽球',
                data:yqdata
                
            },{
                name: '快走',
                data: kzdata
            },{
                name: '登山',
                data: dsdata
            } ]
        });
    });   
    </script>
</head>
<body>
<div data-role="page" data-control-title="main" id="main" data-theme="c">
  
 <?php 
 
 
 
 
	  $sql = "select * from v_tj_ds_yq_kz_KQ_zpm where yhbh = ".$yhnum."";
	  try{
		   $r=$conne->getRowsRst($sql);
			$xm=$r['yhxm'];
			$rank=$r['zpm'];
			if( is_null($r['dsgrcs']) || is_null($r['dsallcs']) || is_null($r['dspm']) ){
				$dscs=0;
				$dszcs=0.1;
				$dsrank=0;				
			}else{
				$dscs=$r['dsgrcs'];
				$dszcs=$r['dsallcs'];
				$dsrank=$r['dspm'];
			};
			
			if( is_null($r['yqgrcs']) || is_null($r['yqallcs']) || is_null($r['yqpm']) ){
				$yqcs=0;
				$yqzcs=0.1;
				$yqrank=0;				
			}else{
				$yqcs=$r['yqgrcs'];
				$yqzcs=$r['yqallcs'];
				$yqrank=$r['yqpm'];
			};
			
			if( is_null($r['kzgrcs']) || is_null($r['kzallcs']) || is_null($r['kzpm']) ){
				$kzcs=0;
				$kzzcs=0.1;
				$kzrank=0;				
			}else{
				$kzcs=$r['kzgrcs'];
				$kzzcs=$r['kzallcs'];
				$kzrank=$r['kzpm'];
			};
			
	

	 
	  if($xiangmu==3000){
		  $a1="登山"; $a2=$dscs*100/$dszcs; $a2=floor($a2*10)/10;
		  $b1="羽球"; $b2=$yqcs*100/$yqzcs; $b2=floor($b2*10)/10;
		  $c1="快走"; $c2=$kzcs*100/$kzzcs; $c2=floor($c2*10)/10;
		  $rankname="山/羽/走";
		  $rank1=$dsrank;
		  $rank2=$yqrank;
		  $rank3=$kzrank;
		 }else if($xiangmu==3001){
		  $a1="羽球"; $a2=$yqcs*100/$yqzcs; $a2=floor($a2*10)/10;
		  $b1="登山"; $b2=$dscs*100/$dszcs; $b2=floor($b2*10)/10;
		  $c1="快走"; $c2=$kzcs*100/$kzzcs; $c2=floor($c2*10)/10;
		  $rankname="羽/山/走";
		  $rank1=$yqrank;
		  $rank2=$dsrank;
		  $rank3=$kzrank;
		 }else if($xiangmu==3002){
		  $a1="快走"; $a2=$kzcs*100/$kzzcs; $a2=floor($a2*10)/10;
		  $b1="羽球"; $b2=$yqcs*100/$yqzcs; $b2=floor($b2*10)/10;
		  $c1="登山"; $c2=$dscs*100/$dszcs; $c2=floor($c2*10)/10;
		  $rankname="走/羽/山";
		  $rank1=$kzrank;
		  $rank2=$yqrank;
		  $rank3=$dsrank;
		 }
	  
	  ?> 
     <script type="text/javascript">
	  if(document.all){  
        alert("不支持IE及IE内核浏览器!");  
      }
	  
	 

		  var a=0
		  var b=0
		  var c=0
		  var r1=0
		  var r2=0
		  var r3=0
		  var r=0

		 
		 
		   function timedCountA()
				{	  
				  if(<?=$a2?>==0){
					  $("#a2").text(0+"%")
				  }else{
					  a=a+1;	 
					  a1=	parseFloat(<?=$a2?>);	
					  a2= parseFloat(parseInt(a1));			
					  a3= a1 -a2; 
					  a3= Math.round(a3*10)/10;
					  t1=setTimeout("timedCountA()",30)	   
					  if(a==a2||a==100){
							clearTimeout(t1);
							  }	  	  
					  $("#a2").text((a+a3)+"%")
				  }
				}
				
		   function timedCountB()
				{	  
				  if(<?=$b2?>==0){
					  $("#b2").text(0+"%")
				  }else{  
					  
					  b=b+1;	 
					  b1=	parseFloat(<?=$b2?>);	
					  b2= parseFloat(parseInt(b1));			
					  b3= b1 -b2; 
					  b3= Math.round(b3*10)/10;
					  t2=setTimeout("timedCountB()",30)	   
					  if(b==b2||b==100){
							clearTimeout(t2);
							  }	  	  
					  $("#b2").text((b+b3)+"%")
				  }
				
				}
		  
		   function timedCountC()
				{	  
				  if(<?=$c2?>==0){
					  $("#c2").text(0+"%")
				  }else{  
					  
					  c=c+1;	 
					  c1=	parseFloat(<?=$c2?>);	
					  c2= parseFloat(parseInt(c1));			
					  c3= c1 -c2; 
					  c3= Math.round(c3*10)/10;
					  t3=setTimeout("timedCountC()",30)	   
					  if(c==c2||c==100){
							clearTimeout(t3);
							  }	  	  
					  $("#c2").text((c+c3)+"%")
				  }
				}
				
			 function timedCountR1()
				{	  
					if(<?=$rank1?>==0){  
					    
						$("#rank1").text("第"+0+"名")
					    
					}else{
						r1=r1+1;	 
						t=setTimeout("timedCountR1()",50)	   
						if(r1==<?=$rank1?>||r1==100){
							  clearTimeout(t);
								}	  	  
						$("#rank1").text("第"+r1+"名")
					}
				}	
				
				function timedCountR2()
				{	  
						
					if(<?=$rank2?>==0){  
					    
						$("#rank2").text("第"+0+"名")
					    
					}else{
						r2=r2+1;	 
						t=setTimeout("timedCountR2()",50)	   
						if(r2==<?=$rank2?>||r2==100){
							  clearTimeout(t);
								}	  	  
						$("#rank2").text("第"+r2+"名")
					}
						
				}	
				
				function timedCountR3()
				{	  
					if(<?=$rank3?>==0){  
					    
						$("#rank3").text("第"+0+"名")
					    
					}else{
						
						r3=r3+1;	 
						t=setTimeout("timedCountR3()",50)	   
						if(r3==<?=$rank3?>||r3==100){
							  clearTimeout(t);
								}	  	  
						$("#rank3").text("第"+r3+"名")
					}
				
				}	
		
		
                function timedCountR()
				{	  
					if(<?=$rank?>==0){  
					    
						$("#rank").text("第"+0+"名")
					    
					}else{
						
						r=r+1;	 
						t=setTimeout("timedCountR()",50)	   
						if(r==<?=$rank?>||r==100){
							  clearTimeout(t);
								}	  	  
						$("#rank").text("第"+r+"名")
					}
				
				}	
				

	   window.onload =function() {
		   
			timedCountA();  
			timedCountB(); 
			timedCountC(); 
			timedCountR1();
			timedCountR2();
			timedCountR3();
			timedCountR();
			}
     </script>
      
    <div class="ui-grid-solo">
     
          <div class="ui-bar ui-bar-b">
           <div>
             <?=$a1?>       
           </div>
           <div id="a2" style=" text-align:center; line-height:110px; height:140px; font-size:70px;">计算中</div>
          </div>    
      
    </div> <!--主项目-->
    
    <div class="ui-grid-a">
        <div class="ui-block-a">
          <div class="ui-bar ui-bar-c">
           <div style="color:#999">
            <?=$b1?>
           </div>
           <div id="b2"  style=" text-align:center; line-height:50px; height:70px; font-size:30px;">计算中</div>
          </div>    
        </div>
        <div class="ui-block-b">
          <div class="ui-bar ui-bar-c">
          <div style="color:#999">
            <?=$c1?>
           </div>
           <div id="c2"  style=" text-align:center; line-height:50px; height:70px; font-size:30px;">计算中</div>
          </div>    
        </div>
    </div><!-- /副项目1、2 -->
   <div class="ui-grid-solo">
     <div class="ui-bar-c ui-bar">
        <div style="color:#999;">总排名</div>
          <div id="rank"  style=" text-align:center; line-height:80px; height:90px; font-size:40px;">计算中</div>    
        </div>
    </div> <!--名次-->
    <div class="ui-bar ui-bar-c">
     <div class="ui-grid-b"> 
     <div style="color:#999; "><?=$rankname?></div>
      <div class="ui-block-a" >  
        <!--<div style="color:#999; font-size:9px;">山/羽/走</div>-->
        <div id="rank1" style=" text-align:center; line-height:70px; height:80px; font-size:20px;">计算中</div>
       </div>        
      <div class="ui-block-b">
<!--     <div style="color:#999; font-size:9px;">羽球</div>-->
        <div id="rank2" style=" text-align:center; line-height:70px; height:80px; font-size:20px;">计算中</div>
      </div>
      <div  class="ui-block-c">
<!--      <div style="color:#999; font-size:9px;">快走</div>-->
        <div id="rank3" style=" text-align:center; line-height:70px; height:80px; font-size:20px;">计算中</div>
      </div>                
   </div> 
   </div><!-- /副项目1、2 -->
      
  <div class="ui-grid-solo">
    <!-- <div> -->     
         <div id="container" style="min-width:100px;height:200px">载入中</div>   
      <!--  </div>-->
    </div> <!--图谱-->
    
    <div class="ui-grid-solo">
      <div style="text-align:center;font-size:12px;">
           @<span id="fname">x</span>师傅
           <a href="#"  onclick="WeiXinCloseBtn();">退出</a> |
           <a id="logout" href="">非本人?</a>          
       </div>
    </div> <!--link-->
   
 <?php 
	                        
    
                    
	  }//end try
	  catch(Exception $e)
	  {
		  echo $e->getMessage();
	  }
			
	 ?>
</div><!-- /end page -->

</body>
</html>
<?php $conne->close_conn(); ?>