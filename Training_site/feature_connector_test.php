<?php
session_start();
/**
* Tests to make sure that the "features" function can load from the database.
* @author Daniel Dilger
*/
//$features_loader_path = $_SERVER["DOCUMENT_ROOT"].'/'.'sqsg6/Training_site/features/features_loader.php';
//require_once($features_loader_path);
require_once("../feature_connector.php");
//echo $_SESSION["user"]."<br />";
echo "This test loads the footer. <br />";
feature_loader("credit", $_SESSION["user"]);


?>
