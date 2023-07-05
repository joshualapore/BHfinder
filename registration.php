<?php
    
    require_once 'require/config.php';
    require_once 'require/functions.php';
    require_once 'libraries/PHPMailer-master/PHPMailerAutoload.php';

    $error = NULL;

    // define variables and set to empty values
    $name = $username = $email  = $password = $confirm_password = "";
    $nameErr = $usernameErr = $emailErr = $passwordErr = $confirm_passwordErr = "";



    //$name = $username = $email = $website = $password = $confirm_password = "";
   // $nameErr = $usernameErr = $emailErr = $websiteErr = $passwordErr = $confirm_passwordErr = "";


    $count = 0;
    $msg = '';
    
    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $name = test_input($_POST["name"]);
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        //$website = test_input($_POST["website"]);
        $password = test_input($_POST["password"]);
        $confirm_password = test_input($_POST["confirm_password"]);
        
        //Validating our name
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $count++;
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed"; 
                $count++;
            }
        }
        
        //Validating our username

        if(strlen(trim($username)) < 4 != NULL){
            $usernameErr = "Username must be atleast 4 characters";
            $count++;
        }
        if (empty($_POST["username"])) {
            $usernameErr = "Username is required";
            $count++;
        } else {
            $username = test_input($_POST["username"]);
            //check if email exist
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $usernameErr = "Username already exists in database";
                $username = "";
                $count++;
            }
        }
        
        //Validating our email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $count++;
        } else {
            $email = test_input($_POST["email"]);
            
            //check if email exist
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $emailErr = "Email already exists in database";
                $email = "";
                $count++;
            } else {
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    $count++;
                }
            }
        }
        
        //Validating our website
        /*
        if (empty($_POST["website"])) {
            $websiteErr = "Website is required";
            $count++;
        } else {
            $website = test_input($_POST["website"]);
            // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                $websiteErr = "Invalid URL. You need to provide www. before your domain name"; 
                $count++;
            }
        }
        */


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
        
        if (empty($_POST["confirm_password"])) {
            $confirm_passwordErr = "Please confirm your password";
            $count++;
        } else {
            $confirm_password = test_input($_POST["confirm_password"]);
            //Check if the confirm password match the password
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

            //hashing the password before inserting it into database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //generating a random reset code
            $reset_code = md5(crypt(rand(), 'aa'));
            
            //Inserting data into database
           // $sql = "INSERT INTO users (name, email, username, password, website, created_at, reset_code, is_active)
            //VALUES ('$name', '$email', '$username', '$hashed_password', '$website', " . time() . ", '$reset_code', 0)";


             $sql = "INSERT INTO users (name, email, username, password, created_at, reset_code, is_active, userlevel)
            VALUES ('$name', '$email', '$username', '$hashed_password',  " . time() . ", '$reset_code', 0, 'user')";

            if ($conn->query($sql) === TRUE) {
               $msg = "<p class='text-success'>Your account has been created successfully. Please check your email to verify your account</p>";

                
                
                $message = "
                <html>
                    <body style='font-family: Arial, Helvetica, sans-serif;
                                        line-height:1.8em;''>
                    <h2>BHfinder</h2>
                    <p>Dear ".$username.", <br><br>Thank you for registering, please click on the link below to
                        confirm your email address</p>

                <br> 
                <a href='http://localhost/bhfinder/process/account_verify.php?code=$reset_code'>Click here to verify</a> <br/><br/><br/>  [THIS IS AN AUTOMATED MESSAGE - <b>PLEASE DO NOT REPLY</b>].

                 </body>
                    </html>";
                
                //sending email to the user
                send_mail($email, $message);
                
               // $name = $username = $email = $website = $password = $confirm_password = '';
                 $name = $username = $email = $password = $confirm_password = '';
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo 'Something went wrong';
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


<body class="hold-transition skin-blue constainer-fluid" onload="disableSubmit()">
  
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
    </a>
            </div>
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



                <form class="text-monospace" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="name" placeholder="Full name" value="<?php echo $name; ?>">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="error form-text text-danger"><?php echo $nameErr; ?></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="error form-text text-danger" ><?php echo $usernameErr; ?></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span class="error form-text text-danger"><?php echo $emailErr; ?></span>
                    </div>


                   

                <!--
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="website" placeholder="Website" value="<?php //echo $website; ?>">
                        <span class="error form-text"><?php //echo $websiteErr; ?></span>
                    </div>
                -->
                    <div class="form-group has-feedback">
                        <input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span class="error form-text text-danger"><?php echo $passwordErr; ?></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="password" name="confirm_password" placeholder="Confirm your password" value="<?php echo $confirm_password; ?>">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span class="error form-text text-danger"><?php echo $confirm_passwordErr; ?></span>
                    </div>
                    <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
             &nbsp; &nbsp; &nbsp; <input type="checkbox" name="agree" onchange="activateButton(this)"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>



       
        <!-- /.col -->
        <div class="col-xs-4">
          <button class="btn btn-primary btn-block"  type="submit" id="btn1">Sign Up</button>
        </div>
        <!-- /.col -->
      </div>
                    
                </form>
                <hr/>


<!--
            <div class="social-auth-links text-center">

      <a href="#" class="btn btn-block btn-social btn-facebook "><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google "><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>
  -->

    <a href="login.php"  class="form-text text-muted" >Already have an account? Login here.</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
  
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

  <?php echo $error;?>

</body>
</html>


  




<!-- jQuery 3 -->

<script src="assets/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>




<script type="text/javascript">
 function disableSubmit() {
  document.getElementById("btn1").disabled = true;
 }

  function activateButton(element) {

      if(element.checked) {
        document.getElementById("btn1").disabled = false;
       }
       else  {
        document.getElementById("btn1").disabled = true;
      }

  }
</script>







