<?php 
	
	include('includes/config.php');
	include('includes/classes/Artist.php');
	include('includes/classes/Album.php');
	include('includes/classes/Song.php');

	// session_destroy(); // LOGOUT

	if(isset($_SESSION['userLoggedIn'])) {
		$userLoggedIn = $_SESSION['userLoggedIn'];
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

</head>
<body>
	
	<div id="mainContainer">
		<div id="topContainer">
			<?php include('includes/navBarContainer.php') ?>
		<div id="mainViewContainer">
			<div id="mainContent">