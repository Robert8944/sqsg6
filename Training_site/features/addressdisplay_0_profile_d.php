<?php
session_start();
require_once('/var/www/html/sqsg6/sql_connector.php');
	$UID = $_SESSION["user"];
	//Load address information
			$state = "N/A";
			$city = "N/A";
			$zip = "N/A";
			$state = "N/A";
			$street_num = "N/A";
			$street = "N/A";
			$query = "select state, city, zip, street, street_num from mail_address where user_id = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s",$UID);
			$stmt->execute();
			$stmt->bind_result($state, $city, $zip, $street, $street_num);
			$stmt->fetch();
			$stmt->close();
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Mail address</label>';
			echo '<div class="col-sm-5">';
			if($street == "N/A"){
				echo "None on file";
			}
			else{
				echo '<input id="street_num" type="street_num" name="street_num" value="'.$street_num.'" disabled>';
                                echo '<input id="street_numButton" type="button" value="Edit">';
				echo '<br>';
				echo '<input id="street" type="street" name="street" value="'.$street.'" disabled>';
                                echo '<input id="streetButton" type="button" value="Edit">';
				echo '<br>';
				echo '<input id="city" type="city" name="city" value="'.$city.'" disabled>';
                                echo '<input id="cityButton" type="button" value="Edit">';
				echo '<br>';
				echo '<input id="state" type="state" name="state" value="'.$state.'" disabled>';
                                echo '<input id="stateButton" type="button" value="Edit">';
				echo '<br>';
				echo '<input id="zip" type="zip" name="zip" value="'.$zip.'" disabled>';
                                echo '<input id="zipButton" type="button" value="Edit">';
                                echo '<script>
                                        var snb = document.getElementById("street_numButton");
                                        var sna = document.getElementById("street_num");
                                        snb.addEventListener("click", function(){
                                                if(snb.value=="Edit"){
                                                        sna.disabled = false;
                                                        sna.focus();
                                                        snb.value="Save";
                                                }else{
                                                        $.ajax({
                                                                type : "POST",
                                                                url  : "saveprofile.php",
                                                                data : {uid:'.$UID.', table:"mail_address", item:"street_num", value:sna.value},
                                                                success : function(data){
									//alert(data);
                                                                }
                                                        });
                                                        sna.disabled = true;
                                                        snb.value="Edit";
                                                }
                                        });
                                        var sb = document.getElementById("streetButton");
                                        var sa = document.getElementById("street");
                                        sb.addEventListener("click", function(){
                                                if(sb.value=="Edit"){
                                                        sa.disabled = false;
                                                        sa.focus();
                                                        sb.value="Save";
                                                }else{
                                                        $.ajax({
                                                                type : "POST",
                                                                url  : "saveprofile.php",
                                                                data : {uid:'.$UID.', table:"mail_address", item:"street", value:sa.value},
                                                                success : function(data){
									//alert(data);
                                                                }
                                                        });
                                                        sa.disabled = true;
                                                        sb.value="Edit";
                                                }
                                        });
                                        var cb = document.getElementById("cityButton");
                                        var ca = document.getElementById("city");
                                        cb.addEventListener("click", function(){
                                                if(cb.value=="Edit"){
                                                        ca.disabled = false;
                                                        ca.focus();
                                                        cb.value="Save";
                                                }else{
                                                        $.ajax({
                                                                type : "POST",
                                                                url  : "saveprofile.php",
                                                                data : {uid:'.$UID.', table:"mail_address", item:"city", value:ca.value},
                                                                success : function(data){
									//alert(data);
                                                                }
                                                        });
                                                        ca.disabled = true;
                                                        cb.value="Edit";
                                                }
                                        });
                                        var stb = document.getElementById("stateButton");
                                        var sta = document.getElementById("state");
                                        stb.addEventListener("click", function(){
                                                if(stb.value=="Edit"){
                                                        sta.disabled = false;
                                                        sta.focus();
                                                        stb.value="Save";
                                                }else{
                                                        $.ajax({
                                                                type : "POST",
                                                                url  : "saveprofile.php",
                                                                data : {uid:'.$UID.', table:"mail_address", item:"state", value:sta.value},
                                                                success : function(data){
									//alert(data);
                                                                }
                                                        });
                                                        sta.disabled = true;
                                                        stb.value="Edit";
                                                }
                                        });
                                        var zb = document.getElementById("zipButton");
                                        var za = document.getElementById("zip");
                                        zb.addEventListener("click", function(){
                                                if(zb.value=="Edit"){
                                                        za.disabled = false;
                                                        za.focus();
                                                        zb.value="Save";
                                                }else{
                                                        $.ajax({
                                                                type : "POST",
                                                                url  : "saveprofile.php",
                                                                data : {uid:'.$UID.', table:"mail_address", item:"zip", value:za.value},
                                                                success : function(data){
									//alert(data);
                                                                }
                                                        });
                                                        za.disabled = true;
                                                        zb.value="Edit";
                                                }
                                        });
                                </script>';
			}
			echo '</div></div>';
?>
