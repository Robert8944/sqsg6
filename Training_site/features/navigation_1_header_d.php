                        <?php
			echo " error version 1 ";
                        if(isset($_SESSION['priv'])){
                            echo '<li> <a href = "profile.php">  View Profile </a></li> ';
                            if($_SESSION['priv'] == '1'){
                                echo '<li> <a href ="admin_user_info.php">  Admin Page </a></li>';
                            }
                            echo '<li> <a href = "log_out.php">  Log out </a></li> ';
                        }
                        else{
                            echo '<li> <a href = "user_login.php">  Sign in </a></li> ';
                            echo '<li> <a href = "user_register.php">  Sign up </a></li>';
                        }
                        ?>
 
