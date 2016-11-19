<?php

require_once("../includes/database.php");
require_once("../includes/user.php");

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

$found_user=User::find_by_id(1);
echo $found_user['username'];

echo "<br><br><hr><br>";

$user_set=User::find_all();
while ($user=$database->fetch_array($user_set)){
	echo "User: ".$user['username']."<br>";
	echo "Name: ".$user['first_name']."<br><br>";
}

?>