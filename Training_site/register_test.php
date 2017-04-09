<?php
	include 'config/header.php'; //conects to database
	require_once('../sql_connector.php');


if(isset($_POST['submit']))
{
	$UID = 10;
	//Add optional user information
	
	//Gender
	$sql = "UPDATE user SET gender=\"".$_POST['gender']."\" WHERE uid=".$UID.";";
	echo "SQL: ".$sql."<br />";
	$result = $mysqli->query($sql);


	//Date of birth
	$dateofbirth = $_POST["yearofbirth"]."-".$_POST["monthofbirth"]."-".$_POST["dayofbirth"];
	$sql = "UPDATE user SET dateofbirth='".$dateofbirth."' WHERE uid=".$UID.";";
	echo "SQL: ".$sql."<br />";
	$result = $mysqli->query($sql);
	
	//Phone information
	$sql = "INSERT INTO phone_list(user_id, phone_number, primary_phone) VALUES(".$UID.", ".$_POST["phone_number"].", 1)";
	echo "SQL: ".$sql."<br />";

	$result = $mysqli->query($sql);
	//Add optional address information
	$sql = "INSERT INTO mail_address(user_id) VALUES(".$UID.")";
	$result = $mysqli->query($sql);
	//echo the above result to see why mail address info is not being added.

	$sql = "UPDATE mail_address SET state=\"".$_POST["state"]."\" WHERE user_id=".$UID.";";
	echo "SQL: ".$sql."<br />";

	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET city=\"".$_POST["city"]."\" WHERE user_id=".$UID.";";
	
	$result = $mysqli->query($sql);
	echo "SQL: ".$sql."<br />";

	$sql = "UPDATE mail_address SET zip=".$_POST["zip"]." WHERE user_id=".$UID.";";
	
	$result = $mysqli->query($sql);
	echo "SQL: ".$sql."<br />";

	$sql = "UPDATE mail_address SET street=\"".$_POST["streetname"]."\" WHERE user_id=".$UID.";";
	echo "SQL: ".$sql."<br />";

	$result = $mysqli->query($sql);

	$sql = "UPDATE mail_address SET street_num=".$_POST["streetnumber"]." WHERE user_id=".$UID.";";
	echo "SQL: ".$sql."<br />";

	$result = $mysqli->query($sql);



}
?>

 <form  class="form-horizontal" action="" method="post">



 <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Gender</label>
                <div class="col-sm-7">
                <input type="radio" name="gender" value="Female"/> Female <br />
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
                <label class="control-label col-sm-5">Mailing address</label>
		<div class="col-sm-7">
                
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


      

        <input class="btn btn-default" type="submit" name="submit" value="Register"/>

</form>
