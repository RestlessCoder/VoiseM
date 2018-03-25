var currentPlaylist = [];
var shufflePlaylist = [];
var pagePlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;

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