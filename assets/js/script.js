var currentPlaylist = [];
var shufflePlaylist = [];
var pagePlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

function openPage(url) {
	if(url.indexOf('?') == -1) {
		url = url + '?';
	}

	var encodedUrl = encodeURI(url + '&userLoggedIn=' + userLoggedIn);
	$('#mainContent').load(encodedUrl);
	$('body').scrollTop(0);
	history.pushState(null, null, url); // Create an illusion that its changing URL but its not (manipulate the URL) because of AJAX
}

function createNewPlaylist() {
	//console.log(userLoggedIn); Come from global variable
	var popup = prompt("Please enter the name of your playlist");

	if(popup != null) {
		$.post("includes/handlers/ajax/createPlaylist.php", { name: popup, username: userLoggedIn })
		.done(function(error) {
			if(error != "") {
				alert(error);
				return;
			}
			// do something when ajax returns
			openPage('yourMusic.php');
		});
	}
}

function deletePlaylist(playlistId) {
	var prompt = confirm('Are you sure want to delete this playlist?');

	if(prompt) {
		$.post("includes/handlers/ajax/deletePlaylist.php", { playlistId: playlistId })
		.done(function(error) {
			if(error != "") {
				alert(error);
				return;
			}
			// do something when ajax returns
			openPage('yourMusic.php');
		});
	}
}

function formatTime(seconds) {
	var time = Math.round(seconds);
	var minutes = Math.floor(time / 60);
	var seconds = time - (minutes * 60);

	var extraZero = (seconds < 10) ? "0" : "";

	return minutes + ':' + extraZero + seconds;
}


function upgradeTimeProgressBar(audio) {
	var progressDuration = formatTime(audio.currentTime);
	var remainingDuration = formatTime(audio.duration - audio.currentTime);
	$('.progressTime.current').text(progressDuration);
	$('.progressTime.remaining').text(remainingDuration);

	var progress = (audio.currentTime / audio.duration) * 100;
	$('.playingProgressBar .progress').css('width', progress + '%');
}

function volumeChangeProgressBar(audio) {
	var progress = audio.volume * 100;
	$('.volumeBar .progress').css('width', progress + '%');
}

function playArtistFirstSong() {
	setTrack(tempPlaylist[0], tempPlaylist, true);
}

function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio');

	this.audio.addEventListener('ended', function() {
		nextSong();
	});

	this.audio.addEventListener('canplay', function() {
		var duration = formatTime(this.duration)
		$('.progressTime.remaining').text(duration);
	});

	this.audio.addEventListener('timeupdate', function() {
		if(this.duration) {
			upgradeTimeProgressBar(this);
		}
	});

	this.audio.addEventListener('volumechange', function() {
		volumeChangeProgressBar(this);
	});

	this.setTrack = function(track) {
		this.currentlyPlaying = track;
		this.audio.src = track.path;
	}

	this.play = function() {
		this.audio.play();
	}

	this.pause = function() {
		this.audio.pause();
	}

	this.setTime = function(seconds) {
		this.audio.currentTime = seconds;
	}

}