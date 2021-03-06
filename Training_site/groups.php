<?php
/*
This file displays the different groups that exist on the website, their leaders and their other members. It first displays a list of the groups on the website. Next, it lists the members for each of the groups. Members that have been labeled with "leader" by an administrative account (as performed on the Admin Page, "admin_user_info.php") are labeled with "leader" next to their names.
*/

include 'config/header.php';
require_once('../sql_connector.php');
require_once("../feature_connector.php");


?>

<?php
if (!isset($_SESSION['user'])){	//redirects to index page if user isn't a user
    header('location:index.php');
}
?>



<html>
<div class="container">
<form  class= "form-horizontal"action="" method="post">
	<?php
	//Display all groups
		$group_names = [];
		$group_ids = [];
		$sql1 = "SELECT * FROM groups;";
		$result1 = $mysqli->query($sql1);
		if($result1->num_rows > 0)
		{
			while($row = $result1->fetch_assoc())
			{

				array_push($group_names, $row["name"]);
				array_push($group_ids, $row["id"]);
			}
		}
		else
		{
			echo "<p> No groups could be found </p>";
		}
		echo '<div class="form-group">';
		echo '<label class="control-label col-sm-5" >Groups</label>';
		echo '<div class="col-sm-5">';
		foreach($group_names as $key => $value)
		{
			echo $value."<br />";
		}
		echo '</div></div>';
	//Display all members of each group
		echo '<div class="form-group">';
		echo '<label class="control-label col-sm-5" >Group members</label>';
		echo '<div class="col-sm-5">';

	foreach($group_ids as $key => $value)
		{
			$sql2 = "SELECT user.Name, user.Email, group_members.leader FROM user INNER JOIN group_members ON user.uid=group_members.uid WHERE group_members.group_id=".$value.";";
			echo "<u>".$group_names[$key]."</u><br />";
			$result2 = $mysqli->query($sql2);
			if($result2->num_rows > 0)
			{
				while($row = $result2->fetch_assoc())
				{
					$leader = $row["leader"];
					$leadership = "";
					if($leader == 1)
					{
						$leadership = "(leader)";
					}
					echo $row["Name"]." ".$leadership." -- ".$row["Email"]."<br />";

				}
			}
			else
			{
				echo "<p> No members in this group </p>";
			}
			echo "<br />";
		}
			echo "<br />";
			echo '</div></div>';

	?>
</form>
</div>
</html>
