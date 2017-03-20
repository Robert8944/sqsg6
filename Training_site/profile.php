
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
			//displays info
			$UID = $_SESSION['user'];
			$query = "select Name, Email from user where UID = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$UID);
			$stmt->execute();
			$stmt->bind_result($name, $email);
			$stmt->fetch();
			
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

