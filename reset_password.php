<?php
    session_start();
    
    require_once 'require/config.php';
    require_once 'require/functions.php';

    //Get the code from session
    $reset_code = $_SESSION['reset_code'];

    // define variables and set to empty values
    $is_active = $password = $confirm_password = "";
    $passwordErr = $confirm_passwordErr = "";

    $count = 0;
    $msg = '';




    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $password = test_input($_POST["password"]);
        $confirm_password = test_input($_POST["confirm_password"]);

         if(strlen(trim($password)) < 6 != NULL){
            $passwordErr = "Password must be atleast 6 characters";
            $count++;
        }
        
        //Validating our password
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
            $count++;
        } else {
            $password = test_input($_POST["password"]);
        }
        
        //Validating our confirm password
        if (empty($_POST["confirm_password"])) {
            $confirm_passwordErr = "Please confirm your password";
            $count++;
        } else {
            $confirm_password = test_input($_POST["confirm_password"]);
            //Check if passwords match
            if($confirm_password != $password){
                $confirm_passwordErr = "Password does not match";
                $confirm_password = "";
                $count++;
            } else {
                $confirm_password = test_input($_POST["confirm_password"]);
            }
        }
        
        //If we are free of errors
        if($count == 0){
            //Getting information from user with a proper reset_code
            $sql = "SELECT * FROM users WHERE reset_code = '$reset_code'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                //If the user is verified
                if($row['is_active'] == 1){
                    //hashing the password before inserting it into database
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    //Update the user password and delete the reset code
                    $sql = "UPDATE users SET password = '$hashed_password', reset_code = '' WHERE reset_code = '$reset_code'";
                    
                    if ($conn->query($sql) === TRUE) {
                    $msg = '<p class="text-success">Your password has been reset</p>';
                    header("Location: login.php?message=$msg");
                    //Unset the reset_code variable
                    session_unset();
                    exit();
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    //hashing the password before inserting it into database
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    //Update the user password only
                    $sql = "UPDATE users SET password = '$hashed_password' WHERE reset_code = '$reset_code'";

                    if ($conn->query($sql) === TRUE) {
                        $msg = 'Your password has been reset';
                        header("Location: login.php?message=$msg");
                        //Unset the reset_code variable
                        session_unset();
                        exit();
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            } else {
                echo "0 results";
            }
        }
    }//End of IF
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
            
            
                <div class="text-monospace block-heading">
                    <h2 class="text-info">Reset password</h2>
                    <p>Please fill the credentials to reset your password</p>
                </div>
                <form class="text-monospace" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Enter your new password" value="<?php echo $password; ?>">
                        <span class="error form-text text-danger"><?php echo $passwordErr; ?></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="confirm_password" placeholder="Confirm your new password">
                        <span class="error form-text text-danger"><?php echo $confirm_passwordErr; ?></span>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="submit">Reset password</button>
                </form>
            
       </div>
   </div>
    </main>
    







    <footer class="" style="">
        
    <hr/>
      
    <div class="container-fluid">
        <strong >Copyright &copy; 2019 <a href="#">BHfinder.com</a>.</strong> All rights reserved.
    </div>
        
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

