<?php
/*** mysql hostname ***/
$hostname = 'localhost';
 
/*** mysql username ***/
$username = 'root';
 
/*** mysql password ***/
$password = 'root123456';
 
$dbname = 'o2ms';
 

try
{
    mysql_connect($hostname, $username, $password);
    mysql_select_db($dbname); //测试连接DB，成果true，失败false
} 
catch (Exception $e) 
{
    // normally we would log this error
    echo $e->getMessage();    
}   
 
function db_select_list($query)
{
    $q = mysql_query($query);
    if (!$q) return null;
    $ret = array();
    while ($row = mysql_fetch_array($q, MYSQL_ASSOC)) {
        array_push($ret, $row);
    }
    mysql_free_result($q);
    return $ret;
} 
 
function db_select_single($query)
{
    $q = mysql_query($query);
    if (!$q) return null;
    $res = mysql_fetch_array($q, MYSQL_ASSOC);
    mysql_free_result($q);
    return $res;
}


 try{
  
	$result = mysql_query("SELECT * FROM tb_yh");
//        $row = mysql_fetch_array($result);
		while($row = mysql_fetch_array($result))
		{
			echo  $row['yhbh'] . $row['yhxm'] ;
		}
//        print_r($row);
//		
//		$arr=array("yzg","xm"=>"Yzg","22","nl"=>"22","gcx","gz"=>"gcx");
//		print_r($arr);
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}

?>
