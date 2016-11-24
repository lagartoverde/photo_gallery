<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
	redirect_to("login.php");
}
?>
<?php
	$photos=Photograph::find_all();
?>
<?php include_layout_template('admin_header.php'); ?>

	<h2>Photo List</h2>
	<?php echo output_message($message); ?>

	<?php

		echo "<table style=\"border: 1px solid black \">";
		echo "<tr>";

			echo "<th style=\"border: 1px solid black; padding:20px \"> Name </td>";
			echo "<th style=\"border: 1px solid black; padding:20px \"> Preview </td>";
			echo "<th style=\"border: 1px solid black; padding:20px \"> Type </td>";
			echo "<th style=\"border: 1px solid black; padding:20px \"> Size </td>";
			echo "<th style=\"border: 1px solid black; padding:20px \"> Caption </td>";
			echo "<th style=\"border: 1px solid black; padding:20px \"> &nbsp </td>";
			echo "<th style=\"border: 1px solid black; padding:20px \"> &nbsp </td>";

 
		echo "</tr>";
		foreach ($photos as $photo) {
			echo "<tr>";

			echo "<td style=\"border: 1px solid black; vertical-align:middle; padding:20px\">".$photo->filename."</td>";
			echo "<td style=\"border: 1px solid black; vertical-align:middle; padding:20px \"><img src=".$photo->get_full_path()." style=\"width: 300px;\" /></td>";
			echo "<td style=\"border: 1px solid black; vertical-align:middle; padding:20px \">".$photo->type."</td>";
			echo "<td style=\"border: 1px solid black; vertical-align:middle; padding:20px \">".$photo->get_size()."</td>";
			echo "<td style=\"border: 1px solid black; vertical-align:middle; padding:20px \">".$photo->caption."</td>";
			echo "<td style=\"border: 1px solid black; vertical-align:middle; padding:20px \"><a href=\"photo_comments.php?id=".$photo->id."\">Comments</td>";
			echo "<td style=\"border: 1px solid black; vertical-align:middle; padding:20px \"><a href=\"delete_photo.php?id=".$photo->id."\">Delete</td>";


			echo "</tr>";
		}
		echo "</table>"

	?>
	<br>
	<a href="photo_upload.php">Upload a new photograph</a>

	

<?php include_layout_template('admin_footer.php'); ?>
