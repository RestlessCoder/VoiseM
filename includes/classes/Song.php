<?php
	
	class Song {

		private $id;
		private $con;
		private $mysqliData;
		private $title;
		private $artistId;
		private $albumId;
		private $genre;
		private $duration;
		private $songPath;

		public function __construct($con, $id) {
			$this->id = $id;
			$this->con = $con;

			$query = mysqli_query($this->con, "SELECT * FROM songs WHERE id='$this->id'");
			$this->mysqliData = mysqli_fetch_assoc($query);
			$this->title = $this->mysqliData['title'];
			$this->artistId = $this->mysqliData['artist'];
			$this->albumId = $this->mysqliData['album'];
			$this->genreId = $this->mysqliData['genre'];
			$this->duration = $this->mysqliData['duration'];
			$this->songPath = $this->mysqliData['path'];
		}

		public function getTitle() {
			return $this->title;
		}

		public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}

		public function getAlbum() {
			return new Album($this->con, $this->albumId);
		}

		public function getSongPath() {
			return $this->songPath;
		}

		public function getDuration() {
			return $this->duration;
		}

		public function getGenre() {
			return $this->genre;
		}

	}

?>