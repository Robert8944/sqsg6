
<?php include 'config/header.php';
require_once('../sql_connector.php');

?>
<?php
if(isset($_SESSION['SMSReport']))
{
	echo $_SESSION['SMSReport'];
	unset($_SESSION['SMSReport']);
}
if(isset($_SESSION['SubscriptionReport']))
{
	echo $_SESSION['SubscriptionReport'];
	unset($_SESSION['SubscriptionReport']);
<<<<<<< HEAD

}


?>
<?php
/*			$text_email = $email_prefix.'@'.$email_suffix;
			
			//send an introductory text
			$message = 'Welcome to the SQS text subscription list! From now on, you will receive important updates about the site.';
			$headers = "From: SQS Training\r\n";
			$recieved = mail($text_email,'SQS Subscription Confirmation',$message,$headers);

//			echo "Test var: ".$testvar."<br />";

			//then, add the number and carrier to the database
			$stmt = $mysqli->prepare('INSERT INTO subscriber (phone_number, carrier, international_code) VALUES (?,?,?)');
			$stmt->bind_param("sss", $PhoneNumber,$Carrier,$CountryCode);
			$stmt->execute();
			$stmt->close();
			if ($recieved == true) {
				echo '<h3 style = "text-align: center">You should recieve a confirmation text soon.</h3>';
			}
			else{
				echo '<h3 style = "text-align: center">There was an error in sending the confirmation text. Your phone number may have been entered incorrectly, or an error may exist within the website backend.</h3>';
			}
		}
		else {
			echo '<h2 style = "text-align: center">Number is already subscribed to our service. Thanks for your eagerness to stay updated! <h2>';
		}
    }
    else {
        echo '<h2 style = "text-align: center">Phone number enetered was invalid. Please enter numbers only!<h2>';
    }

=======
>>>>>>> 982913ab8b87e6f2e1ca72c83723a3482a698805
}
*/
?>

<html>
<!DOCTYPE html>
<div id="home_page">
  <body class="container">
    <div>
	<?php

			if (isset($_SESSION['user'])){	//prompts user with following messages if/if not logged in
				echo '<h2>Hey there! Click the links on the header to navigate the site.</h2>';
			}
			else{
				echo '<h2>Welcome! Please login or sign up using the navigation bar at the top of the screen.</h2>';
			}

	?>
		<br/><br/>
	<?php

		if(isset($_SESSION['user']))
		{
			include("phone_signup.php");
		}
		
		else
		{
			/*Assume that phone numbers ought to be associated with account names. If not, a "No Association" account could be associated with those phone numbers added when no one was logged in. (Accounts can have more than one phone number).
		In the case that the user is logged in, what should be displayed instead? A description of the website?
		*/
			
			include("site_description_paragraph.php");
		}
		
	?>
		
	</div>
  </body>
<?php

include "footer.php"; 
?>
</div>
</html>

