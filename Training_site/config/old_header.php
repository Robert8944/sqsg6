
<link rel="stylesheet" type="text/css" href="assets\css\main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">



<?php session_start(); ?>
<html>
<head>
    <div id ="heading">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <!-- <div class='col-xs-4'> -->
                        <li><a  href="index.php"><img src="assets/images/logo.png" alt="SQS logo"></a></li>
                        <!-- </div> -->
                        <?php if(isset($_SESSION['name'])) echo "<div class='col-sm-4'> <li> Hello ". $_SESSION['name']."</li></div> <br>"; ?>
                    </ul>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div><!--navbar-header-->
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
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
                    </ul>
                    </li> <!--dropdown-->
                </div><!--collapse navbar-collapse -->
            </div><!--container fluid-->
            <div class="sqs_blue_line">
                <br>
            </div><!--sqs_blue_line-->
    </div><!--heading-->
</head>
</nav>



</html>





