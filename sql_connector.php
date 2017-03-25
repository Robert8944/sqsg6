<?php

$config = parse_ini_file( 'config.ini' );

$password = $config['password'];

DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD', $password);
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME', 'cs499');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
OR die('Could not connect to MYSQL'.mysqli_connect_error());

?>

