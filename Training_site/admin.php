<?php include 'config/header.php';
require_once('../sql_connector.php');
$features_loader_path =  $_SERVER["DOCUMENT_ROOT"].'/'.'/sqsg6/Training_site/features/features_loader.php';
require_once($features_loader_path);
?>

<?php
if (!isset($_SESSION['user'])){	//redirects to index page if user isn't a user
    header('location:index.php');
}
?>

<?php
feature_loader("test", $_SESSION["user"]);
?>


<html>		
<form  class= "form-horizontal"action="" method="post">
	<?php
	//Determine admin privileges
		$uid = $_SESSION["user"];
		$level = 0;
		$sql = "SELECT * FROM user WHERE UID=".$uid.";";
		$result = $mysqli->query($sql);
		echo "uid: ".$uid." ";
		echo "num rows: ".$result->num_rows." ";
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$level = $row["level"];	
			}
		}	
		//echo " level: ".$level." ";
	if($level < 5)
	{
		echo "Sorry, you do not have administrative privileges.";
	}
	else
	{
		echo "Welcome, admin!";
	}
	/*
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
*/
/*		
		$name = "Default name";
		$email = "Default email";

	// Display name
		echo '<div class="form-group">';
		echo '<label class="control-label col-sm-5" >Name</label>';
		echo '<div class="col-sm-5">';
		echo $name;
		echo '</div></div>';
	// Display email	
		echo '<div class="form-group">';
		echo '<label class="control-label col-sm-5" >Email</label>';
		echo '<div class="col-sm-5">';
		echo $email;
		echo '</div></div>';
*/
	?>
</form>
