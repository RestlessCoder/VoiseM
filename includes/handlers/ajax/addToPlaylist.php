<?php
	
	include("../../config.php");

	if(isset($_POST['songId']) && isset($_POST['playlistId'])) {

		$playlistId = $_POST['playlistId'];
		$songId = $_POST['songId'];

		$orderIdQuery = mysqli_query($con, "SELECT IFNULL(MAX(playlistOrder) + 1, 1) as playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'"); // IFNULL let me return alternative value if the value is null
		$row = mysqli_fetch_assoc($orderIdQuery);
		$order = $row['playlistOrder'];

		$query = mysqli_query($con, "INSERT INTO playlistsongs VALUES('', '$songId', '$playlistId', '$order')");

	} else {
		echo "PlaylistId and songId was not passed into addToPlaylist.php file";
	}

?>