<?php
if(isset($_POST['submit'])) {
	
	//define function to retrieve JSON string from numverify.com
	//credit for this function is given to http://stackoverflow.com/questions/6516902/how-to-get-response-using-curl-in-php	
    $NumberInputError = False;
	$PhoneNumber = "";
	$NumberInDatabase = False;
/*	$CountryCode = $mysqli->real_escape_string(trim($_POST['countrycode']));
	$Carrier = $mysqli->real_escape_string(trim($_POST['carrier']));
	
	//build the phone number string from the fields the user filled out
	//raise an error flag if anything they type is invalid (not a number)
    if (preg_match('%[0-9]%', stripslashes(trim($_POST['areacode'])))) {
        $PhoneNumber .= $mysqli->real_escape_string(trim($_POST['areacode']));
    }
    else {
        $NumberInputError = True;
    }
	if (preg_match('%[0-9]%', stripslashes(trim($_POST['numberpart1'])))) {
        $PhoneNumber .= $mysqli->real_escape_string(trim($_POST['numberpart1']));
    }
    else {
        $NumberInputError = True;
    }
	if (preg_match('%[0-9]%', stripslashes(trim($_POST['numberpart2'])))) {
        $PhoneNumber .= $mysqli->real_escape_string(trim($_POST['numberpart2']));
    }
    else {
        $NumberInputError = True;
    }
	
	
	$stmt = $mysqli->prepare('SELECT international_code FROM subscriber WHERE phone_number=?');
	$stmt->bind_param("s", $PhoneNumber);
	$stmt->bind_result($sample1);
	$stmt->execute();
	$results = $stmt->fetch();		
	if ($results == 1){
		$NumberInDatabase = true;
	}
	$stmt->close();
	
    if ($NumberInputError == False) {
		if ($NumberInDatabase == false){
			
			//try sending a text to the number
			$email_prefix = $PhoneNumber;
			$email_suffix = "";
			//currently only checks top five carriers in the United States/Canada.
			//could be expanded to check for ALL carriers in US and internationally
			if (strpos($Carrier, 'VERIZON') == true){
				$email_suffix .= 'vtext.com';
			} else if (strpos($Carrier, 'AT&T') == true) {
				$email_suffix .= 'txt.att.net';
			} else if (strpos($Carrier, 'TMOBILE') == true) {
				$email_suffix .= 'tmomail.net';
			} else if (strpos($Carrier, 'USCELL') == true) {
				$email_suffix .= 'email.uscc.net';
			} else if (strpos($Carrier, 'SPRINT') == true) {
				$email_suffix .= 'messaging.sprintpcs.com';
			}
			$text_email = $email_prefix.'@'.$email_suffix;
			
			//send an introductory text
			$message = 'Welcome to the SQS text subscription list! From now on, you will receive important updates about the site.';
			$headers = "From: SQS Training\r\n";
			$recieved = mail($text_email,'SQS Subscription Confirmation',$message,$headers);

			//then, add the number and carrier to the database
			$stmt = $mysqli->prepare('INSERT INTO subscriber (phone_number, carrier, international_code) VALUES (?,?,?)');
			$stmt->bind_param("sss", $PhoneNumber,$Carrier,$CountryCode);
			$stmt->execute();
			$stmt->close();
			if ($recieved == true) {
				echo '<h3 style = "text-align: center">Message sent!</h3>';
			}
			else{
				echo '<h3 style = "text-align: center">Message not sent.</h3>';
			}
		}
		else {
			echo '<h2 style = "text-align: center">Number is already subscribed to our service. Thanks for your eagerness to stay updated! <h2>';
		}
    }
    else {
        echo '<h2 style = "text-align: center">Phone number entered was invalid. Please enter numbers only!<h2>';
    }
*/
}

echo "Form page 2.";
?>


