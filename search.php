<?php include('includes/includedFile.php'); 

	if(isset($_GET['term'])) {
		$term = urldecode($_GET['term']);
	} else {
		$term = "";
	}
	
?>

<div class="searchContainer">
	<h4>Search for an artist, song, album or playlist</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Type here....." onfocus="var val=this.value; this.value=''; this.value= val;"></input>
</div><!-- End of search container -->

<script>
$('.searchInput').focus();

$(function() {
	var timer;

	$('.searchInput').keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $('.searchInput').val();
			openPage('search.php?term=' + val);
		}, 1000);
		
	})
})
</script>

<?php if($term == "") exit(); ?>

<div class="tracklistContainer borderBottom">
	<h2>Songs</h2>
	<ul class="tracklist">
		
		<?php

			$songQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");

			if(mysqli_num_rows($songQuery) == 0) {
				echo "<span class='noResults'>No result of song found " . $term . "</span>";
			}

			$songIdArray = array();

			$i = 1;

			while($row = mysqli_fetch_assoc($songQuery)) {
				
				if($i > 15) {
					break;
				}
				array_push($songIdArray, $row['id']);

				$albumSong = new Song($con, $row['id']);
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
							<img class='optionsButton' src='assets/images/icons/more.png' alt='play'>
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
</div><!-- End of song container -->

<div class="artistContainer borderBottom">
	<h2>Artist</h2>
	<?php

		$artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($artistQuery) == 0) {
			echo "<span class='noResults'>No result of artist found " . $term . "</span>";
		}

		$artistIdArray = array();

		while($row = mysqli_fetch_assoc($artistQuery)) {
			$artistFound = new Artist($con, $row['id']);

			echo "<div class='searchResultArtist'>
					<div class='artistName'>
						<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() . "\")'>"
							. $artistFound->getName() ."</span>
					</div>
				  </div>";

		}
	?>
</div><!-- End of artist container -->
<div class="gridViewContainer">
	<h2>Albums</h2>
	<?php

		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No result of albums found " . $term . "</span>";
		}

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
</div><!-- End of grid view Container -->