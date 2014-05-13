<?php
  session_start();
  header('Content-Type:text/html;charset=utf-8');
  include('inc/conn.php');
  $wxkey = str_replace(" ","",$_POST["wxkey"]);
  
  if(isset($_COOKIE['fullname'])&&isset($_COOKIE['xiangmu'])&&isset($_COOKIE['yhnum'])){   
	 $xiangmu = $_COOKIE['xiangmu'];
	 $yhnum = $_COOKIE["yhnum"];
  }else{
	  if(isset($_SESSION["fullname"])&&isset($_SESSION["xiangmu"])&&isset($_SESSION['yhnum'])){
		   $xiangmu = $_SESSION['xiangmu'];  
		   $yhnum = $_SESSION["yhnum"];    	
	  }else{
		   header("Location: index.php?wxkey=");
	  }
  }
  
  if(!empty($wxkey)){
	 $sql="select * from tb_wx where yhbh=".$yhnum."";
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
			 //如果不存在
		  echo "false";
		}
	
	 }

?>