<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/navbar.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

  </head>

  <body>

    <div class="container" id="heading2">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav"> 
		<li><a href="./">Home </a></li>
              <?php
                if(isset($_SESSION['priv'])){
                    echo '<li> <a href = "profile.php">  View Profile </a></li> ';
		     echo '<li> <a href = "groups.php">  Groups </a></li> ';

                    if($_SESSION['level'] == '5'){
                        //Administrator pages
			echo '<li> <a href ="admin_user_info.php">  Admin Page </a></li>';
                    }
		    else if($_SESSION['level'] == '4')
		    {
			//Superuser pages
			echo '<li> <a href="superuser_user_info.php"> Superuser Page </a> </li>';
		    }
                    echo '<li> <a href = "log_out.php">  Log out </a></li> ';
                }
                else{
                    echo '<li> <a href = "user_login.php">  Sign in </a></li> ';
                    echo '<li> <a href = "user_register.php">  Sign up </a></li>';
                }
                ?>

              </li>
            </ul>

             
            <ul class="nav navbar-nav navbar-right" >
              <div style="display:flex;justify-content:flex-end;align-items:center">
              <?php if(isset($_SESSION['name'])) echo "<div class='col-sm-4'> <li> Hello ". $_SESSION['name']."</li></div> <br>"; ?>
              <li ><a href="./"> <img src="assets/images/logo.png" alt="SQS logo"></a></li>
            </div>
            </ul>

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
