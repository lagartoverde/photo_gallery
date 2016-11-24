<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template("header.php"); ?>
<h2> Photo Gallery</h2>
<?php

	$photos=Photograph::find_all();
	foreach ($photos as $photo) {
		echo "<div style=\"float:left; margin-left:20px\">";
		echo "<a href=\"photo.php?id=".$photo->id."\"><img src=".$photo->get_full_path()." width=\"200px\"/></a>";
		echo "<p style=\"text-align:center\">{$photo->caption}</p>";
		echo "</div>";
	}

?>
<?php include_layout_template("footer.php"); ?>