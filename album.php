<?php include('includes/header.php'); 
	
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

<?php include('includes/footer.php'); ?>