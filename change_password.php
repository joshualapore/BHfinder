<?php
    session_start();

    require_once 'require/config.php';
    require_once 'require/functions.php';

    // define id variable and set to session value
    $id = $_SESSION['id'];

    // define variables and set to empty values
    $old_password = $new_password = $new_confirm_password = "";
    $old_passwordErr = $new_passwordErr = $new_confirm_passwordErr = "";

    $count = 0;
    $msg = '';

    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $old_password = test_input($_POST["old_password"]);
        $new_password = test_input($_POST["new_password"]);
        $new_confirm_password = test_input($_POST["new_confirm_password"]);



        
        //Validate the old password
        if (empty($_POST["old_password"])) {
            $old_passwordErr = "Old password is required";
            $count++;
        } else {
            $old_password = test_input($_POST["old_password"]);
            
            //Check if the old password is the correct one
            $sql = "SELECT password FROM users WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();


                //If passwords don't match
                if(!password_verify($old_password, $row['password'])){
                    $old_passwordErr = "Your password is not correct";
                    $old_password = '';
                    $count++;
                }
            } else {
                echo "0 results";
            }
        }
        
        //Validate the new password
        if (empty($_POST["new_password"])) {
            $new_passwordErr = "New password is required";
            $count++;
        } else {
            $new_password = test_input($_POST["new_password"]);


            //If the password is the same as the current password
            if($new_password == $old_password){
                $new_passwordErr = "New password can't be same like the old password";
                $new_password = "";
                $count++;
            }
            else if(strlen(trim($new_password)) < 6 != NULL){
            $new_passwordErr = "Password must be atleast 6 characters";
            $count++;
        } else {
                $new_password = test_input($_POST["new_password"]);
            }
        }


        
        //Validate the confirm password
        if (empty($_POST["new_confirm_password"])) {
            $new_confirm_passwordErr = "Please confirm your password";
            $count++;
        } else {
            $new_confirm_password = test_input($_POST["new_confirm_password"]);
            //If the passwords are not the same
            if($new_confirm_password != $new_password){
                $new_confirm_passwordErr = "Password does not match";
                $new_confirm_password = "";
                $count++;
            } else {
                $new_confirm_password = test_input($_POST["new_confirm_password"]);
            }
        }
        
        //If we are free of errors
        if($count == 0){
            //hashing the password before inserting it into database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            //Update information in the database
            $sql = "UPDATE users SET password = '$hashed_password' WHERE id = '$id'";

            if ($conn->query($sql) === TRUE) {
                
                $msg = "<p class='text-success'>Your password has been changed successfully</p>";



                header("Location: profile.php?message=$msg");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }// End of IF



   $sqll = "SELECT userlevel FROM users WHERE id = '$id'";
$resultt = $conn->query($sqll);
$resulttt = $conn->query($sqll);
$row = $resultt->fetch_assoc();
$userlevel = $row['userlevel'];





if ($id == 99 && $userlevel =='super' ) {

  $admin = '<li class=""><a href="adminaccounts.php"><i class="fa fa-users"  style="color: #8bd8bd"></i> <span>Admin Account</span></a></li>';

  $dashboard = '<li class=""><a href="dashboard.php"><i class="fa fa-dashboard" style="color: #8bd8bd"></i> <span>Dashboard</span></a></li>';

  $client = '<li class=""><a href="clientaccounts.php"><i class="fa fa-users" style="color: #8bd8bd"></i> <span>Client Account</span></a></li>';

}else if ($userlevel == 'admin'){
   $admin="";

  $dashboard = '<li class=""><a href="dashboard.php"><i class="fa fa-dashboard" style="color: #8bd8bd"></i> <span>Dashboard</span></a></li>';

  $client = '';

} else{
  $admin ="";
  $dashboard = '';
  $client = '';
}

                        
if ($resulttt->num_rows > 0) {
$roww = $resulttt->fetch_assoc();
$userlevel = $roww['userlevel'];




}
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BHfinder</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">
 

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
      

    <!-- Logo -->
    <a href="#" class="logo" style="background-color: #3c8dbc">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="
      color: #243665"><b style="color: #3d155f">B</b><b style="color: #df678c">H</b>f</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="color: #4eac8b"><b style="color: #3d155f">B</b><b style="color: #df678c">H</b><span style="
      color: #243665">find</span>er</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
     
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          

 <?php include("faq.php"); ?>

 <!-- User Account Menu -->


 <?php 
 $sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);





