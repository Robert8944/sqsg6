

<?php include 'config/header.php'; //conects to database
require_once('../sql_connector.php');?>


<?php
if (isset($_SESSION['user'])){		//redirects if user not an actual user
    header('location:index.php');
}

if(isset($_POST['submit'])) {		//waits for buttons press
    $EmailError = False;
    $passwordError = False;
    $NameError = False;

	//makes sure that pasword and email aren't sql queries
    if (preg_match('%[A-Za-z0-9\.\-\$\@\$\!\%\*\#\?\&]%', stripslashes(trim($_POST['password'])))) {
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

    if (preg_match('%^[a-zA-Z]+$%', stripslashes(trim($_POST['name'])))) {
        $name = $mysqli->real_escape_string(trim($_POST['name']));
    }
    else {
        $NameError = True;
    }

	//updates info
    if ($passwordError == False and $EmailError == False and $NameError == False) {
        $query = "Insert INTO user (Name,Password,Email) VALUES (?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sss",$name,$password,$email);
        $stmt->execute();
        $results = $stmt->fetch();
        if ($mysqli->affected_rows == 1) {
            session_start();
            $stmt2 = $mysqli->prepare('SELECT UID,Name,is_admin FROM user WHERE email = ?');
            $stmt2->bind_param("s", $email);
			$stmt->close();
            $stmt2->execute();
            $stmt2->bind_result($UID,$name,$priv);
			$stmt2->fetch();
			echo $stmt2->affected_rows;
            $_SESSION['priv'] = $priv;
            $_SESSION['user'] = $UID;
            $_SESSION['name'] = $name;
            header('location:index.php');
        }
        else {
            echo "Darn! that email is taken :( Try another!";
        }

    }
    else {
        echo "Invalid Credentials please try again";
    }
}
?>

<html>
<!DOCTYPE html>
<div class="container">
    <form  class="form-horizontal" action="" method="post">
        <div >
            
            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >Name</label>
                <div class="col-sm-7">
                <input type="text" name="name" size="30" /></label>
                    </div>
            </div>


            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5" >Password</label>
                <div class="col-sm-7">
                <input type="password" name="password" size="30" /></label>
                    </div>
            </div>

            <div class="form-group" id="centerbox">
                <label class="control-label col-sm-5">Email</label>
                <div class="col-sm-7">
                <input type="email" name="email" size="30" </label>
                </div>
            </div>


            <div class="form-group" id="centerbox">
                <div class="control-label col-sm-6">
                <input class="btn btn-default" type="submit" name="submit" value="Register"/></label>
                </div>
            </div>
        </div>



    </form>
</div>






<?php
/**
 * Created by PhpStorm.
 * User: Kevin Joiner
 * Date: 4/3/2016
 * Time: 3:05 AM
 */

?>
</html>
