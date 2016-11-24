<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template("header.php"); ?>
<h2> Photo Gallery</h2>
<?php

	//We have to figure out:
	//1. the current page number ($current_page)
	
	$page=!empty($_GET['page'])?(int)$_GET['page'] : 1;

	//2. records per page($per_page)

	$per_page=3;

	//3. total record count($total_count)
	$total_count=Photograph::count_all();

	//Using pagination instead
	//$photos=Photograph::find_all();

	$pagination=new Pagination($page, $per_page, $total_count);

	//instead of finding all records, just find the records for this page
	$sql="SELECT * FROM photographs";
	$sql.=" LIMIT {$per_page}";
	$sql.=" OFFSET {$pagination->offset()}";
	$photos=Photograph::find_by_sql($sql);

	//Need to add ?page=$page to all links we want to mantain the current page(or store $page in $session)


	foreach ($photos as $photo) {
		echo "<div style=\"float:left; margin-left:20px\">";
		echo "<a href=\"photo.php?id=".$photo->id."\"><img src=".$photo->get_full_path()." width=\"200px\"/></a>";
		echo "<p style=\"text-align:center\">{$photo->caption}</p>";
		echo "</div>";
	}

?>
<div id="pagination" style="clear:both;">
<?php
	if($pagination->total_pages()>1){
		if($pagination->has_previous_page()){
			echo "<a href=\"index.php?page=";
			echo $pagination->previous_page();
			echo "\">&laquo; Prev</a> ";
		}
		for($i=1; $i <= $pagination->total_pages(); $i++){
			if($i==$page){
				echo " <span class=\"selected\">{$i}</span>"; 
			}else{
				echo " <a href=\"index.php?page={$i}\">{$i}</a> ";
			}
		}
		if($pagination->has_next_page()){
			echo "<a href=\"index.php?page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a>";
		}
	}
?>
</div>
<?php include_layout_template("footer.php"); ?>