<?php include('./inc/conn.php'); ?>
<?php 
if(isset($_COOKIE['wxkey'])&&isset($_COOKIE['fullname'])){  
   $wxkey = str_replace(" ","",$_COOKIE['wxkey']);
   $fullname = str_replace(" ","",$_COOKIE['fullname']);

   if(($wxkey!=""||!empty($wxkey))&&($wxkey!=0||$wxkey!="0")&&($fullname!=""||!empty($fullname))){
	  $sql="select * from tb_yh where wxkey='".$wxkey."' and yhxm='".$fullname."' and yhsfbdw = 1";
	   $nuw=$conne->getRowsNum($sql);
	   if($nuw!=0){ //key有记录
			$sql="UPDATE tb_yh SET wxkey = NULL ,jbwxdate = NOW()  where yhxm='".$fullname."'";
			$rerownums =  $conne->uidRst($sql);
			if($rerownums>0){//如果更新成功
				echo "success_jbwx"; //解绑成功
			}else{
				echo "false_jbwx";		  
			}	   	   
	    }else{
			echo "fasle_errwxerrname";
		}
	}else{

	   echo "fasle_nowxkey";
		
	}  
}else{
	echo "nowxkey";

}

?>