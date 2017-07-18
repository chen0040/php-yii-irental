<?php
	if(!isset($_GET['query']))
	{
		echo 'Invalid Query';
		return;
	}
	
	$password='Irental0';
	$iv=$password;
	
	$query=mcrypt_decrypt(MCRYPT_DES, $password, base64_decode($_GET['query']), MCRYPT_MODE_CBC, $iv);
	
	$query= rtrim($query, "\x00..\x1F");
	
    // Send variables for the MySQL database class.
    $database = mysql_connect('localhost', 'root', 'chen0469') or die('Could not connect: ' . mysql_error());
    mysql_select_db('mysql') or die('Could not select database');
    
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    $num_results = mysql_num_rows($result);  

	$num_fields = mysql_num_fields($result);
    for($i = 0; $i < $num_results; $i++)
    {
        $row = mysql_fetch_array($result);
		for($j = 0; $j < $num_fields; ++$j)
		{ 
            echo $row[$j];
			if($j != $num_fields - 1)
			{
				echo "\t";
			}
        } 
		echo "\n";
    }
	
?>