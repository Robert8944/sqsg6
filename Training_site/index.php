<?php include 'config/header.php';
require_once('../sql_connector.php');?>

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

