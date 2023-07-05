<?php 
    session_start();

    require_once 'require/config.php';
    require_once 'require/functions.php';
    require_once 'libraries/PHPMailer-master/PHPMailerAutoload.php';
    
    //Check if the user is not logged in
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }

    //Define variables and set them to empty values
    $name =  $created_at = '';

    // define id variable and set to session value
    $id = $_SESSION['id'];

    $msg = '';
   
   


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

  echo "<script>


function hideSaveBtn() {
  document.getElementById('changeuserlevel').disabled = true;
}

</script>";

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
                  <a href="profile.php" class="btn btn-flat style="color: black">Profile</a>
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
    <!-- Content Header (Page header) -->




 <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->










































  <div class="jumbotron" style="background: #212b34; color: white">
                    <?php
                        if (isset($_GET['message'])){
                            echo '<hr>';
                            echo '<div class="alert alert-success" role="alert">';
                            echo  $_GET['message'];
                            echo '</div>';
                        }
                    ?>
                
                <div class="row">

                
                    <div class="col-md-4">

                      <?php
                       require_once 'require/config.php';

                         if (isset($_GET['view']))
                         {
                          $query22 = mysqli_query($conn, "SELECT image FROM users WHERE id=".$_GET['view']);
                          
                            if ($query22->num_rows > 0) {
                                $row22 = mysqli_fetch_assoc($query22);
                                $image = $row22['image'];
                                if ($image == ''){
                                    echo '<div class="image-box">';
                                    echo    '<div class="img" style="background-image: url(&quot; images/profileauto.jpg &quot;);background-position: center;background-size: cover; height:300px; width: ;">&nbsp;</div>';
                                                                        
                                    echo '</div>';
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img" style="background-image: url(&quot;images/' . $image . '&quot;);background-position: center;background-size: cover; height:300px; width: ;">&nbsp;</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "0 results";
                            }
                          }
                        ?>
                    </div>
                 

                    <div class="col-md-6" >


                      <?php
                       require_once 'require/config.php';

                       
                       
                       if (isset($_GET['view']))
                         {
                          $query2 = mysqli_query($conn, "select * from users where id=".$_GET['view']);
                          $row2 = mysqli_fetch_assoc($query2);
                         
                        }
                        $id = $_GET['view'];

                        $idd = $id;

                          ?>

                        


                        <h2 class="" style="color: gold"><?php echo $row2['name'];?></h2>
                        
                        <div class="getting-started-info">
                            <table style="color: white">
 
                              <tr>
                                <td><h4 style="color: #6cc5e9">Username</h4></td>
                                <td><h4 style="color: #6cc5e9">&nbsp;:</h4></td>
                                <td><h4 style="margin-left: 3%;"><?php echo $row2['username'];?></h4></td>
                              </tr>
                              <tr>
                                <td><h4 style="color: #6cc5e9">Email</h4></td>
                                <td><h4 style="color: #6cc5e9">&nbsp;:</h4></td>
                                <td><h4 style="margin-left: 3%;"><?php echo $row2['email'];?></h4></td>
                              </tr>

                             

                              <tr>
                                <td><h4 style="color: #6cc5e9">Account type</h4></td>
                                <td><h4 style="color: #6cc5e9">&nbsp;:</h4></td>
                                <td><h4 style="margin-left: 3%;"><?php echo $row2['userlevel'];?></h4></td>
                              </tr>

                               <tr>
                                <td><h4 style="color: #6cc5e9">Created at:</h4></td>
                                <td><h4 style="color: #6cc5e9">&nbsp;:</h4></td>
                                <td><h4 style="margin-left: 3%;"><?php 
                                if($row2['created_at'] == ''){
                                  echo'';
                                }else{

                                echo(date("m-d-Y",$row2['created_at']));} ?>
                                  

                                </h4></td>
                              </tr>

                              <tr>
                                <td><h4 style="color: #6cc5e9">is Active</h4></td>
                                <td><h4 style="color: #6cc5e9">&nbsp;:</h4></td>
                                <td><h4 style="margin-left: 3%;"><?php echo $row2['is_active'];?></h4></td>
                              </tr>

                              <tr>
                                <td><h4 style="color: #6cc5e9">id</h4></td>
                                <td><h4 style="color: #6cc5e9">&nbsp;:</h4></td>
                                <td><h4 style="margin-left: 3%;"><?php echo $row2['id'];?></h4></td>
                              </tr>

                              <tr>
                                <td><h4 style="color: #6cc5e9">Reset code</h4></td>
                                <td><h4 style="color: #6cc5e9">&nbsp;:</h4></td>
                                <td><h4 style="margin-left: 3%;"><?php

                                if($row2['reset_code'] == ''){
                                  echo'';
                                }else{

                                 echo $row2['reset_code'];
                               }

                                 ?></h4></td>
                              </tr>
                              
                              
                            </table>
                            
                        </div>







                        
                        <hr>
                        <div class="row">
                            <div class="col text-left">
                                <div class="btn-group" role="group" >
                                    <a class="btn btn-dark  " role="button" href="#" data-toggle="modal" data-target="#userModal" title="Change account type">
                                        <i style="color: #6cc5e9" class="fa fa-user" onclick="hideSaveBtn()" >&nbsp;</i>
                                    </a>
                                    
                                   
                                     <a class="btn btn-dark text-center border rounded shadow-lg " role="button" href="#" data-toggle="modal" data-target="#exampleModal" title="Delete account">
                                    <i style="color: #6cc5e9" class="glyphicon glyphicon-trash" style="margin-right: 0px;"></i>
                                </a>
                                </div>
                                
                            </div>

    
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title text-info text-center" id="exampleModalLabel">Delete Account</h3>
                                            
                                        </div>
                                        <div class="modal-body" style="color: black">
                                        <h4>Do you really want to delete this account?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            
                            <form class="text-monospace" method="post" action="">
                                 <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">No</span>
                                            </button>            
                             <input type="submit" name="deleteaccount_" value='Yes' class="btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title text-info text-center" id="userModalLabel">Change User level</h3>
                                            
                                        </div>
                                        <div class="modal-body" style="color: black">
                                        <h4>Choose account</h4>

                                        <form class="text-monospace" method="post" action="">

                                          <div class="radio">
                                          <label><input type="radio" name="account_" value="user">User</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" name="account_" value="admin" checked>Admin</label>
                                        </div>

                                        <input id="changeuserlevel" type="submit" name="changeuserlevel" value="Save" class="btn btn-success" onclick='confirme()'>
                                         </form>

                                        </div>

                                        <div class="modal-footer">
                                            
                            
                                 <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">Exit</span>
                                            </button>            
                             
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php

                            require_once 'require/config.php';

                            //update
                            if(isset($_POST['changeuserlevel'])){
                              
                              $userlevel = mysqli_real_escape_string($conn, $_POST['account_']);




                            

                              

                               if ($userlevel=='admin'){


                                   mysqli_query($conn, "UPDATE users set userlevel ='$userlevel' where id=".$idd);




                                 $message = "
                          <html>
                              <body style='font-family: Arial, Helvetica, sans-serif;
                                                  line-height:1.8em;''>
                              <h2>BHfinder</h2>
                              <p>Dear ".$row2['username'].", <br><br>Your account is now admin level, <br/>Hooah!..</p>

                          <br/> 
                         <br/>  [THIS IS AN AUTOMATED MESSAGE - <b>PLEASE DO NOT REPLY</b>].

                           </body>
                              </html>";
                          
                          //sending email to the user
                          send_mail($row2['email'], $message);

                           echo '

                              <script>
                                (function() {
                                  
                                  window.location.href = window.location.href;

                                 
                                  
                                })();
                                </script>
                                ';
                          
                        
                      } 

                       if ($userlevel=='user'){


                                   mysqli_query($conn, "UPDATE users set userlevel ='$userlevel' where id=".$idd);




                                 

                           $message = "
                          <html>
                              <body style='font-family: Arial, Helvetica, sans-serif;
                                                  line-height:1.8em;''>
                              <h2>BHfinder</h2>
                              <p>Dear ".$row2['username'].", <br><br>You've been demoted to user level, <br/>Thank you.</p>

                          <br/> 
                         <br/>  [THIS IS AN AUTOMATED MESSAGE - <b>PLEASE DO NOT REPLY</b>].

                           </body>
                              </html>";
                          
                          //sending email to the user
                          send_mail($row2['email'], $message);

                           echo '

                              <script>
                                (function() {
                                  
                                  window.location.href = window.location.href;

                                 
                                  
                                })();
                                </script>
                                ';
                          
                        
                      }

                        


                              
                            } 







                            if (isset($_POST['deleteaccount_'])){
                              //Delete account
                              $sql = "DELETE FROM users WHERE id=".$idd;

                              if ($conn->query($sql) === TRUE) {
                                 echo '

                              <script>
                                (function() {
                                  
                                  window.location.href = window.location.href;

                                 
                                  
                                })();
                                </script>
                                ';
                                 
                                 
                                 
                              } else {
                                  echo "Error deleting record: " . $conn->error;
                              }
                          }//End of IF


                            ?>









                             
                                      
                                    










                        </div>
                    </div>
                </div>



            </div>

   





























































        

    </section>
    <!-- /.content -->

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

<script type="text/javascript">

        
        function confirme()
     {
            if(confirm("Are you sure you want to change user level?")==1)
        {
            document.getElementById('changeuserlevel').submit();
            
        }
        
    }

         

    
        
    
 </script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>