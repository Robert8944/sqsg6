<?php
require_once('../../sql_connector.php');


$username = $_POST["username"];
$group_name = $_POST["group_name"];

$group_id = -1;
$uid = -1;

$sql1 = "SELECT UID FROM user WHERE Email=\"".$username."\";";
//echo "sql1: ".$sql1."<br />";
$result1 = $mysqli->query($sql1);
if($result1->num_rows > 0)
{
	while($row = $result1->fetch_assoc())
	{
		$uid = $row["UID"];
	}
}

$sql2 = "SELECT id FROM groups where name=\"".$group_name."\";";
//echo "sql2: ".$sql2."<br />";
$result2 = $mysqli->query($sql2);
if($result2->num_rows > 0)
{
	while($row = $result2->fetch_assoc())
	{
		$group_id = $row["id"];
	}
}
$sql3 = "INSERT INTO group_members (group_id, uid) VALUES(".$group_id.", ".$uid.");";
$result3 = $mysqli->query($sql3);

//echo "group_name: ".$group_name."<br />";
//echo "username: ".$username."<br />";
//echo "group_id: ".$group_id."<br />";
//echo "uid: ".$uid."<br />";

echo "<meta http-equiv=\"refresh\" content=\"0; url=../admin_user_info.php\">";
?>
