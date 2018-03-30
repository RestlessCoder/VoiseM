<?php include('includes/includedFile.php'); ?>

<div class="playlistContainer">
	<div class="gridViewPlaylistContainer">
		<h3>Playlists</h3>
		<button class="createButton" onclick="createNewPlaylist();">New Playlists</button>

		<?php

			$username = $userLoggedIn->getUsername();

			$playlistsQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");

			if(mysqli_num_rows($playlistsQuery) == 0) {
				echo "<button class='createButton' onclick='createNewPlaylist();'>Create Your First Playlist</button>";
			}

			// Output data of each row 			
			while($row = mysqli_fetch_assoc($playlistsQuery)) {

				$playlist = new Playlist($con, $row);

				echo  "<div class='gridViewPlaylistItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\");'>
							<div class='gridViewImage'>
								<img src='assets/images/icons/playlist.png' alt='playlist'>
							</div>
							<div class='gridViewInfo'>
								". $playlist->getName() . "
							</div>
					 	</div>";
			}
		?>
	</div>
</div>