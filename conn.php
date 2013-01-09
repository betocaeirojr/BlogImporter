<?php
	
	// Define the SQL Constants for DB Conection
	define('SQL_HOST','localhost');
	define('SQL_USER','root');
	define('SQL_PASS','root');
	define('SQL_DB','cms');

	$conn = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
	if (!$conn) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
	}

	date_default_timezone_set('America/Sao_Paulo');
?>