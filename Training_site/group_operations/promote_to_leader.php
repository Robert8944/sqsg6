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
//Check if the account belongs to the group
$sql3 = "SELECT * FROM group_members WHERE group_id=".$group_id." AND uid=".$uid.";";
$result3 = $mysqli->query($sql3);
//If the account does not belong to the group, add the user before promoting
$belongsToGroup = False;
if($result3->num_rows > 0)
{
	$belongsToGroup = True;
}
if($belongsToGroup == False)
{
$sql4 = "INSERT INTO group_members (group_id, leader, uid) VALUES(".$group_id.",1, ".$uid.");";
echo "sql4: ".$sql4."<br />";
$result4 = $mysqli->query($sql4);
}
else
{
//Otherwise, simply promote the user
$sql4 = "UPDATE group_members SET leader=1 WHERE group_id=".$group_id." AND uid=".$uid.";";
echo "sql4: ".$sql4."<br />";
$result4 = $mysqli->query($sql4);
}
//echo "group_name: ".$group_name."<br />";
//echo "username: ".$username."<br />";
//echo "group_id: ".$group_id."<br />";
//echo "uid: ".$uid."<br />";

echo "<meta http-equiv=\"refresh\" content=\"0; url=../admin_user_info.php\">";
?>