echo '<li class="dropdown user user-menu">';

echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                        
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$image = $row['image'];
$user_ = $row['username'];
$email_ = $row['email'];
if ($image == ''){

echo '
<img src="images/profileauto.jpg" class="user-image" alt="User Image">
<span class="hidden-xs">'.$user_.'</span>
</a>
<ul class="dropdown-menu">
<li class="user-header">
<img src="images/profileauto.jpg" class="img-circle" alt="User Image">
<p>
            '.$user_.'
            <small>'.$email_.'</small>
      </p>
</li>

        <li class="user-body">
                <div class="row">
                  <div class=" text-center">
                    <span class= "date--">
                   


                    </span>
                  </div>
              </li>
';


} else {

    echo '
<img src="images/' . $image . '" class="user-image" alt="User Image">
<span class="hidden-xs">'.$user_.'</span>
</a>
<ul class="dropdown-menu">
<li class="user-header">
<img src="images/' . $image . '" class="img-circle" alt="User Image">
<p>
            '.$user_.'
            <small>'.$email_.'</small>
      </p>
</li>

        <li class="user-body">
                <div class="row">
                  <div class=" text-center">
                    <span class= "date--">
                   


                    </span>
                  </div>
              </li>
';


}
} else {
 echo "0 results";
}
?>







            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-flat" style="color: black">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php"" class="btn  btn-flat" style="color: black">Log out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

    

      <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Main Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <?php echo $dashboard; ?>

        <li class="active"><a href="profile.php"><i class="fa fa-user" style="color: #8bd8bd"></i> <span>Profile</span></a></li>
        <li class=""><a href="bhspaceaccount.php"><i class="glyphicon glyphicon-home" style="color: #8bd8bd"></i> <span>BHspace</span></a></li>
      
        <li class=""><a href="search.php"><i class="fa fa-search" style="color: #8bd8bd"></i> <span>Search</span></a></li>
       

        <?php echo $client; ?>

         <?php echo $admin; ?>
         <li class=""><a href="recivmsg.php"><i class="fa fa-envelope-o" style="color: #8bd8bd"></i> <span>Message</span>
         <?php


$quer = mysqli_query($conn, "SELECT  * from usermsg WHERE receiverusername ='$user_' ");
          
      
  $counter = 0;

  while ($row = mysqli_fetch_assoc($quer)) 
            {
              $counter +=  $row['msgcount'];
            }
            if ($counter !== 0) {
               echo "<span class='label label-info'> ". $counter ."</span>";
            
            }else
            echo "";
            ?></a></li>

        <!--
        <li class="<?php// echo $admin_; ?>"><a href="adminaccounts.php"><i class="fa fa-users"></i> <span>Admin Account</span></a></li>
         <li class="treeview <?php// echo $admin_; ?>">
          <a href="accounts.php"><i class="fa fa-users"></i> <span>Accounts</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="adminaccounts.php">Admin</a></li>
              <li><a href="clientaccounts.php">Client</a></li>
          </ul>
        </li>

      -->
      
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

<br/>

 <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->








    
            <div class="hold-transition ">
        <div class="login-box">
                <div class="text-monospace block-heading">
                    <h3 class="text-info text-center">Change password</h3>
                    
                </div>
                <form class="text-monospace" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group has-feedback">
                        <input class="form-control" type="password" name="old_password" value="<?php echo $old_password; ?>" placeholder="Enter your old password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span class="error form-text text-danger"><?php echo $old_passwordErr; ?></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="password" name="new_password" value="<?php echo $new_password; ?>" placeholder="Enter your new password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span class="error form-text text-danger"><?php echo $new_passwordErr; ?></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="password" name="new_confirm_password" value="<?php echo $new_confirm_password; ?>" placeholder="Confirm your new password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span class="error form-text  text-danger"><?php echo $new_confirm_passwordErr; ?></span>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Change password</button>
                </form>
            </div>
        </div>

    
   




















        </section>

   
</div>


  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
   
    <!-- Default to the left -->
    <strong >Copyright &copy; 2019 <a href="#">BHfinder.com</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>