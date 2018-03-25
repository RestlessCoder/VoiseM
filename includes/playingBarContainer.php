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
		var newPlaylist = <?php echo $jsonArray ?>;
		audioElement = new Audio();
		setTrack(newPlaylist[0], newPlaylist, false);
		volumeChangeProgressBar(audioElement.audio);

/*		$('#playingBarContainer').on('mousedown touchstart mousemove touchmove', function(e) {
			e.preventDefault();
		});*/

		// Progress Bar
		$('.playingProgressBar .progressBar').mousedown(function(){
			mouseDown = true;
		});

		$('.playingProgressBar .progressBar').mousemove(function(e){
			if(mouseDown) {
				// Set the time of song depending on the position
				timeFromOffset(e, this);
			}
		});

		$('.playingProgressBar .progressBar').mouseup(function(e){
			if(mouseDown) {
				// Set the time of song depending on the position
				timeFromOffset(e, this);
			} 
		});

		// Volume Bar
		$('.volumeBar .progressBar').mousedown(function(){
			mouseDown = true;
		});

		$('.volumeBar .progressBar').mousemove(function(e){
			if(mouseDown) {
				var percentage = (e.offsetX / $(this).width());

				console.log(percentage);

				if(percentage >= 0 && percentage <= 1) {

					audioElement.audio.volume = percentage;
				}
			}
		});

		$('.volumeBar .progressBar').mouseup(function(e){
			if(mouseDown) {
				var percentage = (e.offsetX / $(this).width());
				if(percentage >= 0 && percentage <= 1) {
					audioElement.audio.volume = percentage;
				}
			} 
		});
		
		// Set the mouseDown to false whenever you let the mouse up in the whole document 
		// instead of just the playingProgressBar HTML class
		$(document).mouseup(function() {
			mouseDown = false;
		});
	});

	function timeFromOffset(mouse, progressBar) {
		var percentage = (mouse.offsetX / $(progressBar).width()) * 100;
		var seconds = audioElement.audio.duration * (percentage / 100);
		audioElement.setTime(seconds);	
	}

	function previousSong() {
		if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
			audioElement.setTime(0);
		} else {
			currentIndex++;
			setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
		}
	}

	function nextSong() {
		console.log(currentIndex);
		if(repeat == true) {
			audioElement.setTime(0);
			playSong();
			return;
		}

		if(currentIndex == currentPlaylist.length - 1) {
			currentIndex = 0;
		}else {
			currentIndex++;
		}

		var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
		setTrack(trackToPlay, currentPlaylist, true);
		console.log(currentIndex);
	}

	function setRepeat() {
		repeat ? repeat = false : repeat = true;
		var imageName = repeat ? "repeat-active.png" : "repeat.png";
		$('.controlButton.repeat img').attr('src', 'assets/images/icons/' + imageName);

	}

	function setMute() {
		audioElement.audio.muted ? audioElement.audio.muted = false : audioElement.audio.muted = true;
		var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
		$('.controlButton.volume img').attr('src', 'assets/images/icons/' + imageName);

	}

	function setShuffle() {
		shuffle ? shuffle = false : shuffle = true;
		var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
		$('.controlButton.shuffle img').attr('src', 'assets/images/icons/' + imageName);

		console.log(shufflePlaylist);
		console.log(currentPlaylist);

		if(shuffle == true) {
			// Randomize playlists
			shuffleArray(shufflePlaylist);
			currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
			console.log(currentIndex);
		} else {
			// shuffle has been deactivate
			// go back to normal playlist
			currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
			console.log(currentIndex);
		}
	}

	/**
	 * Shuffles array in place.
	 * @param {Array} a items An array containing the items.
	 */
	function shuffleArray(playList) {
	    var j, x, i;
	    for (i = playList.length - 1; i > 0; i--) {
	        j = Math.floor(Math.random() * (i + 1));
	        x = playList[i];
	        playList[i] = playList[j];
	       	playList[j] = x;
	    }
	}

	function setTrack(trackId, newPlaylist, play) {

		if(newPlaylist != currentPlaylist) {
			currentPlaylist = newPlaylist;
			shufflePlaylist = currentPlaylist.slice();
			shuffleArray(shufflePlaylist);
		}

		pauseSong();

		if(shuffle == true) {
			currentIndex = shufflePlaylist.indexOf(trackId);
		} else {
			currentIndex = currentPlaylist.indexOf(trackId);
		}

		$.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

			var track = JSON.parse(data);
			$('.trackName span').text(track.title);
			
			$.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
				var artist = JSON.parse(data);

				$('.artistName span').text(artist.name);
			});

			$.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
				var album = JSON.parse(data);

				$('.albumArtwork img').attr('src', album.artworkPath);
			});

			audioElement.setTrack(track);
			playSong();
		});
		
		if(play) {
			audioElement.play();
		}
	}

	function playSong() {

		if(audioElement.audio.currentTime == 0) {
			$.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
		} 

		$('.controlButton.play').hide();
		$('.controlButton.pause').show();
		audioElement.play();
	}

	function pauseSong() {		
		$('.controlButton.play').show();
		$('.controlButton.pause').hide();
		audioElement.pause();
	}

</script>

<div id="playingBarContainer">
	<div id="playingBar">
		<div id="playingBarLeft">
			<div class="content">
				<div class="albumArtwork">
					<img src="" alt="smiley">
				</div>
				<div class="trackInfo">
					<span class="trackName">
						<span></span>
					</span>
					<span class="artistName">
						<span></span>
					</span>
				</div>
			</div>
		</div>
		<div id="playingBarCenter">
			<div id="playingBarControls">
				<div class="buttons">
					<button class="controlButton shuffle" onclick="setShuffle();">
						<img src="assets/images/icons/shuffle.png" alt="shuffle">
					</button>
					<button class="controlButton previous" onclick="previousSong()">
						<img src="assets/images/icons/previous.png" alt="previous">
					</button>
					<button class="controlButton play" onclick="playSong()">
						<img src="assets/images/icons/play.png" alt="play">
					</button>
					<button class="controlButton pause" onclick="pauseSong()" style="display: none;">
						<img src="assets/images/icons/pause.png" alt="pause">
					</button>
					<button class="controlButton next" onclick="nextSong()">
						<img src="assets/images/icons/next.png" alt="next">
					</button>
						<button class="controlButton repeat" onclick="setRepeat()">
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
				<button class="controlButton volume" onclick="setMute()">
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














