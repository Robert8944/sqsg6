

<?php include 'config/header.php'; //connects to data base
require_once('../sql_connector.php');?>


<?php
/*
if (isset($_SESSION['user'])){      //redirects if user isn't a user
    header('location:index.php');
}
*/
if(isset($_POST['submit'])) {          //waits for button press
    $EmailError = False;
    $passwordError = False;

    //makes sure password and email aren't sql queries
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

    //updates info
    if ($passwordError == False and $EmailError == False) {
        $stmt = $mysqli->prepare('SELECT UID,Name,level FROM user WHERE email = ? AND password = ? LIMIT 1');
        $stmt->bind_param("ss", $email,$password );
        $stmt->bind_result($UID, $name, $level);
        $stmt->execute();
        $results = $stmt->fetch();
        if ($results == 1) {
            session_start();
            $admin = ($level == 5);
            //echo "admin: ".$admin;
            if ($admin)
                $_SESSION['priv'] = '1';
            else
                $_SESSION['priv'] = $admin;
            $_SESSION['user'] = $UID;
            $_SESSION['name'] = $name;
            header('location:index.php');
        } else {
            echo "Invalid Log in Please go back and try again";
        }

    }
    else {
        echo "Invalid Entry Please go back and try again";
    }
}
?>

<html>
<!DOCTYPE html>
<div class="container">
    <form  class= "form-horizontal"action="" method="post">

        <div class="form-group" id="inputbox">>
            <label class="control-label col-sm-5">Email</label>
            <div class="col-sm-7">
                <input type="email" name="email" size="30" </label>
            </div>
        </div>

        <div class="form-group" id="inputbox">
            <label class="control-label col-sm-5">Password</label>
            <div class="col-sm-7">
                <input type="password" name="password" size="30" /></label>
            </div>
        </div>

        <div class="form-group" id="inputbox">
            <div class="control-label col-sm-6">
            <input class="btn btn-default" type="submit" name="submit" value="Sign in"/></label>
            </div>
        </div>

    </form>
</div>

</html>
