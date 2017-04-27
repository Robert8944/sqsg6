<?php
require_once('../../sql_connector.php');
/*
This file processes an administrator's request to demote a group leader back to mere group member.

NOTE: if the user or the group entered does not actually exist, no error message is given. Nothing happens to the database when there is such a SQL error.
*/

$username = $_POST["username"];
$group_name = $_POST["group_name"];

$group_id = -1;
$uid = -1;
/*
First fetch the primary key of the user who is to be removed from the group.
The primary key needs to be fetched because the admin identifies the 
user to remove from the group by that user's email.
*/
$sql1 = "SELECT UID FROM user WHERE Email=\"".$username."\";";
$result1 = $mysqli->query($sql1);
if($result1->num_rows > 0)
{
	while($row = $result1->fetch_assoc())
	{
		$uid = $row["UID"];
	}
}

//Next, select the primary key of the group whose name the admin enters.
$sql2 = "SELECT id FROM groups where name=\"".$group_name."\";";
$result2 = $mysqli->query($sql2);
if($result2->num_rows > 0)
{
	while($row = $result2->fetch_assoc())
	{
		$group_id = $row["id"];
	}
}

//Finally, demote the account from its leadership position.
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
//If the user is not part of the group, no need to demote. Do nothing

}
else
{
//Otherwise, demote the user
$sql4 = "UPDATE group_members SET leader=0 WHERE group_id=".$group_id." AND uid=".$uid.";";
$result4 = $mysqli->query($sql4);
}
echo "<meta http-equiv=\"refresh\" content=\"0; url=../admin_user_info.php\">";

?>
