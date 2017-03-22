<?php

function feature_loader($name, $version=0){
	//echo "features_loader demo started.";
	$feature_number = 1;
	$file_it_appears_in = "header";
	$on_desktop = true;
	$platform = "d";
	if(!$on_desktop){
		$platform = "m";
	}
	$file_name = $name."_".$feature_number."_".$file_it_appears_in."_".$platform.".php";
	echo "File name is ".$file_name;
	include $file_name;
}

/*
function test_func(){
	echo "Test function running.";
}
function feature_loader($name){
	echo "feature loader running.";
}
*/
?>
