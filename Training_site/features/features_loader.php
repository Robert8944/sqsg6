<?php
//include "../../sql_connector.php";
include $_SERVER["DOCUMENT_ROOT"].'/'.'sqsg6/sql_connector.php';
//echo "global xyz is ".$xyz;
//echo "sql connector: ".$_SERVER["DOCUMENT_ROOT"].'/'.'sqsg6/sql_connector.php'."<br />";


/**
* Helper function for the feature_loader function.
*/
function get_version_number($name, $uid){
	global $mysqli;
	/*
	echo "user: ".$user." ";
	//$sql1 = "SELECT * FROM user WHERE Email=\"".$user_email."\"";
	$sql1 = "SELECT * FROM user WHERE Name=\"".$user."\"";

	$uid = 0;
	$result1 = $mysqli->query($result1);
	if($result1->num_rows > 0)
	{
		while($row = $result1->fetch_assoc())
		{
			$uid = $row["UID"];
			break;
		}
	}
	*/
	echo "uid: ".$uid." ";
	$sql2 = "SELECT * FROM features_available WHERE name=\"".$name."\";";
	$result2 = $mysqli->query($sql2);
	$feature_number = 0;
	if($result2->num_rows > 0)
	{
		while($row = $result2->fetch_assoc())
		{
			$feature_number = $row["id"];
			break;
		}
	}
//	echo "feature number: ".$feature_number." ";
	$sql3 = "SELECT * FROM assigned_features WHERE user_id=".$uid." AND feature_number=".$feature_number." ORDER BY id DESC;";
//	echo $sql3;
	$result3 = $mysqli->query($sql3);
//	echo "Result num rows: ".$result3->num_rows." ";
	if($result3->num_rows > 0)
	{
		while($row = $result3->fetch_assoc())
		{
			$version_number = $row["version_number"];
//			echo "version: ".$version_number." ";
			return $version_number;
		}
	}
//	echo "version is 0. ";
	return 0;
}

//function feature_loader($feature_num, $version=0){
/**
* feature_loader is the function that allows each user account to see a custom version of the website.
*/
function feature_loader($name, $user_email){

	global $mysqli;
	$version_number = get_version_number($name, $user_email);
	echo "Correct features loader loaded.";
	/*
	//$feature_number = 1;
	*/
	//$sql = "SELECT * FROM features_available WHERE name=".$name.";";
	//echo $_SERVER["DOCUMENT_ROOT"];
//	echo "XYZ is ".$xyz;
//	$sql = "SELECT * FROM features_available WHERE id=".$feature_num.";";
	//echo "name is ".$name." ";
	$sql = "SELECT * FROM features_available WHERE name=\"".$name."\";";
	echo "sql is ".$sql." ";
//	echo "Test var is ".$test_var_2;
	$result = $mysqli->query($sql);
	echo "Result num rows: ".$result->num_rows;
	
	if($result->num_rows > 0)
	{

		while($row = $result->fetch_assoc())
		{
			//$name = $row["name"];	
			$file_it_appears_in = $row["owner_file"];
			$on_desktop = $row["on_desktop"];
			$platform = "d";
			if(!$on_desktop){
				$platform = "m";
			}
			$file_name = $name."_".$version_number."_".$file_it_appears_in."_".$platform.".php";
		//	echo "file it appears in: ".$file_it_appears_in;
			$file_name = $_SERVER["DOCUMENT_ROOT"].'/'.'sqsg6/Training_site/features/'.$file_name;

			echo "file name: ".$file_name;

			include $file_name;
			break;
		
		}
	}
	else
	{
		echo "An error occurred in the feature loader sql query";
	}
//*/
}

?>
