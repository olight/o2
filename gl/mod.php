<?php   include('../inc/conn.php'); ?>
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
if(isset($_GET["riqi"])){
	
	$riqi = str_replace(" ","",$_GET["riqi"]);
}else{
	$riqi = null;
}
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

<div data-role="page"  id="add">
 <script src="../js/mod.js"></script>
  <div role="main" class="ui-content">
  <div data-role="popup" id="message"></div>
  <form id="modform">
    <div class="ui-field-contain" data-controltype="selectmenu">
        <label for="xiangmu">
            <strong>
            有氧项目:
            </strong>
        </label>
        <select id="xiangmu" name="xiangmu">
            <?php if($xiangmu==3000){?>
            <option value="3000">
                登山
            </option>
            <?php }else if($xiangmu==3001){?>
            <option value="3001">
                羽球
            </option>
            <?php }else if($xiangmu==3002){?>
            <option value="3002">
                快走
            </option>
            <?php }//end if?>
        </select>
    </div><!--selectmenu-->
    <div class="ui-field-contain" data-controltype="dateinput">
        <label for="riqi">
            <strong>
            活动日期：
            </strong>
        </label>
        <input name="riqi" id="riqi" placeholder="" value="<?=$riqi?>" type="date">      
    </div><!--dateiput-->
    <div id="checkboxes1" class="ui-field-contain" data-controltype="checkboxes">
        <fieldset data-role="controlgroup" data-type="vertical">
            <legend>
                <strong>
                参加人员:
                </strong>
                <?php
				
				$sql = "SELECT tb_yh.yhbh,tb_yh.yhxm,a.qdrq,a.xmbh,a.qdsfcj FROM tb_yh					  
					    LEFT JOIN					  
						  (SELECT tb_qd.qdrq,tb_qd.xmbh,tb_qd.yhbh,tb_qd.qdsfcj 
						   FROM tb_qd WHERE tb_qd.qdrq = '".$riqi."'  AND tb_qd.xmbh = ".$xiangmu." AND  tb_qd.qdsfcj=1) AS a			  
					    ON
					    tb_yh.yhbh=a.yhbh";


                try{
                     $r=$conne->getRowsArray($sql);
	                 for($i=1;$i<=$conne->getRowsNum($sql);$i++){
				
				?>
            </legend>
            <input id="checkbox<?=$i?>" name="renyuan[]" value="<?= $r[$i-1]['yhbh'] ?>"  type="checkbox" <?php if($r[$i-1]['qdsfcj']==1){echo"checked";}; ?> >
            <label for="checkbox<?=$i?>">
                <?=$r[$i-1]['yhxm'] ?>
            </label>                 
            <?php
			           }  //end for           
    
                    
                }//end try
                catch(Exception $e)
                {
                    echo $e->getMessage();
                }
			
			?>
        </fieldset>
    </div> <!--checkboxs-->
    </form>  
  </div>
  <div data-role="footer"  data-position="fixed">
    <div data-role="navbar" data-iconpos="top">
      <ul>
        <li><a href="list.php" data-icon="grid">列表</a></li>
        <li><a href="#" id="mod_submit" data-icon="check">更新</a></li>
      </ul>
    </div>
   
  </div>
</div>


</body>
</html>

<?php $conne->close_conn(); ?>