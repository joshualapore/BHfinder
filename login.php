<?php 

    session_start();
    
    require_once 'require/config.php';
    require_once 'require/functions.php';
    
    //Chekc if we are already logged in to prevent redirections
    if(isset($_SESSION['id'])){
        header("Location: profile.php");
    }

    // define variables and set to empty values
    $username = $password = "";
    $usernameErr = $passwordErr = "";

    //Define cookie variables
    $cookie_username = "username";
    $cookie_password = "password";

    $count = 0;
    $msg = '';


    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        
        //Validating our username
        if (empty($_POST["username"])) {
            $usernameErr = "Username is required";
            $count++;
        } else {
            $username = test_input($_POST["username"]);
        }
        
        //Validating our password
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
            $count++;
        } else {
            $password = test_input($_POST["password"]);
        }
        
        //Check if we are free of errors
        if($count == 0){
            
            //check if this user exists in the database
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            
            //if data matches
            if($result->num_rows > 0) {
                
                // output data
                $row = $result->fetch_assoc();
                //If the user is verified
                if ($row['is_active'] == 1) {
                    
                    //Check if passwords match
                    if(password_verify($password, $row['password'])) {
                        //Set up cookie files to store username and password
                        if (isset($_POST['checkbox'])){
                            setcookie("username", $username, time() + (86400 * 30), "/");
                            setcookie("password", $password, time() + (86400 * 30), "/");
                        } 
                        //Setting our SESSION variables
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                      //  $_SESSION['website'] = $row['website'];
                        $_SESSION['image'] = $row['image'];
                        $_SESSION['created_at'] = $row['created_at'];
                        header ("Location: profile.php");
                        exit();

                    } else {
                        $passwordErr = '<p class="text-danger">Wrong password. Please try again</p>';
                        $password = "";
                        $count++;
                    }
                } else {
                    $msg = "<p class='text-danger'>You need to verify your account before you login</p>";
                    $count++;
                }
            } else {
                $msg = "<p class='text-danger'>There is no account with this username in the database</p>";
                $username = $password = "";
                $count++;
            }
        }
    } // End of IF
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BHfinder</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
    
  <link rel="stylesheet" href="assets/css/skins/skin-blue.min.css">

  

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue constainer-fluid">
  
  <!-- Main Header -->
  <header class="main-header">
      

    <!-- Logo -->
    <a href="index.php" class="logo" style="background-color: #3c8dbc">
      <!-- mini logo for sidebar mini 50x50 pixels -->
    
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="color: #4eac8b"><b style="color: #3d155f">B</b><b style="color: #df678c">H</b><span style="
      color: #243665">find</span>er</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
        
     
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
           <?php include("faq.php"); ?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="">
            <!-- Menu toggle button -->
            <a href="login.php"  >
              <i class="fa fa-user"></i><span>&nbsp;Log in</span>
              
            </a>
          
          </li>
          <li class="">
            <!-- Menu toggle button -->
            <a href="registration.php">
              <i class="fa fa-user"></i><span>&nbsp;Register</span>
              
            </a>
          
          </li>

        </ul>
      </div>
    </nav>
  </header>
    <main class="">
       
    <div class="hold-transition ">
        <div class="login-box">
            <div class="login-logo">
                <span class="logo-lg" style="color: #4eac8b"><b style="color: #3d155f">B</b><b style="color: #df678c">H</b><span style="
      color: #243665">find</span>er</span>
            </div>

            <?php
                        if (isset($_GET['msge'])){

                             echo '
                             <script src="assets/jquery/dist/jquery.min.js"></script>

                             <script>
                            $(document).ready(function(){
                              

                                $("p").fadeOut(5000);
                              
                            });
                            </script>
                            okdsfds
                            
                            ';
                        }
                    ?>


             <?php
                        
                  
                        if($msg != ''){



                            
                             echo '
                             <script src="assets/jquery/dist/jquery.min.js"></script>

                             <script>
                            $(document).ready(function(){
                              

                                $("p").fadeOut(5000);
                              
                            });
                            </script>
                            
                            '.$msg;'
                            ';
    
                        } else if (isset($_GET['message'])){
                            


                            echo '
                             <script src="assets/jquery/dist/jquery.min.js"></script>

                             <script>
                            $(document).ready(function(){
                              

                                $("p").fadeOut(5000);
                              
                            });
                            </script>
                            
                            '.$_GET['message'];'
                            ';
                        }
                    ?>
                
            <div class="login-box-body">

<form class="text-monospace" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group has-feedback">
                        <?php 
                            if(!isset($_COOKIE[$cookie_username])){

                                echo '<div class="form-group has-feedback">';
                                echo '<input class="form-control" type="text" name="username" placeholder="Username" value="' . $username . '">';
                                echo '<span class="glyphicon glyphicon-envelope form-control-feedback"></span>';
                                echo '<span class="error form-text text-danger"> ' . $usernameErr . '</span>';
                                echo '</div>';
                            } else {
                                echo '<input class="form-control item" type="text" name="username" placeholder="Enter your username" value="' . $_COOKIE[$cookie_username] . '">';
                                echo '<span class="error form-text text-danger">' . $usernameErr . '</span>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <?php 
                            if(!isset($_COOKIE[$cookie_password])){

                                echo '<div class="form-group has-feedback">';
                                echo '<input class="form-control" type="password" name="password" placeholder="Password" value="' . $password . '">';
                                echo '<span class="glyphicon glyphicon-lock form-control-feedback"></span>';
                                echo '<span class="error form-text text-danger">'. $passwordErr . '</span>';
                                echo '</div>';
                            } else {
                                echo '<input class="form-control item" type="password" name="password" placeholder="Enter your password" value="">';
                                echo '<span class="error form-text text-danger">' . $passwordErr . '</span>';
                            }
                        ?>
                    </div>

                    <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                        <label>
                            &nbsp; &nbsp;&nbsp; <input type="checkbox" name="checkbox"> Remember Me
                        </label>
                        </div>
                    </div>

                    <div class="col-xs-4">
                      <button class="btn btn-primary btn-block" type="submit">Log In</button>
                    </div>

                    </div>
                </form>
                <hr/>


                <!--

            <div class="social-auth-links text-center">
              <a href="#" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
              <a href="#" class="btn btn-block btn-social btn-google"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
            </div>

          -->

                <a href="forgot_password.php" class="form-text text-muted" style="font-size: 14px;margin-top: 20px;">Forgot your password?</a>
                <a href="registration.php" class="form-text text-muted" style="font-size: 14px;">Register here.</a>

            </div>

        </div>
    </div>
                  
  
    
    </main>
   
<!-- footer -->
<footer style="position:fixed;
  width: 100%;
   bottom: 0;z-index: 9999" >
        
   
      
    <div class="constainer-fluid text-center" style="margin-top: 1%">

      
        <strong >Copyright &copy; 2019 <a href="index.php">BHfinder.com</a>.</strong> All rights reserved.
    </div>

    <br/>
        
    </footer>
<!-- end of footer -->



</body>
</html>

<!-- JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>





