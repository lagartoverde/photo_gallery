<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template("header.php"); ?>
<?php if(!isset($_GET['id'])){
	redirect_to("index.php");
}else{
	$photo=Photograph::find_by_id($_GET['id']);
}
?>
<h2> Photo: <?php echo $photo->caption; ?></h2>
<img src="<?php echo $photo->get_full_path() ?>">
<br>
<a href="index.php">&laquo; Back</a>
<br>
<?php include_layout_template("footer.php"); ?>