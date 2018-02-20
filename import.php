<?php

//Uncomment this below line for larger database to allow script to execute long time
// set_time_limit(0);

// database file path
$filename = 'filaname.sql';

// MySQL host
$mysql_host = 'localhost';

// MySQL username
$mysql_username = 'USERNAME';

// MySQL password
$mysql_password = 'PASSWORD';

// Database name
$mysql_database = 'DB_NAME';

// Connect to MySQL server
$connection = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database);

if (mysqli_connect_errno())
	echo "Failed to connect to MySQL: " . mysqli_connect_error();

// Temporary variable, used to store current query
$templine = '';


// Read in entire file
$fp = fopen($filename, 'r');

// Loop through each line
while (($line = fgets($fp)) !== false) {
	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;

	// Add this line to the current segment
	$templine .= $line;

	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';') {
		// Perform the query
		if(!mysqli_query($connection, $templine)){
			print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($connection) . '<br /><br />');
		}
		// Reset temp variable to empty
		$templine = '';
	}
}

mysqli_close($connection);
fclose($fp);

echo "Database imported successfully";
