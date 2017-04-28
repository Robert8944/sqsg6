<?php
/**
* The intent of the footer file is used to display the authors of the project.
* Currently it only displays either the messaged "loaded footer" or a trivial
* error such as "erroneous loaded footer 3".
* @author Daniel Dilger
*/
require_once("../feature_connector.php");
feature_loader("credit", $_SESSION["user"]);


?>
