
<?php 
/** index.php
This file is the homepage for the website. 
If the website visitor is not logged in, it gives login instructions (for now).
If the visitor is logged in, the homepage presents a form for entering phone numbers to associate with the user account.

The navigation bar at the top of the page changes when the user is logged in. It is loaded from the file "header.php" in the "config" folder.
When the user is not logged in, there are only links to the homepage (index.php), the login page (user_login.php), and the account creation page (user_registration.php).

*/
include 'config/header.php';
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

}


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

