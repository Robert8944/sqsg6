<?php 
session_start();
require_once('../../sql_connector.php');

			$UID = $_SESSION["user"];

			//Retrieve and display group information
			$group_names = [];
			$group_ids = [];
			$number_of_groups = 0;
			$sql1 = "SELECT * FROM group_members INNER JOIN groups ON group_members.group_id=groups.id WHERE group_members.uid=".$UID.";";
			$result1 = $mysqli->query($sql1);
			if($result1->num_rows > 0)
			{
				$number_of_groups = $result1->num_rows;
				while($row = $result1->fetch_assoc())
				{	
					array_push($group_names, $row["name"]);
				}
			}
		
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Groups you belong to</label>';

			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) 
			{
	//			echo "Groups you belong to";
				if($number_of_groups == 0)
				{
					echo "None";
				}
				foreach($group_names as $key => $val)
				{
					echo $val."<br />";
				}			
			
			}
			else {
	//			echo "Groups you belong to";
				if($number_of_groups == 0)
				{
					echo "None";
				}

				foreach($group_names as $key => $val)
				{
					echo $val."<br />";
				}	
			
			}
			echo '</div></div>';
		//	$stmt->close();
?>
