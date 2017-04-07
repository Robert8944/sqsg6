
<?php include 'config/header.php';
require_once('../sql_connector.php');
require_once('../feature_connector.php');
?>

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
			$UID = $_SESSION['user'];
			//Retrieves info from user table
			
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
			
			
			//Retrieve group information
	/*
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
	*/
			//Display name
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
	
	//Display Rank		
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
			
	//Load group information
	
		feature_loader("groupdisplay", $_SESSION["user"]);

	/*
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
		//	$stmt->close(); //What is this closing?
	*/

	//Load phone information		
			feature_loader("phonedisplay", $_SESSION["user"]);

	//Load address information
			feature_loader("addressdisplay", $_SESSION["user"]);
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

