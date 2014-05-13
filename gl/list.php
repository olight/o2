<?php include('../inc/conn.php'); ?>
<?php session_start(); ?>
<?php 
if(isset($_COOKIE['glname'])){   
   $xiangmu = $_COOKIE['xiangmu'];
}else{
	if(isset($_SESSION["glname"])){
		 $xiangmu = $_SESSION['xiangmu'];      	
	}else{
	     header("Location: index.php");
	}
}

//	if(isset($_GET["xiangmu"])){
//		$xiangmu = $_GET["xiangmu"];
//	}else{
//		$xiangmu = 3000;
//	};


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>o2shenghuo manage</title>
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <link rel="stylesheet" href="../jq/jquery.mobile-1.4.2.min.css" />
  <script src="../jq/jquery-1.9.1.min.js"></script>
  <script src="../jq/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
<div data-role="page"  id="">

    <div data-role="content">	
      <ul data-role="listview">
      <?php 
	  $sql = "select * from v_qdyhstj where xmbh = ".$xiangmu."";
	  try{
                     $r=$conne->getRowsArray($sql);
	                 for($i=1;$i<=$conne->getRowsNum($sql);$i++){
	  
	  ?>
        <li><a href="mod.php?xiangmu=<?= $r[$i-1]['xmbh']?>&riqi=<?= $r[$i-1]['qdrq']?>"><?= $r[$i-1]['qdrq']?> <span class="ui-li-count"><?= $r[$i-1]['yhsl']?></span></a></li>
     <?php 
	                 }  //end for           
    
                    
	  }//end try
	  catch(Exception $e)
	  {
		  echo $e->getMessage();
	  }
			
	 ?>
      </ul>
	</div>    

   
  <div data-role="footer" data-position="fixed">
	<div data-role="navbar" data-iconpos="top">
        <ul>
	      <?php if($xiangmu==3000){?>
            <li><a href="list.php?xiangmu=3000" data-icon="grid" <?php if($xiangmu==3000){echo "class=\"ui-btn-active\" ";} ?> >登山</a></li>
            <?php }else if($xiangmu==3001){?>
            <li><a href="list.php?xiangmu=3001" data-icon="grid" <?php if($xiangmu==3001){echo "class=\"ui-btn-active\" ";} ?>>羽球</a></li>
            <?php }else if($xiangmu==3002){?>
            <li><a href="list.php?xiangmu=3002" data-icon="grid" <?php if($xiangmu==3002){echo "class=\"ui-btn-active\" ";} ?>>快走</a></li>
            <?php }//end if?>
            <li><a href="add.php" data-icon="plus" data-prefetch="true">新增签到</a></li>

		</ul>
	</div><!-- /navbar -->
   </div>

</div><!-- /page -->  

</body>
</html>
<?php $conne->close_conn(); ?>