
<?php 
/**
For users logged in, this page presents information describing that user.
To do this it draws from the user, group_members, mail_address, and phone_list database tables. 
The features_loader function is called to load the group, phone number, and mailing address information. The features_loader function refers to the assigned_features function to see what version of this information to display, and then loads the appropriate php file within the "features" folder.
If an account does not have an assigned feature in the assigned_features table, the feature loader loads the default (that is, fully functional) version of that website feature. 
For example, note that the John Doe account is listed as belonging to both groups A and B on the Groups page. However, the View Profile page claims that John Doe does not belong to any groups. This is because, when the profile page calls the features_loader function to retrieve group information, it loads an erroneous version of the group retrieval code.
*/

include 'config/header.php';
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
			
	//Display name
			$query = "select Name, Email, level from user where UID = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$UID);
			$stmt->execute();
			$stmt->bind_result($name, $email, $level);
			$stmt->fetch();
			$stmt->close();	
			
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
	//Display Email		
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
			$query = "select title from levels where id = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$level);
			$stmt->execute();
			$stmt->bind_result($rank);
			$stmt->fetch();
			$stmt->close();

			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Rank</label>';
			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) {
				echo $rank;			
			}
			else {
				echo $rank;
			}
			echo '</div></div>';
			
	//Load group information
	
			feature_loader("groupdisplay", $_SESSION["user"]);

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

