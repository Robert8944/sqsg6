<html>
<head>
<?php include 'config/header.php'; ?>
</head>
<body id = "inventory">
<?php
if ($_SESSION['priv']!='1'){	//redirect user to index page if the user isn't an admin
    header('location:index.php');
}
?>


<?php
require_once('../sql_connector.php'); //connects to the database

if(isset($_POST['Save'])) {	//won't execute code unless button is clicked
    $EmailError = False;
    $NameError = False;


	//make sure that email and name aren't sql queries
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

	//updates info, checks if it is good
    if ($EmailError == False and $NameError == False) {
        $query = "UPDATE user SET Name=?, Email=?,is_admin=? WHERE UID = ?";
        $stmt = $mysqli->prepare($query);
        if ($stmt === false) {
            trigger_error($this->mysqli->error, E_USER_ERROR);
        }
        $stmt->bind_param("ssis",$name,$email,$_POST['is_admin'],$_POST['UserID']);
        $status = $stmt->execute();
        if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
        }
        $results = $stmt->fetch();
        if ($mysqli->affected_rows == 1) {

        }
        else {
            echo "Darn! that email is taken :( Try another!";
        }

    }
    else {
        echo "Invalid Entry please try again";
    }

}






//makes table to display table header
$query = "SELECT * FROM user";
$result = $mysqli->query($query);
echo '<table class="table tabel-striped>">
<thead>
    <tr>
 <th><b>User ID</b></th>
 <th><b>Name</b></th>
 <th><b>Email</b></th>
 <th><b>Status</b></th>
 </tr>
 </thead>';

//fills up table with user(s) info
while($row = $result->fetch_array(MYSQLI_ASSOC)){

    if(isset($_POST['UID'])and ($_POST['UID'] ==  $row['UID'] )){
        echo '<tr> <form action="admin_user_info.php" method="post">';
        echo' <td><input type="hidden" name="UserID" value="'.$_POST['UID'].'" />'. $row['UID'].'</td>
	 <td>'. '<input type="text" name="name" size="15" value="'.$row['Name'] .'" />'.'</td>
     <td>'. '<input type="email"name="email"  value="'.$row['Email'] .'" />'.'</td>';
        if ($row['is_admin']== 1)
            echo '<td>'. '<select name="is_admin">
                <option value="saab">User</option>
                <option value="fiat" selected>Admim</option> 
                </select>'.'</td>';
        else
            echo '<td>'. '<select name="is_admin">
                <option value="0" selcted>User</option>
                <option value="1">Admim</option> 
                </select>'.'</td>';
	echo '<td> <button class = "btn btn-primary" type="submit" name ="Save" value="Save">Save</button></form>  </tr>';
    }
    else{
        echo '<tr> 
     <td>'. $row['UID'].'</td> 
	 <td>'. $row['Name'].'</td>
     <td>'. $row['Email'].'</td>';
     if ($row['is_admin']== 1)
            echo '<td>Admin</td>';
     else
         echo '<td>User</td>';
	 echo '<td> <form action="#edit" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="UID" value="'.$row['UID'].'">Edit</button></td>  </form> </tr>';
    }
}

	//close database
$mysqli->close();
/*
if(isset($_POST['add'])){
    echo '<form action="Processes/add_product.php" method="post">';
    echo'<tr> <td>'."Product ID".'</td> 
	 <td>'. '<input type="text" name="name" size="15" />'.'</td>
     <td>'. '$<input type="number" step= "0.01" name="price" min = "0" size="30"/>'.'</td>';
    if ($_SESSION['priv']=='2'){
        echo '<td>'. '<input type="number" step= "1" name="promo" min = "0" max = "100" size="30" value="'.$row['promo']*100 .'" />%'.'</td>';}
    else{
        echo '<td>'. '<input type="hidden" step= "1" name="promo" min = "0" max = "100" size="30" value="'.$row['promo']*100 .'" />'.'</td>';
    }
    echo '<td>'. '<input type="text" name="quant" size="15" />'.'</td>   </tr></table>';
    echo ' <button class = "btn btn-primary" type="submit" name ="submit" value="sent">Submit</button>';
}
else{
    echo '<tr><form action="#add" method="post"> <td>
		<button class = "btn btn-primary" type="submit" name ="add" value="add">Add Entry</button></td></tr>';
    echo'</table>';
}
*/
?>



</body>
