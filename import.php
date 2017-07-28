<?php

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
$lines = file($filename);

// Loop through each line
foreach ($lines as $line) {
	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;

	// Add this line to the current segment
	$templine .= $line;

	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';') {
		// Perform the query
		if(!mysqli_query($connection, $templine)){
			print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
		}
		// Reset temp variable to empty
		$templine = '';
	}
}

mysqli_close($connection);

echo "Database imported successfully";
