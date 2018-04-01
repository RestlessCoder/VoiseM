var currentPlaylist = [];
var shufflePlaylist = [];
var pagePlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

$(window).on("scroll", function() {
	hideOptionsMenu();
});

$(document).click(function(event) {
	var target = $(event.target);
	if(!target.hasClass('itemMenu') && !target.hasClass('optionsButton')) {
		hideOptionsMenu();
	}
});

$(document).on('change', 'select.playlist', function() {
	var select = $(this);
	var playlistId = select.val();
	var songId = select.prev(".songId").val();

	$.post("includes/handlers/ajax/addToPlaylist.php", { playlistId: playlistId, songId: songId })
	.done(function(error) {
		if(error != "") {
			alert(error);
			return;
		}
		// do something when ajax returns
		hideOptionsMenu();
		select.val("");
	});
});

function openPage(url) {
	if(url.indexOf('?') == -1) {
		url = url + '?';
	}

	var encodedUrl = encodeURI(url + '&userLoggedIn=' + userLoggedIn);
	$('#mainContent').load(encodedUrl);
	$('body').scrollTop(0);
	history.pushState(null, null, url); // Create an illusion that its changing URL but its not (manipulate the URL) because of AJAX
}

function showOptionsMenu(button) {
	var songId = $(button).prevAll('.songId').val();
	var menu = $('.optionsMenu');
	var menuWidth = menu.width();
	menu.find('.songId').val(songId);

	var scrollTop = $(window).scrollTop(); // Distance from top of window to the top of document
	var elementOffSet = $(button).offset().top; // Distance from top of the document

	var top = elementOffSet - scrollTop; 
	var left = $(button).position().left;

	menu.css({ "top": + top + "px", "left": + left - menuWidth + "px", "display": "inline" });
}

function hideOptionsMenu() {
	var menu = $('.optionsMenu');	
	if(menu.css("display") != "none") {
		menu.css("display", "none");
	}
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

function removeFromPlaylist(button, playlistId) {
	var songId = $(button).prevAll(".songId").val();

	$.post("includes/handlers/ajax/removeFromPlaylist.php", { playlistId: playlistId, songId: songId })
	.done(function(error) {
		if(error != "") {
			alert(error);
			return;
		}
		// do something when ajax returns
		openPage('playlist.php?id=' + playlistId);
	});
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