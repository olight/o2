<?php 
if(isset($_COOKIE['wxkey'])&&isset($_COOKIE['fullname'])){  
   $wxkey = str_replace(" ","",$_COOKIE['wxkey']);
   $fullname = str_replace(" ","",$_COOKIE['fullname']);
   
   if($wxkey!=""&&$wxkey!=0){
	  $sql="select * from tb_yh where wxkey='".$wxkey."' and yhsfbdw = 1";
	   $nuw=$conne->getRowsNum($sql);
	   if($nuw!=0){//key有记录
	    }
	 }  
}else{
	echo "nowxkey";

}


 if(!empty($wxkey)){//key不为空
	   
 }
?>