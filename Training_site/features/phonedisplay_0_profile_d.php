<?php
			session_start();
			require_once('/var/www/html/sqsg6/sql_connector.php');
			$phone_numbers = [];
			$phone_number_ids = [];
			$group_ids = [];
			$number_of_phones = 0;
			$UID = $_SESSION["user"];
			$sql1 = "SELECT * FROM phone_list WHERE user_id=".$UID.";";
			$result1 = $mysqli->query($sql1);
			if($result1->num_rows > 0){
				$number_of_phones = $result1->num_rows;
				while($row = $result1->fetch_assoc()){
					array_push($phone_numbers, $row["phone_number"]);
					array_push($phone_number_ids, $row["id"]);
				}
			}
			echo '<div id="inputbox" class="form-group">';
			echo '<label class="control-label col-sm-5" >Phone numbers on file</label>';
			echo '<div class="col-sm-5">';
			if($number_of_phones == 0){
				echo "No registered phones";
			}else{
				foreach($phone_numbers as $key => $val){
					echo '<input id="phone_number'.$key.'" type="phone_number'.$key.'" name="phone_number'.$key.'" value="'.$val.'" disabled>';
	                                echo '<input id="phone_numberButton'.$key.'" type="button" value="Edit">';
					echo '<br>';
                        	        echo '<script>
                	                        var pnb'.$key.' = document.getElementById("phone_numberButton'.$key.'");
        	                                var pna'.$key.' = document.getElementById("phone_number'.$key.'");
	                                        pnb'.$key.'.addEventListener("click", function(){
                                        	        if(pnb'.$key.'.value=="Edit"){
                                	                        pna'.$key.'.disabled = false;
                        	                                pna'.$key.'.focus();
                	                                        pnb'.$key.'.value="Save";
								var pna'.$key.'Orig = pna'.$key.'.value;
        	                                        }else{
	                                                        $.ajax({
                                                        	        type : "POST",
                                                	                url  : "saveprofile.php",
                                        	                        data : {uid:'.$phone_number_ids[$key].', table:"phone_list", item:"phone_number", value:pna'.$key.'.value},
                                	                                success : function(data){
                        	                                                //alert(data);
                	                                                }
        	                                                });
	                                                        pna'.$key.'.disabled = true;
								pna'.$key.'Orig = pna'.$key.'.value;
                                                	        pnb'.$key.'.value="Edit";
                                        	        }
                                	        });
					</script>';
				}
			}
			echo '</div></div>';
?>
