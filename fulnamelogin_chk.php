<?php
  session_start();
  header('Content-Type:text/html;charset=utf-8');
  include('inc/conn.php');
  
  $fullname = str_replace(" ","",$_POST["fullname"]);
  $wxkey = str_replace(" ","",$_GET["wxkey"]);
  
  if(!empty($fullname)){
	 $sql="select * from tb_yh where yhxm='".$fullname."' and yhsfbdw = 1";
	 $nuw=$conne->getRowsNum($sql);
	 $r=$conne->getRowsArray($sql);
	 if($nuw!=0){
		  $_SESSION['fullname']=$r[0]['yhxm'];
		  $_SESSION['yhnum']=$r[0]['yhbh'];
		  
		  if($r[0]['yhsfds']==1){
		     $_SESSION['xiangmu']=3000;
		  }else if($r[0]['yhsfyq']==1){
			 $_SESSION['xiangmu']=3001; 
		  }else if($r[0]['yhsfkz']==1){
		     $_SESSION['xiangmu']=3002;
		  }
		  setcookie('yhnum',$_SESSION['yhnum'],time()+60*60*24*15);
		  setcookie('fullname',$_SESSION['fullname'],time()+60*60*24*15);
		  setcookie('xiangmu',$_SESSION['xiangmu'],time()+60*60*24*15);
		  echo "success";
		  
		 }else{
		  echo "false";
		}
	
	 }

?>