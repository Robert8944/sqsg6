<?php
/**
* This file makes it easier to develop on multiple machines.
* @author Daniel Dilger
*/
$config = parse_ini_file( 'config.ini' );

$docroot = $config['docroot'];

$features_loader_path =  $docroot .'/sqsg6/Training_site/features/features_loader.php';
require_once($features_loader_path);

?>
