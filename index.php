<?php include('includes/header.php'); ?>

	<h1 class="mainTitleHeading">You Might Also Like</h1>
	<div class="gridViewContainer">
		<?php
			$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 5");

			// Output data of each row 			
			while($row = mysqli_fetch_assoc($albumQuery)) {
				echo  "<div class='gridViewItem'>
							<a href='album.php?id=" . $row['id']. "'>
							 	<img src='" . $row['artworkPath'] ."'>
							 	<div class='gridViewInfo'>
							 		" . $row['title'] . " 
						 	</div>
					 		</a>
					 	</div>";
			}
		?>
	</div><!-- End of grid view Container -->
				
<?php include('includes/footer.php'); ?>
