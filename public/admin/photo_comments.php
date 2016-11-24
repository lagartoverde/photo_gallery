<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
	redirect_to("login.php");
}
?>
<?php if(!isset($_GET['id'])){
	redirect_to("photo_list.php");
}else{
	$photo=Photograph::find_by_id($_GET['id']);
	$comments=$photo->comments();
}
?>
<?php include_layout_template('admin_header.php'); ?>


<h2> Photo: <?php echo $photo->caption; ?></h2>
<?php echo output_message($message); ?>
<img src="<?php echo $photo->get_full_path() ?>">
<br>
<a href="photo_list.php">&laquo; Back</a>
<br>
<br>
<div id="comments">
	<?php foreach($comments as $comment): ?>
		<div class="comment" style="margin-bottom: 2em;">
			<div class="auhor">
				<?php echo htmlentities($comment->author); ?> wrote:
			</div>
			<div class="body">
				<?php echo strip_tags($comment->body,"<strong><em><p>"); ?>
			</div>
			<div class="meta-info" style="font-size: 0.8em;">
				<?php echo datetime_to_text($comment->created); ?>
			</div>
			<br>
			<?php echo "<a href=\"delete_comments.php?id={$comment->id}\">Delete </a>"; ?>
		</div>
	<?php endforeach; ?>
	<?php if(empty($comments)){ echo "No comments.";} ?>
</div>


	

<?php include_layout_template('admin_footer.php'); ?>
