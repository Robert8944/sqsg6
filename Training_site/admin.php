<?php include 'config/header.php';
require_once('../sql_connector.php');
$features_loader_path =  $_SERVER["DOCUMENT_ROOT"].'/'.'/sqsg6/Training_site/features/features_loader.php';
require_once($features_loader_path);
?>

<?php
if (!isset($_SESSION['user'])){	//redirects to index page if user isn't logged in
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
		
		echo "<p>";
		echo "<form action=\"group_operations/add_to_group.php\">";
		echo "User: <input type=\"text\" name=\"username\" id=\"username\">";
		echo "<br />";
		echo "Group to add to: <input type=\"text\" name=\"group_name\" id=\"group_name\">";
		echo "<br />";
		echo "<input type=\"submit\" value=\"Add\">";
		echo "</form>";
		echo "</p>";

		echo "<p>";
		echo "<form action=\"group_operations/remove_from_group.php\">";
		echo "User: <input type=\"text\" name=\"username\" id=\"username\">";
		echo "<br />";
		echo "Group to remove from: <input type=\"text\" name=\"group_name\" id=\"group_name\">";
		echo "<br />";
		echo "<input type=\"submit\" value=\"Remove\">";
		echo "</form>";
		echo "</p>";

	}

	?>
</form>
