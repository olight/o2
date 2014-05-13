<?php
header('Content-type: text/json'); 
include('inc/conn.php');
//羽毛球数据读取
$sql_yq ="SELECT qdrq,yhsl from v_qdyhstj WHERE xmbh = 3001 ORDER BY qdrq ;";	 	 
$nuw=$conne->getRowsNum($sql_yq);
$r=$conne->getRowsArray($sql_yq);
if($nuw!=0){				  
  $arr_yq=array('yuqiu' => $r);	//将print_r($r)查看数组$r的结构			  
   }else{
  $arr_yq=array('yuqiu' =>0)	;
}
$conne->close_rst();


//快走数据读取
$sql_kz ="SELECT qdrq,yhsl from v_qdyhstj WHERE xmbh = 3002 ORDER BY qdrq ;";	 	 
$nuw=$conne->getRowsNum($sql_kz);
$r=$conne->getRowsArray($sql_kz);
if($nuw!=0){
  $arr_kz=array('kuaizou' => $r);  
	//echo json_encode($arr_kz);   	
   }else{
	$arr_kz=array('kuaizou' => 0); 
}

$conne->close_rst();

//登山数据读取
$sql_ds ="SELECT qdrq,yhsl from v_qdyhstj WHERE xmbh = 3000 ORDER BY qdrq ;";
$nuw=$conne->getRowsNum($sql_ds);
$r=$conne->getRowsArray($sql_ds);
if($nuw!=0){  	  
  $arr_ds=array('dengshan' => $r);
  
	//echo json_encode($arr_kz);   
	
   }else{
	$arr_ds=array('dengshan' => 0);
  }
 $conne->close_rst();
 
//组合三个数组值，转换为json格式 
echo json_encode($arr_yq+$arr_kz+$arr_ds);
?>