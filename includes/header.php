<?php 
	
	include('includes/config.php');
	include('includes/classes/User.php');
	include('includes/classes/Artist.php');
	include('includes/classes/Album.php');
	include('includes/classes/Song.php');
	include('includes/classes/Playlist.php');

	if(isset($_SESSION['userLoggedIn'])) {
		$userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
		$username = $userLoggedIn->getUsername();
		echo "<script>userLoggedIn = '$username'</script>";
	} else {
		header('Location: register.php');
	}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to VoiseM</title>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/script.js" type="text/javascript"></script>

</head>
<body>
	
	<div id="mainContainer">
		<div id="topContainer">
			<?php include('includes/navBarContainer.php') ?>
		<div id="mainViewContainer">
			<div id="mainContent">