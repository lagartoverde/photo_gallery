<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
	redirect_to("login.php");
}
?>
<?php
	if(empty($_GET['id'])){
		$session->message("No comment ID was provided.");
		$url="photo_comments.php?id=".$comment->photograph_id;
		redirect_to($url);
	}
	$comment=Comment::find_by_id($_GET['id']);
	if($comment && $comment->delete()){
		$session->message("The comment was deleted.");
		$url="photo_comments.php?id=".$comment->photograph_id;
		redirect_to($url);
	}else{
		$session->message("The comment couldn't be deleted.");
		$url="photo_comments.php?id=".$comment->photograph_id;
		redirect_to($url);
	}
?>
<?php if(isset($database)){ $database->close_connection();} ?> 