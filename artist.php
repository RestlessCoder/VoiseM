<?php include('includes/includedFile.php'); 

	if(isset($_GET['id'])) {
		$artistId = $_GET['id'];
	}else {
		header('Location: index.php');
	}

	$artist = new Artist($con, $artistId);

?>

<div class="entityInfo"> 
	<div class="centerSection borderBottom">
		<div class="artistInfo">
			<h1 class="artistName"><?php echo $artist->getName() ?></h1>
			<button class='playButton' onclick="playArtistFirstSong()">Play</button>
		</div>	
	</div>
	<div class="tracklistContainer borderBottom">
		<h2>Songs</h2>
		<ul class="tracklist">
			
			<?php

				$songIdArray = $artist->getSongIds();

				$i = 1;

				foreach($songIdArray as $songId) {
					
					$albumSong = new Song($con, $songId);

					echo "<li class='tracklistRow'>
							<div class='trackCount'>
								<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)' alt='play'>
								<span class='trackNumber'>$i</span>
							</div>
							<div class='trackInfo'>
								<span class='trackName'>" . $albumSong->getTitle() . "</span>
								<span class='trackArtist'>" . $artist->getName() . "</span>
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
		</ul>
	</div>
	<div class="gridViewContainer left-align">
		<h2>Albums</h2>
		<?php
			$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistId'");

			// Output data of each row 			
			while($row = mysqli_fetch_assoc($albumQuery)) {
				echo  "<div class='gridViewItem'>
							<span role='link' tabindex='0' onclick=openPage('album.php?id=" . $row['id']. "')>
							 	<img src='" . $row['artworkPath'] ."'>
							 	<div class='gridViewInfo'>
							 		" . $row['title'] . " 
						 		</div>
					 		</span>
					 	</div>";
			}
		?>
	</div>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId"></input>
	<?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>