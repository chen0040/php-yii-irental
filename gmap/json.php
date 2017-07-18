<?php
    // Send variables for the MySQL database class.
    $database = mysql_connect('localhost', 'root', 'chen0469') or die('Could not connect: ' . mysql_error());
    mysql_select_db('mysql') or die('Could not select database');

	$limit=100;
	if(isset($_GET['limit']))
	{
		$limit=intval(mysql_real_escape_string($_GET['limit']));
	}
	
	$distance=3;
	if(isset($_GET['radius']))
	{
		$distance=floatval(mysql_real_escape_string($_GET['radius'])) / 1000;
	}
	
	if(isset($_GET['lat']) && isset($_GET['lng']))
	{
		$orig_lat=mysql_real_escape_string($_GET['lat']);
		$orig_lng=mysql_real_escape_string($_GET['lng']);
		$query = "SELECT irtbl_marker.*, irtbl_user.lastname as lastname, irtbl_user.firstname as firstname, irtbl_user.phone as phone_number, irtbl_user.mobile as mobile, irtbl_user.url as url, irtbl_user.description as user_description, irtbl_user.email as email, 3956*2*ASIN(SQRT(POWER(SIN((".$orig_lat." - abs(irtbl_marker.lat)) * pi() / 180 /2), 2) + COS(".$orig_lat."* pi()/180) * COS(abs(irtbl_marker.lat)*pi()/180) * POWER(SIN((".$orig_lng." - irtbl_marker.lng)*pi()/180/2), 2))) as distance FROM `irtbl_marker`, `irtbl_user` where irtbl_marker.create_user_id=irtbl_user.id HAVING distance <= ".$distance." order by distance limit ".$limit;
	}
	else
	{
		$query = "SELECT irtbl_marker.* FROM `irtbl_marker` limit ".$limit;
	}
	
    
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    $num_results = mysql_num_rows($result);  

	echo '{'."\n";
	echo '"markers":'."\n";
	echo '['."\n";
    for($i = 0; $i < $num_results; $i++)
    {
        $row = mysql_fetch_array($result);
		
		echo '{'."\n";
		echo '"name":"'.$row['name'] . '",'."\n";
		echo '"description":"'. $row['description'] . '",'."\n";
		echo '"lat":"'.$row['lat'].'",'."\n";
		echo '"lng":"'.$row['lng'].'",'."\n";
		echo '"id":"'.$row['id'].'",'."\n";
		echo '"update_time":"'.$row['update_time'].'",'."\n";
		echo '"distance":"'.$row['distance'].'", '."\n";
		echo '"data_type":"'.$row['data_type'].'", '."\n";
		echo '"price":"'.$row['price'].'", '."\n";
		echo '"firstname":"'.$row['firstname'].'", '."\n";
		echo '"lastname":"'.$row['lastname'].'", '."\n";
		echo '"description":"'.$row['description'].'", '."\n";
		echo '"create_user_id":"'.$row['create_user_id'].'", '."\n";
		echo '"email":"'.$row['email'].'", '."\n";
		echo '"phone_number":"'.$row['phone_number'].'", '."\n";
		
		echo '"image_link1":"'.$row['image_link1'].'", '."\n";
		echo '"image_link2":"'.$row['image_link2'].'", '."\n";
		echo '"image_link3":"'.$row['image_link3'].'", '."\n";
		echo '"image_link4":"'.$row['image_link4'].'", '."\n";
		echo '"video_link":"'.$row['video_link'].'", '."\n";
		
		echo '"mobile":"'.$row['mobile'].'", '."\n";
		echo '"user_description":"'.$row['user_description'].'", '."\n";
		echo '"url":"'.$row['url'].'", '."\n";

		$address = $row['address'];
		$address = str_replace("\r\n", "<br />", $address);
		
		echo '"address":"'.$address.'"'."\n";
		if($i != $num_results -1 )
		{
			echo '},'."\n";
		}
		else
		{
			echo '}'."\n";
		}
    }
	echo ']'."\n";
	echo '}'."\n";
?>