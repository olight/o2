<?php
  session_start();
  header('Content-Type:text/html;charset=utf-8');
  include('../inc/conn.php');
  $glname=$_POST['glname'];
  $glpwd=$_POST['glpwd'];
  
  if(!empty($glname) and !empty($glpwd)){
	 $sql="select * from tb_yh where yhxm='".$glname."' and yhmm='".$glpwd."' and yhsfgly = 1";
	 $nuw=$conne->getRowsNum($sql);
	 $r=$conne->getRowsArray($sql);
	 if($nuw!=0){
		  $_SESSION['glname']=$r[0]['yhxm'];
		  
		  if($r[0]['yhsfds']==1){
		     $_SESSION['xiangmu']=3000;
		  }else if($r[0]['yhsfyq']==1){
			 $_SESSION['xiangmu']=3001; 
		  }else if($r[0]['yhsfkz']==1){
		     $_SESSION['xiangmu']=3002;
		  }
		  setcookie('glname',$_SESSION['glname'],time()+60*60*24*15);
		  setcookie('xiangmu',$_SESSION['xiangmu'],time()+60*60*24*15);
		  echo "success";
		  
		 }else{
		  echo "false";
		}
	
	 }

?>