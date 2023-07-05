<?php
    session_start();

    require_once 'require/config.php';
    require_once 'require/functions.php';

    $id = $_SESSION['id'];

    $msg = '';
    $success = 0;

   function getid(){

  $idd = $_GET['edit'];
  return $idd;

}



$error = NULL;


    // Check if image file is a actual image or fake image
    if (isset($_POST['ok'])) {

       $idd = getid();

    $id_ = number_format($idd);



        
        $file = $_FILES['file'];
        $filename = $_FILES['file']['name'];
        $fileTmpname = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
        $fileSize = $_FILES['file']['size'];
        
        //Explode file name with the extension
        $fileExt = explode('.', $filename);
        //Transform everything to lowercase
        $fileActualExt = strtolower(end($fileExt));
        
        $allowed = array('jpg', 'jpeg', 'png');
        
        //If extension is inside the array
        if(in_array($fileActualExt, $allowed)){
            //if we are free of errors
            if($fileError === 0){
                //If the file size is lesser that 10000000KBs
                if($fileSize < 10000000){
                    //Generate a unique name based in nanoseconds
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    //Define the destination of the file to be stored
                    $fileDestination = 'rentalimage/'.$fileNameNew;
                    //Upload the image to destination
                    if(move_uploaded_file($fileTmpname, $fileDestination)){
                        $success = 1;
                        //Update database image column with the fileNameNew

                        //$sql = "INSERT INTO `rentalaccount` (rental_imgd) VALUES ('$fileNameNew') WHERE id = '$idd'";
                      $sql = "UPDATE rentalaccount SET rental_imgc = '$fileNameNew' WHERE id = '$id_'";
                        if ($conn->query($sql) === TRUE) {
                            $msg = "<p class='text-success'>Rental image has been changed</p>";
                            header("Location: bhspaceaccount.php?message=$msg");
                            exit();
                        } else {
                            echo "Error updating record: ".$sql . $conn->error;
                        }
                    } else {
                        $success = 0;
                        $msg = "Your file failed to upload";
                    }
                } else {
                    $success = 0;
                    $msg = "Your file is too large";
                }
            } else {
                $success = 0;
                $msg = "There was an error uploading your file";
            }
        } else {
            $success = 0;
            $msg = "You cannot upload files of this type<br>Please select a File";
        }
    }






   $sqll = "SELECT userlevel FROM users WHERE id = '$id'";
$resultt = $conn->query($sqll);
$resulttt = $conn->query($sqll);
$row = $resultt->fetch_assoc();
$userlevel = $row['userlevel'];





if ($id == 99 && $userlevel =='super' ) {

  $admin = '<li class="active"><a href="adminaccounts.php"><i class="fa fa-users"  style="color: #8bd8bd"></i> <span>Admin Account</span></a></li>';

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

        <li class=""><a href="profile.php"><i class="fa fa-user" style="color: #8bd8bd"></i> <span>Profile</span></a></li>
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
   


    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->




        <div class="hold-transition ">
        <div class="login-box">
                <div class="text-monospace block-heading">
                    <h4 class="text-info">Select an image to upload</h4>
                    
                    <?php 
                        if($success == 1){
                            if($msg != ''){
                                echo '<hr>';
                                echo '<div class="alert alert-success" role="alert">';
                                echo  $msg;
                                echo '</div>';
                            }
                        } else {
                            if($msg != ''){
                                echo '<hr>';
                                echo '<div class="alert alert-danger" role="alert">';
                                echo  $msg;
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
                <form class="text-monospace" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="form-control" type="file" name="file">
                    </div>
                    <button class="btn btn-primary btn-block" name="ok" type="submit">Upload image</button>
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
    