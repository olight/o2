<?php
  session_start();
  header('Content-Type:text/html;charset=utf-8');
  include('../inc/conn.php');
  //获取post参数
  $xiangmu=$_POST["xiangmu"];
  $riqi=$_POST["riqi"];
  if(isset($_POST["renyuan"])){
	     $arr_ry =$_POST["renyuan"];
	  }else{
	     $arr_ry[0]=" ";
  }
  
  //变量声明区
  $rerownums=0;
  
  //查看当日是否已存在记录
  $sql="select * from tb_qd where qdrq ='".$riqi."' and xmbh =".$xiangmu."";
  $num=$conne->getRowsNum($sql);
  //print_r($arr_ry);
   if($num!=0){
	   
	   echo "same";
	   }else{				
	  //当日不存在记录，执行新增
	      for($i=1;$i<=count($arr_ry);$i++){
			  if($i==1){
				  $sql="INSERT INTO tb_qd (yhbh,qdrq,xmbh) VALUES (".$arr_ry[$i-1].",'".$riqi."',".$xiangmu.")";
				  }else{
				  
				  $sql=$sql.",(".$arr_ry[$i-1].",'".$riqi."',".$xiangmu.")";	  
				//INSERT INTO tb_qd (yhbh,qdrq,xmbh) VALUES (1005,'2014-03-20',3000),(1006,'2014-03-20',3000) 
				}		  		        					 							 
								
		  }//end for
		   //echo $sql;
		  $rerownums =  $conne->uidRst($sql);
		
	 
	  echo $rerownums;
	
	
	
	}//end if
		
	
?>
<?php $conne->close_conn(); ?>