<?php
	//include 'config/header.php'; //conects to database
	require_once('../sql_connector.php');
	$UID		= $_POST['uid'];
	$table		= $_POST['table'];
	$item		= $_POST['item'];
	$value		= $_POST['value'];
	$uidVarName	= "uid";
	if($table != "user"){
		$uidVarName = "user_id";
	}
	if($table == "phone_list"){
		$sql = "UPDATE ".$table." SET ".$item."=\"".$value."\" WHERE id=".$UID.";";
	}else if($item != "zip" && $item != "street_num"){
		$sql = "UPDATE ".$table." SET ".$item."=\"".$value."\" WHERE ".$uidVarName."=".$UID.";";
	}else{
		$sql = "UPDATE ".$table." SET ".$item."=".$value." WHERE ".$uidVarName."=".$UID.";";
	}
	echo $sql;
	//$sql = "UPDATE $item SET $item='$value' ";
        $result = $mysqli->query($sql);
	//$result = mysqli_query($mysqli,$sql);
	echo "Result: ".$result;
?>
