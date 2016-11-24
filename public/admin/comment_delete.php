<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
	redirect_to("login.php");
}
?>
<?php
	if(empty($_GET['id'])){
		$session->message("No photograph ID was provided.");
		redirect_to("photo_comments.php?id=".$comment->photograph->id);
	}
	$comment=Comment::find_by_id($_GET['id']);
	if($comment && $comment->delete()){
		$session->message("The photo {$photo->filename} was deleted.");
		redirect_to("photo_comments.php?id=".$comment->photograph->id);
	}else{
		$session->message("The photo couldn't be deleted.");
		redirect_to("photo_comments.php?id=".$comment->photograph->id);
	}
?>
<?php if(isset($database)){ $database->close_connection();} ?> 