<?php
require_once('../../sql_connector.php');
/*
This file processes administrator and superuser's requests to add users to groups. Rather than performing a single command with the use of joined tables, it adds users by performing three seperate SQL commands.

NOTE: if the user or the group entered does not actually exist, no error message is given. Nothing happens to the database when there is such a SQL error.
 */

$username = $_POST["username"];
$group_name = $_POST["group_name"];

$group_id = -1;
$uid = -1;

/*First fetch the primary key of the user who is to be added to the group.
The primary key needs to be fetched because the superuser or admin
identifies the user to add to a group by that user's email.
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

//Select the primary key of the group whose name the superuser or admin enters.
$sql2 = "SELECT id FROM groups where name=\"".$group_name."\";";
$result2 = $mysqli->query($sql2);
if($result2->num_rows > 0)
{
	while($row = $result2->fetch_assoc())
	{
		$group_id = $row["id"];
	}
}

//Finally, add a new (group_id, uid) pair to the list of group members.
$sql3 = "INSERT INTO group_members (group_id, uid) VALUES(".$group_id.", ".$uid.");";
$result3 = $mysqli->query($sql3);

echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['HTTP_REFERER']."\">";
?>
