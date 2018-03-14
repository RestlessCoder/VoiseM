<?php 
	
	include('includes/config.php');

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
	<meta charset = "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to VoiseM</title>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>
	
	<div id="mainContainer">
		<div id="topContainer">
			<div class="navbarContainer">
				<nav class="navBar">
					<a class="navBrand">
						<img src="assets/images/icons/logo-brand.png" class="logo">
					</a>
					<div class="group">
						<div class="navItem">
							<a href="search.php" class="navItemLink">Search<img src="assets/images/icons/search.png" class="icon"></a>
						</div>
					</div>
					<div class="group">
						<div class="navItem">
							<a href="browser.php" class="navItemLink">Browser</a>
						</div>
						<div class="navItem">
							<a href="yourMusic.php" class="navItemLink">Music</a>
						</div>
						<div class="navItem">
							<a href="profile.php" class="navItemLink">Birthday Man</a>
						</div>
					</div>
				</nav>
			</div>
		</div>
		<div id="playingBarContainer">
			<div id="playingBar">
				<div id="playingBarLeft">
					<div class="content">
						<div class="albumArtwork">
							<img src="assets/images/albums/smiley.png" alt="smiley">
						</div>
						<div class="trackInfo">
							<span class="trackName">
								<span>Happy Birthday</span>
							</span>
							<span class="artistName">
								<span>Birthday Man</span>
							</span>
						</div>
					</div>
				</div>
				<div id="playingBarCenter">
					<div id="playingBarControls">
						<div class="buttons">
							<button class="controlButton shuffle">
								<img src="assets/images/icons/shuffle.png" alt="shuffle">
							</button>
							<button class="controlButton previous">
								<img src="assets/images/icons/previous.png" alt="previous">
							</button>
							<button class="controlButton play">
								<img src="assets/images/icons/play.png" alt="play">
							</button>
							<button class="controlButton pause">
								<img src="assets/images/icons/pause.png" alt="pause">
							</button>
							<button class="controlButton next">
								<img src="assets/images/icons/next.png" alt="next">
							</button>
								<button class="controlButton repeat">
								<img src="assets/images/icons/repeat.png" alt="repeat">
							</button>
						</div>
					</div>

					<div class="playingProgressBar">
						<span class="progressTime current">0.00</span>
						<div class="progressBar">
							<div class="progressBarIcon">
								<div class="progress"></div>
							</div>
						</div>
						<span class="progressTime remaining">0.00</span>
					</div>
				</div>
				<div id="playingBarRight">
					<div class="volumeBar">
						<button class="controlButton volume">
							<img src="assets/images/icons/volume.png" alt="volume">
						</button>
						<div class="progressBar">
							<div class="progressBarIcon">
								<div class="progress"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/main.js" type="text/javascript"></script>
	</script>

</body>
</html>
