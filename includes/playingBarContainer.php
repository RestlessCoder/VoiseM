<?php
	$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

	$resultArray = array();

	while($row = mysqli_fetch_assoc($songQuery)) {
		array_push($resultArray, $row['id']);
	}

	$jsonArray = json_encode($resultArray);

?>

<script>	

	$(document).ready(function() {
		currentPlaylist = <?php echo $jsonArray ?>;
		audioElement = new Audio();
		setTrack(currentPlaylist[0], currentPlaylist, false);
	});

	function setTrack(trackId, newPlaylist, play) {
		audioElement.setTrack('assets/music/jaychou-whatkindofman.mp3');
		
		if(play) {
			audioElement.play();
		}
	}

	function playSong() {
		$('.controlButton.play').hide();
		$('.controlButton.pause').show();
		audioElement.play();
	}

	function pauseSong() {		
		$('.controlButton.play').show();
		$('.controlButton.pause').hide();
		console.log('click');
		audioElement.pause();
	}

</script>

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
					<button class="controlButton play" onclick="playSong()">
						<img src="assets/images/icons/play.png" alt="play">
					</button>
					<button class="controlButton pause" onclick="pauseSong()" style="display: none;">
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














