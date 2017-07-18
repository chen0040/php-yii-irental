<?php
    // Send variables for the MySQL database class.
    $database = mysql_connect('localhost', 'root', 'chen0469') or die('Could not connect: ' . mysql_error());
    mysql_select_db('mysql') or die('Could not select database');

	$limit=100;
	if(isset($_GET['limit']))
	{
		$limit=intval(mysql_real_escape_string($_GET['limit']));
	}
	
	if(isset($_GET['lat']) && isset($_GET['lng']))
	{
		$orig_lat=mysql_real_escape_string($_GET['lat']);
		$orig_lng=mysql_real_escape_string($_GET['lng']);
		$query = "SELECT irtbl_marker.*, 3956*2*ASIN(SQRT(POWER(SIN((".$orig_lat." - abs(irtbl_marker.lat)) * pi() / 180 /2), 2) + COS(".$orig_lat."* pi()/180) * COS(abs(irtbl_marker.lat)*pi()/180) * POWER(SIN((".$orig_lng." - irtbl_marker.lng)*pi()/180/2), 2))) as distance FROM `irtbl_marker` order by distance limit ".$limit;
	}
	else
	{
		$query = "SELECT * FROM `irtbl_marker` limit ".$limit;
	}
	
    
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    $num_results = mysql_num_rows($result);  

    for($i = 0; $i < $num_results; $i++)
    {
         $row = mysql_fetch_array($result);
         echo $row['name'] . "\t" . $row['description'] . "\t".$row['lat']."\t".$row['lng']."\t".$row['distance']."\n";
    }
?>