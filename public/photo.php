<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template("header.php"); ?>
<?php if(!isset($_GET['id'])){
	redirect_to("index.php");
}else{
	$photo=Photograph::find_by_id($_GET['id']);
}
?>
<?php
	if(isset($_POST['submit'])){
		$author=trim($_POST['author']);
		$body=trim($_POST['body']);
		$new_comment=Comment::make($photo->id,$author,$body);
		if($new_comment&&$new_comment->save()){

			//Send email.
			$new_comment->send_notification();

			redirect_to("photo.php?id={$photo->id}");
		}else{
			$message="There was an error that prevented the comment from being saved.";
		}
	}else{
		$author="";
		$body="";
	}
	$comments= $photo->comments();
?>
<h2> Photo: <?php echo $photo->caption; ?></h2>
<img src="<?php echo $photo->get_full_path() ?>">
<br>
<a href="index.php">&laquo; Back</a>
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
		</div>
	<?php endforeach; ?>
	<?php if(empty($comments)){ echo "No comments.";} ?>
</div>


<div id="comment-form">
	<h3>New Comment</h3>
	<?php echo output_message($message); ?>
	<form action="photo.php?id=<?php echo $photo->id; ?>" method="POST">
		<table>
			<tr>
				<td>Your name: </td>
				<td><input type="text" name="author" value="<?php echo $author; ?>"/></td>
			</tr>
			<tr>
				<td>Your comment:</td>
				<td><textarea name="body" cols="40" rows="8"><?php echo $body ?></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit Comment"/></td>
			</tr>
		</table>
	</form>
</div>

<?php include_layout_template("footer.php"); ?>