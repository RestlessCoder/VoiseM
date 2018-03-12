<?php
	ob_start();

	$timezone = date_default_timezone_set('Europe/London');

    // Create connection
	$con = mysqli_connect('localhost', 'root', '', 'voisem');

	// Check connection
	if(!$con) {
		echo "Connection error:" . " " .mysqli_connect_error();
	}

?>