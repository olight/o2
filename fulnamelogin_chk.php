<?php
  session_start();
  header('Content-Type:text/html;charset=utf-8');
  include('inc/conn.php');
  

   
  if(isset($_POST['fullname'])){  
   $fullname = str_replace(" ","",$_POST['fullname']);  
   }else{
	   $fullname="";
   }
  if(isset($_POST['wxkey'])){  
   $wxkey = str_replace(" ","",$_POST['wxkey']);  
   }else{
	   $wxkey="";
   }
   
  if(!empty($wxkey)){//key不为空
	   $sql="select * from tb_yh where wxkey='".$wxkey."' and yhsfbdw = 1";
	   $nuw=$conne->getRowsNum($sql);
	   if($nuw!=0){//key有记录
		    $r=$conne->getRowsArray($sql);//打开记录集
			//注册相关参数
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
			echo "success_wxlogin";//使用wxkey登陆成功
			
		   }else{//key没记录
			   
			   if(!empty($fullname)){//key没记录且name不空
			        $sql="select * from tb_yh where yhxm='".$fullname."' and yhsfbdw = 1 AND (yhsfds >0 OR yhsfkz>0 OR yhsfyq>0)";
					$nuw=$conne->getRowsNum($sql);
					if($nuw!=0){//key没记录且name不空: name有记录
						$sql="select * from tb_yh where yhxm='".$fullname."' AND wxkey IS NOT NULL AND wxkey <>'' and yhsfbdw = 1";
						$nuw=$conne->getRowsNum($sql);
						if($nuw==0){//通过name查询无key记录
							$sql="UPDATE tb_yh SET wxkey = '".$wxkey."'  where yhxm='".$fullname."'";
							$rerownums =  $conne->uidRst($sql);
							if($rerownums>0){//如果更新成功
								$bdmsg= "_savedwx"; //绑定成功
								}//end 如果更新成功
							
							$sql="select * from tb_yh where yhxm='".$fullname."' and yhsfbdw = 1 AND (yhsfds >0 OR yhsfkz>0 OR yhsfyq>0)";
							$nuw=$conne->getRowsNum($sql);
							if($nuw>0){//have rows
									$r=$conne->getRowsArray($sql);//打开记录集
									//注册相关参数
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
									$logmsg= "success";
								
								}//end have rows
							   echo $logmsg.$bdmsg; //success绑定成功
							
							}else{//通过name查询存在key记录
							   echo "false_hadwx";//此姓名已绑定wxkey
								
							}//end 通过name查询存在key记录
					    
						
						
						
					    }else{//key没记录且name不空: name无记录
		                   echo "false_errnam";//name姓名错误或不存在
	                    }//end key没记录且name不空: name无记录
				   
				   }else{//key没记录且name空
					   
					   echo "false_wxnull_namnull";//找不到wxkey，请输入姓名
					   
					}//end key没记录且name空
			   
			   
			   }//end key没记录
	  
	  
	  
	  }else{//key为空
			 if(!empty($fullname)){
			   $sql="select * from tb_yh where yhxm='".$fullname."' and yhsfbdw = 1 AND (yhsfds >0 OR yhsfkz>0 OR yhsfyq>0)";
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
					  echo "success_withoutwx";
					  
				 }else{
					  echo "false_withoutwx_errnam";
				 }
			
		    }
			
	}//end key为空
   
   
   
  
  

?>