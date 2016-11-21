<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
	redirect_to("login.php");
}
?>
<?php if((isset($_GET['clear']))&&($_GET['clear']=="true")){
	$file=SITE_ROOT.DS."logs".DS."log.txt";
	if(file_exists($file)){
		unlink($file);
		log_action("clear","the log file was cleared");
		redirect_to("logfile.php");
	}
	
}

?>
<?php include_layout_template('admin_header.php'); ?>
		<h2>LogFile</h2>
		<?php
			$file=SITE_ROOT.DS."logs".DS."log.txt";
			if(file_exists($file)&&is_readable($file)){
				echo "<p>";
				$content=file_get_contents($file);
				echo nl2br($content);
				echo "</p>";
			}else{
				echo "The log file is empty";
			}

		?>
		<br>
		<a href="logfile.php?clear=true";>Clear log file</a>


<?php include_layout_template('admin_footer.php'); ?>