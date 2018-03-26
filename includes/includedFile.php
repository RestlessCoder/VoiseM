<?php

// Check if it come from AJAX request	
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	include('includes/config.php');
	include('includes/classes/Artist.php');
	include('includes/classes/Album.php');
	include('includes/classes/Song.php');
} else {
	include('includes/header.php');
	include('includes/footer.php');

	// will display full url e.g. /VoiseM/index.php?id=1
	$url = $_SERVER['REQUEST_URI'];
	echo "<script>openPage('url');</script>";
	exit();

}

?>