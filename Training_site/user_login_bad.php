

<?php include 'config/header.php'; //connects to data base
require_once('../sql_connector.php');?>


<?php
if (isset($_SESSION['user'])){      //redirects if user isn't a user
    header('location:index.php');
}
if(isset($_POST['submit'])) {          //waits for button press



    $password  = $_POST['password'];
    $email = $_POST['email'];


    //updates info
    $sql = "SELECT UID,Name,is_admin FROM user WHERE  password = '$password' AND email= '$email' ";
    echo $sql;
    $result = $mysqli->query($sql);

    if ($result) {

        session_start();
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $row['UID'];
        $_SESSION['name'] = $row['Name'];
        $_SESSION['priv'] = $row['is_admin'];
        header('location:index.php');

    }

}
//= 1 OR 1=1
?>

<html>
<form  class= "form-horizontal"action="" method="post">


    <div class="form-group">
        <label class="control-label col-sm-5">Email</label>
        <div class="col-sm-7">
            <input type="text" name="email" size="30" </label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-5">Password</label>
        <div class="col-sm-7">
            <input type="password" name="password" size="30" /></label>
        </div>
    </div>




    <div class="form-group">
        <div class="control-label col-sm-6">
            <input class="btn btn-default" type="submit" name="submit" value="Send"/></label>
        </div>
    </div>



</form>






<?php
/**
 * Created by PhpStorm.
 * User: Kevin Joiner
 * Date: 4/3/2016
 * Time: 3:05 AM
 */

?>
</html>
