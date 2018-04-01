<?php include('includes/includedFile.php');
	
	if(isset($_GET['id'])) {
		$playlistId = $_GET['id'];
	}else {
		header('Location: index.php');
	}

	$playlist = new Playlist($con, $playlistId);
	$owner = new User($con, $playlist->getOwner());

?>
	
<div class="entityInfo">
	<div class="leftSection">
		<div class="gridViewImage">
			<img src="assets/images/icons/playlist.png" alt="playlist">
		</div>
	</div>
	<div class="rightSection">
		<h1><?php echo $playlist->getName(); ?></h1>
		<p><?php echo 'By ' . $playlist->getOwner(); ?></p>
		<p><?php echo $playlist->getNumberOfSongs() . " ". ngettext("Song", "Songs", $playlist->getNumberOfSongs()); ?></p>
		<button class="deleteButton" onclick="deletePlaylist(<?php echo $playlist->getId() ?>)">DELETE PLAYLIST</button>
	</div>
</div>

<div class="tracklistContainer">
	<ul class="tracklist">
		
		<?php

			$songIdArray = $playlist->getSongIds();

			$i = 1;

			foreach($songIdArray as $songId) {
				
				$playlistSong = new Song($con, $songId);
				$songArtist = $playlistSong->getArtist();

				echo "<li class='tracklistRow'>
						<div class='trackCount'>
							<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $playlistSong->getId() . "\", tempPlaylist, true)' alt='play'>
							<span class='trackNumber'>$i</span>
						</div>
						<div class='trackInfo'>
							<span class='trackName'>" . $playlistSong->getTitle() . "</span>
							<span class='trackArtist'>" . $songArtist->getName() . "</span>
						</div>
						<div class='trackOptions'>
							<input type='hidden' class='songId' value='". $playlistSong->getId() ."'> 
							<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)' alt='play'>
						</div>
						<div class='trackDuration'>
							<span class='duration'>" . $playlistSong->getDuration() . "</span>
						</div>
					  </li>";

				$i++;

			}
		?>
	<script>
		var tempSongIds = '<?php echo json_encode($songIdArray) ?>'; // Use single quote because of JSON need to return in string
		tempPlaylist = JSON.parse(tempSongIds);
	</script>
	</ul>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId"></input>
	<?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
	<div class="itemMenu" onclick="removeFromPlaylist(this, '<?php echo $playlistId ?>')">Remove from playlist</div>
</nav>


