<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
	redirect_to("login.php");
}
?>
<?php include_layout_template('admin_header.php'); ?>

<?php
	$user=new User();
	$user->username="johnsmith";
	$user->password="abcd12345";
	$user->first_name="John";
	$user->last_name="Smith";
	$user->save();

	// $user=User::find_by_id(4);
	// $user->password="1234wxyz";
	// $user->save();

	// $user=User::find_by_id(4);
	// $user->delete();
?>

<?php include_layout_template('admin_footer.php'); ?>
