

<?php
/**
This file is where users can create accounts.
Accounts created on this page are automically given a ranking of "3", which is simply an account without administrative privileges (further distinctions between account rankings may be given in the future).
Only the name, email, and password information must be created to create an account.
Errors will not be introduced to this page any time soon because specific errors can currently only be associated with users who are logged in.
*/
include 'config/header.php'; //conects to database
require_once('../sql_connector.php');?>


<?php
//Start of code for user registration in SQL

if(isset($_POST['submit'])) {		//waits for buttons press
    $EmailError = False;
    $passwordError = False;
    $passwordsMatch = False;
    $NameError = False;

	//makes sure that pasword and email aren't sql queries
    if (preg_match('%[A-Za-z0-9\.\-\$\@\$\!\%\*\#\?\&]%', stripslashes(trim($_POST['password'])))) {
        if($_POST['password'] == $_POST['confirmpassword'])
	{
		$passwordsMatch = True;
	}
	$password = $mysqli->real_escape_string(trim($_POST['password']));
        $password  = hash("sha256", $password);
    }
    else {
        $passwordError = True;
    }
    if (preg_match('%[A-Za-z0-9]+@+[A-Za-z0-9]+\.+[A-Za-z0-9]%', stripslashes(trim($_POST['email'])))) {
        $email = $mysqli->real_escape_string(trim($_POST['email']));
    }
    else {
        $EmailError = True;
    }

    if (preg_match('%^[a-zA-Z ]+$%', stripslashes(trim($_POST['name'])))) {
        $name = $mysqli->real_escape_string(trim($_POST['name']));
    }
    else {
        $NameError = True;
    }

	//updates info
    if($passwordsMatch == False)
	{
		echo "<div class='container' id='error'>Error: You did not type the same password twice.</div>";
	}
    else if ($passwordError == False and $EmailError == False and $NameError == False) {

	//Create a new user account with the mandatory information
        $query = "Insert INTO user (Name,Password,Email) VALUES (?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sss",$name,$password,$email);
        $stmt->execute();
        $results = $stmt->fetch();


	//If the account was successfully created, log the user into the new account

	if ($mysqli->affected_rows == 1) {

	$sql = "SELECT * FROM user WHERE Email=\"".$email."\";";
	$result = $mysqli->query($sql);
	$UID = -1;
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$UID = $row["UID"];
		}
	}

	 //Add the optional information, if available
	//Add optional user information

	//Gender
	$sql = "UPDATE user SET gender=\"".$_POST['gender']."\" WHERE uid=".$UID.";";
	$result = $mysqli->query($sql);


	//Date of birth
	$dateofbirth = $_POST["yearofbirth"]."-".$_POST["monthofbirth"]."-".$_POST["dayofbirth"];
	$sql = "UPDATE user SET dateofbirth='".$dateofbirth."' WHERE uid=".$UID.";";
	$result = $mysqli->query($sql);

	//Phone information
	$sql = "INSERT INTO phone_list(user_id, phone_number, primary_phone) VALUES(".$UID.", ".$_POST["phone_number"].", 1)";
	$result = $mysqli->query($sql);


	//Add optional address information
	$sql = "INSERT INTO mail_address(user_id) VALUES(".$UID.")";
	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET state=\"".$_POST["state"]."\" WHERE user_id=".$UID.";";

	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET city=\"".$_POST["city"]."\" WHERE user_id=".$UID.";";

	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET zip=".$_POST["zip"]." WHERE user_id=".$UID.";";

	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET street=\"".$_POST["streetname"]."\" WHERE user_id=".$UID.";";

	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET street_num=".$_POST["streetnumber"]." WHERE user_id=".$UID.";";

	$result = $mysqli->query($sql);



	echo "<div class='container' id='error'>Account creation successful. Please log in.</div>";
	   // header('location:index.php');
        }
        else {
            echo "<div class='container' id='error'>Darn! that email is taken :( Try another!</div>";
        }

    }
    else {
        echo "<div class='container' id='error'>Invalid Credentials please try again</div>";
    }
}
//End of user registration sql commands
?>

<html>
<!DOCTYPE html>
<div class="container">

    <form  class="form-horizontal" action="" method="post">
        <div >

             <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >Asterisks (*) indicate required fields</label>
                 <div class="col-sm-7">

                    </div>

            </div>

            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >* Name</label>
                <div class="col-sm-7">
                <input type="text" name="name" size="30" /></label>
                    </div>
            </div>

     <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">* Email</label>
                <div class="col-sm-7">
                <input type="text" name="email" size="30" </label>
                </div>
            </div>



            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >* Password</label>
                <div class="col-sm-7">
                <input type="password" name="password" size="30" /></label>
                    </div>
            </div>
            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >* Confirm password</label>
                <div class="col-sm-7">
                <input type="password" name="confirmpassword" size="30" /></label>
                    </div>
            </div>
	  <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Gender</label>
                <div class="col-sm-7b">
                  <input type="radio" name="gender" value="Female"/> Female <br />
                </div><div class="col-sm-7c">
                  <input type="radio" name="gender" value="Male"/> Male <br />
                </div>
            </div>


	 <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Date of birth (MM/DD/YYYY)</label>
                <div class="col-sm-7">
                <input type="text" name="monthofbirth" size="6" /> /
                <input type="text" name="dayofbirth" size="6" /> /
		<input type="text" name="yearofbirth" size="6" />

		</div>
            </div>
  	<div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Primary phone</label>
                <div class="col-sm-7">
                <input type="text" name="phone_number" size="30" />
                </div>
            </div>

	<div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Street name</label>
                <div class="col-sm-7">
                <input type="text" name="streetname" size="30" />
                </div>
            </div>
	<div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Street number</label>
                <div class="col-sm-7">
                <input type="text" name="streetnumber" size="30" />
                </div>
            </div>
	<div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">City</label>
                <div class="col-sm-7">
                <input type="text" name="city" size="30" />
                </div>
            </div>

	<div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">State (two letter abbreviation)</label>
                <div class="col-sm-7">
                <input type="text" name="state" size="30" />
                </div>
            </div>
	<div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Zip code</label>
                <div class="col-sm-7">
                <input type="text" name="zip" size="30" />
                </div>
            </div>


            <div class="form-group" id="centerbox">
                <div class="control-label col-sm-6">
                <input class="btn btn-default" type="submit" name="submit" value="Register"/>
                </div>
            </div>
        </div>



    </form>
</div>





</html>
