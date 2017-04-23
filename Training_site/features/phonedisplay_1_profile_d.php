<?php
session_start();
require_once('/var/www/html/sqsg6/sql_connector.php');

		//	echo "<b>Phone display loaded.</b>";
			//Retrieve phone information
			$phone_numbers = [];
			$group_ids = [];
			$number_of_phones = 0;
		

			$UID = $_SESSION["user"];
	/*		$sql1 = "SELECT * FROM phone_list WHERE user_id=".$UID.";";
		//	echo "<p>UID: ".$UID."</p>";
			$result1 = $mysqli->query($sql1);
		//	echo "<p> Num rows:".$result1->num_rows." </p>";
			if($result1->num_rows > 0)
			{
				$number_of_phones = $result1->num_rows;
				while($row = $result1->fetch_assoc())
				{	
					array_push($phone_numbers, $row["phone_number"]);
				
				}
		
			}
	*/
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Phone numbers on file</label>';
			echo '<div class="col-sm-5">';
			if(isset($_POST['edit'])) {
			//	echo '<input type="email" name="email" size="30" value="'.$email.'" />';
				if($number_of_phones == 0)
				{
					echo "No registered phones";
				}
				foreach($phone_numbers as $key => $val)
				{
					echo $val."<br />";
				}			
					
			}
			else {
				if($number_of_phones == 0)
				{
					echo "No registered phones";
				}
				foreach($phone_numbers as $key => $val)
				{
					echo $val."<br />";
				}			
			
			}
			echo '</div></div>';
	

?>
