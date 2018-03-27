<?php include('includes/includedFile.php') ?>

	<h1 class="mainTitleHeading">You Might Also Like</h1>
	<div class="gridViewContainer">
		<?php
			$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 5");

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