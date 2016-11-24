<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
	redirect_to("login.php");
}
?>
<?php
	if(empty($_GET['id'])){
		$session->message("No photograph ID was provided.");
		redirect_to("photo_list.php");
	}
	$photo=Photograph::find_by_id($_GET['id']);
	if($photo && $photo->destroy()){
		$session->message("The photo {$photo->filename} was deleted.");
		redirect_to("photo_list.php");
	}else{
		$session->message("The photo couldn't be deleted.");
		redirect_to("photo_list.php");
	}
?>
<?php if(isset($database)){ $database->close_connection();} ?> 