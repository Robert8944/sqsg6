<?php 
session_start();
require_once('../../sql_connector.php');

	$UID = $_SESSION["user"];
	
	//Load address information

			$state = "N/A";
			$city = "N/A";
			$zip = "N/A";
			$state = "N/A";
			$street_num = "N/A";
			$street = "N/A";
	
			$query = "select state, city, zip, street, street_num from mail_address where user_id = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$UID);
			$stmt->execute();
			$stmt->bind_result($state, $city, $zip, $street, $street_num);
			$stmt->fetch();
			$stmt->close();			



			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Mail address</label>';
			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) {
			//	echo '<input type="email" name="email" size="30" value="'.$email.'" />';
				echo $street_num;
				echo " ";
				echo $street;
				echo "<br />";
				echo $city;
				echo ", ";
				echo $state;
				echo " ";
				echo $zip;
	
			}
			else {
				echo $street_num;
				echo " ";
				echo $street;
				echo "<br />";
				echo $city;
				echo ", ";
				echo $state;
				echo " ";
				echo $zip;
			}
			echo '</div></div>';
	
?>
