<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template("header.php"); ?>
<?php



if(isset($database)){ echo "true"; }else{ echo "false"; }
echo "<br>";

echo "Is this working?";
echo "<br>";

//$sql = "INSERT INTO users (id,username,password,first_name,last_name) VALUES (1,'oscar','1234','oscar','rodriguez') ";
//$result=$database->query($sql);

echo "<br>";

$sql="SELECT * FROM users WHERE id=1";
$result_set=$database->query($sql);
$found_user=$database->fetch_array($result_set);
echo $found_user['username'];

echo "<br><br><hr><br>";

$user=User::find_by_id(1);
echo $user->full_name();

echo "<br><br><hr><br>";

$users=User::find_all();
foreach ($users as $user) {
	echo "User: {$user->username}<br>";
	echo "Full Name: {$user->full_name()}<br><br>";
}

log_action("login","kskoglund logged in.");

?>
<?php include_layout_template("footer.php"); ?>