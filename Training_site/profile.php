
<?php include 'config/header.php';
require_once('../sql_connector.php');?>

<?php
if (!isset($_SESSION['user'])){	//redirects to index page if user isn't a user
    header('location:index.php');
}
?>

<?php
	if(isset($_POST['submit'])) {	//doesn't do anything unless button is pressed
		$UID = $_SESSION['user'];
		$query = "select Email from user where UID = ?";
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("s",$UID);
		$stmt->execute();
		$stmt->bind_result($original_email);
		$stmt->fetch();
		
		
		$EmailError = False;
		$NameError = False;

		//makes sure name and email arent sql queries
		if (preg_match('%[A-Za-z0-9]+@+[A-Za-z0-9]+\.+[A-Za-z0-9]%', stripslashes(trim($_POST['email'])))) {
			$email = $mysqli->real_escape_string(trim($_POST['email']));
		}
		else {
			$EmailError = True;
		}

		if (preg_match('%^[a-zA-Z]+$%', stripslashes(trim($_POST['name'])))) {
			$name = $mysqli->real_escape_string(trim($_POST['name']));
		}
		else {
			$NameError = True;
		}
		if ($EmailError == False and $original_email == $email) {
			$query = "update user set Name=? where UID=?";
		}
		else {
			$query = "update user set Name=?, Email=? where UID=?";
		}
		$stmt->close();
		if ($EmailError == False and $NameError == False) { //updates info
			if ($original_email == $email) {
				$stmt = $mysqli->prepare($query);
				$stmt->bind_param("ss",$name,$UID);
			}
			else {
				$stmt = $mysqli->prepare($query);
				$stmt->bind_param("sss",$name,$email,$UID);
			}
			$stmt->execute();
			$results = $stmt->affected_rows;
			$stmt->close();
			if ($results == 1) {
				$_SESSION['name'] = $name;
				header("Refresh:0");
			}
			else if ($original_email != $email) {
				echo "Darn! that email is taken :( Try another!";
			}

		}
		else {
			echo "Could not update information as requested. Ensure email and name are entered correctly.";
		}
	}
?>


<html>		
<div class="container">
	<form  class= "form-horizontal"action="" method="post">
		<?php
			//Retrieves info from user table
			$UID = $_SESSION['user'];
			$query = "select Name, Email, level from user where UID = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$UID);
			$stmt->execute();
			$stmt->bind_result($name, $email, $level);
			$stmt->fetch();
			$stmt->close();			

			//Retrieves level information from level table
			$query = "select title from levels where id = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$level);
			$stmt->execute();
			$stmt->bind_result($rank);
			$stmt->fetch();
			$stmt->close();
		//	echo "level: ".$level."<br />";
		//	echo "rank: ".$rank."<br />";

			//Retrieves phone data from phone_list table
			
			$phone_number = "N/A";
/*			$query = "select phone_number from phone_list where user_id = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$UID);
			$stmt->execute();
			$stmt->bind_result($phone_number);
			$stmt->fetch();
			$stmt->close();
			//echo "Phone number: ".$phone_number."<br />";
*/		

//		echo "level: ".$level."<br />";
	
			$group_names = [];
			$group_ids = [];
			$number_of_groups = 0;
			//$sql1 = "SELECT * FROM group_members WHERE uid = ".$UID.";";
			$sql1 = "SELECT * FROM group_members INNER JOIN user ON uid WHERE uid = ".$UID.";";

			//echo "Sql: ".$sql1."<br />";
			//echo "Sql: ".$sql1."<br />";

			$result1 = $mysqli->query($sql1);
			if($result1->num_rows > 0)
			{
				$number_of_groups = $result1->num_rows;
				while($row = $result1->fetch_assoc())
				{	
					array_push($group_names, $row["id"]);
					array_push($group_ids, $row["id"]);
				}
			//	echo "groups: ".$result1->num_rows;
			}	
			//echo "Test <br />";
			
			//$rank = $level;
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Name</label>';
			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) {
				echo '<input type="name" name="name" size="30" value="'.$name.'" />';
			}
			else {
				echo $name;
			}
			echo '</div></div>';
			
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Email</label>';
			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) {
				echo '<input type="email" name="email" size="30" value="'.$email.'" />';
			}
			else {
				echo $email;
			}
			echo '</div></div>';
			
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Rank</label>';
			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) {
			//	echo '<input type="email" name="email" size="30" value="'.$email.'" />';
				echo $rank;			
			}
			else {
				echo $rank;
			}
			echo '</div></div>';
			
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Contact info</label>';
			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) {
			//	echo '<input type="email" name="email" size="30" value="'.$email.'" />';
				echo $phone_number;			
			}
			else {
				echo $phone_number;
			}
			echo '</div></div>';
		
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
	


			$stmt->close();
		?>

			<div id="inputbox" class="form-group">
				<div class="control-label col-sm-6" id="centertext">
					<?php
						if (isset($_POST['edit'])) {
							echo '<input class="btn btn-default" type="submit" name="submit" value="Save Information"/>';
						}
						else {
							echo '<input class="btn btn-default" type="submit" name="edit" value="Edit Profile"/>';
						}
					?>
				</div>
			</div>
		</div>
</form>

