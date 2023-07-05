<?php
    require_once 'require/config.php';
    require_once 'require/functions.php';
    require_once 'libraries/PHPMailer-master/PHPMailerAutoload.php';
    
    // define email variable and set to empty value
    $reset_code = $is_active = $email = $emailErr = "";

    $count = 0;
    $msg = '';

    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = test_input($_POST["email"]);
        
        //Validating our email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $count++;
        } else {
            $email = test_input($_POST["email"]);
            
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $count++;
            } else {
                //check if email exist
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);
                
                if ($result->num_rows == 0) {
                    $emailErr = "Email not found";
                    $email = "";
                    $count++;
                } else {
                    //Store the is_active and reset_code variable for the email use
                    $row = $result->fetch_assoc();
                    $is_active = $row['is_active'];
                    $reset_code = $row['reset_code'];
                }
            }
        }
        
        //If we are free of errors
        if ($count == 0){
            //If account is verified
            if($is_active == 1) {
                //Generate a unique code
                $reset_code = md5(crypt(rand(), 'aa'));
                //Update the database delete password and insert the new reset_code
                $sql = "UPDATE users SET password = '', reset_code = '$reset_code' WHERE email = '$email'";
                
                if ($conn->query($sql) === TRUE) {
                    
                    $msg = '<p class="text-success">You made a password request, please check email to reset your password</p>';

                    $message = "You requested a password reset. Click the link below to reset your password. <br><br> 
                    <a href='http://localhost/bhfinder/process/p_reset_password.php?code=$reset_code'>Click here to reset your password</a>";

                    //sending email to the user
                    send_mail($email, $message);

                    $email = $emailErr = "";
                    
                } else {
                    echo "Error updating record: " . $conn->error;
                }
                
            } else {
                //Update the database delete the password only
                $sql = "UPDATE users SET password = '' WHERE email = '$email'";
                if ($conn->query($sql) === TRUE) {
                    $msg = '<p class"text-success">You made a password request, please check email to reset your password</p>';
                    
                    $message = "You requested a password reset. Click the link below to reset your password. <br><br> 
                    <a href='http://localhost/bhfinder/process/p_reset_password.php?code=$reset_code'>Click here to reset your password</a>";
                    
                    //sending email to the user
                    send_mail($email, $message);

                    $email = $emailErr = "";
                    
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
    }// End of IF


                        

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
    <a href="#" class="logo"  style="background-color: #3c8dbc">
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

 

    <main class="hold-transition ">
        
            <div class="login-box">
                <div class="text-monospace block-heading">
                    <h2 class="text-info">Forgot your password?</h2>
                    <p>Please fill the credentials to reset your password</p>
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
                                                     
                        }
                    ?>
                   
                </div>
                <form class="text-monospace" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group">
                        <input class="form-control item" type="email" name="email" placeholder="Enter your email">
                        <span class="error form-text text-danger"><?php echo $emailErr; ?></span>
                        <small class="form-text text-muted">We will send you a reset code.</small>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Reset my password</button>
                    <a
                        class="text-monospace form-text text-muted" href="login.php" style="margin-top: 20px;font-size: 14px;">Go back to login</a>
                </form>
            </div>
        </section>
    </main>





    <!-- footer -->
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



