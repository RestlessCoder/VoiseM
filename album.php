<?php include('includes/includedFile.php');
	
	if(isset($_GET['id'])) {
		$albumId = $_GET['id'];
	}else {
		header('Location: index.php');
	}

	$album = new Album($con, $albumId);
	$artist = $album->getArtist();

?>
	
	<div class="entityInfo">
		<div class="leftSection">
			<img src="<?php echo $album->getArtworkPath(); ?>" alt="<?php echo $album->getTitle(); ?>">
		</div>
		<div class="rightSection">
			<h1><?php echo $album->getTitle(); ?></h1>
			<p><?php echo 'By ' . $artist->getName(); ?></p>
			<p><?php echo $album->getNumberOfSongs() . " ". ngettext("Song", "Songs", $album->getNumberOfSongs()); ?></p>
		</div>
	</div>

	<div class="tracklistContainer">
		<ul class="tracklist">
			
			<?php

				$songIdArray = $album->getSongIds();

				$i = 1;

				foreach($songIdArray as $songId) {
					
					$albumSong = new Song($con, $songId);
					$albumArtist = $albumSong->getArtist();

					echo "<li class='tracklistRow'>
							<div class='trackCount'>
								<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)' alt='play'>
								<span class='trackNumber'>$i</span>
							</div>
							<div class='trackInfo'>
								<span class='trackName'>" . $albumSong->getTitle() . "</span>
								<span class='trackArtist'>" . $albumArtist->getName() . "</span>
							</div>
							<div class='trackOptions'>
								<input type='hidden' class='songId' value='". $albumSong->getId() ."'> 
								<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)' alt='play'>
							</div>
							<div class='trackDuration'>
								<span class='duration'>" . $albumSong->getDuration() . "</span>
							</div>
						  </li>";

					$i++;

				}
			?>

			<script>
				var tempSongIds = '<?php echo json_encode($songIdArray) ?>'; // Use single quote because of JSON need to return in string
				tempPlaylist = JSON.parse(tempSongIds);
			</script>

		</div>
	</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId"></input>
	<?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>


