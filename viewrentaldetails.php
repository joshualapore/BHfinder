<?php 
    session_start();

    require_once 'require/config.php';
    require_once 'require/functions.php';
    
    //Check if the user is not logged in
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }

    //Define variables and set them to empty values
    $name = $username = $email = $created_at = '';

    // define id variable and set to session value
    $id = $_SESSION['id'];
    $user__ = $_SESSION['username'];

    $msg = '';


$sqll = "SELECT userlevel FROM users WHERE id = '$id'";
$resultt = $conn->query($sqll);
$resulttt = $conn->query($sqll);
$row = $resultt->fetch_assoc();
$userlevel = $row['userlevel'];


$error = NULL;



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







    $count = 0;
    $msg = '';
    
 

?>













<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RentalAccount | BHfinder</title>
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











 <div class="container">
                    <?php
                        if (isset($_GET['message'])){
                            echo '<hr>';
                            echo '<div class="alert alert-success" role="alert">';
                            echo  $_GET['message'];
                            echo '</div>';
                        }
                    ?>
                
                <div class="row">

                
                  
                 

                    <div class="col-md-6">


                      <?php
                       require_once 'require/config.php';

                       
                       
                       if (isset($_GET['view']))
                         {
                          $query2 = mysqli_query($conn, "select * from rentalaccount where id=".$_GET['view']);
                          $row = mysqli_fetch_assoc($query2);
                         
                        }

                        $id = $_GET['view'];

                        $idd = $id;
                                $id_ = $row['id'];
                               // $ownername = $row['ownername'];
                                $contact = $row['contact'];
                                $rental_name = $row['rental_name'];
                                $barangay = $row['barangay'];
                                $street = $row['street'];
                                $citymunicipality = $row['citymunicipality'];
                                $regionprov = $row['regionprov'];
                                $country = $row['country'];
                                $zipcode = $row['zipcode'];
                                $vacancytype = $row['vacancytype'];
                                $price = $row['price'];
                                 $rentalspaceavail= $row['rentalspaceavail'];
                                $rentalrentee = $row['rentalrentee'];

                                $host_id  = $row['host_id'];
                                $host_username = $row['host_username'];
                                $active= $row['active'];
                                $createdat = $row['createdat'];
                               

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];




                   ?>









                

               
<div class="container">
  
  <div class="jumbotron" style="background: #212b34; color: white">





            <?php  

            $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];

                                 if ($imga == ''){
                                  
                                    $pica =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:500px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $pica =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:500px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgb == ''){
                                  
                                    $picb =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:500px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picb =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:500px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgc == ''){
                                  
                                    $picc =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:500px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picc =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:500px; width: 100%;"></div>';
                                   
                                }

                                if ($imgd == ''){
                                  
                                    $picd =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:500px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picd =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover;height:500px; width: 100%;" ></div>';
                                   
                                }

                                
                      


                                    ?>





<div class="row">
                                    <div class="col-md-5">
                                  <div id="imgnxt" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#imgnxt" data-slide-to="0" class="active"></li>
                                      <li data-target="#imgnxt" data-slide-to="1"></li>
                                      <li data-target="#imgnxt" data-slide-to="2"></li>
                                      <li data-target="#imgnxt" data-slide-to="3"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">

                                      <div class="item active img-rounded">
                                      <?php echo $pica; ?>
                                      </div>

                                      <div class="item img-rounded">
                                        <?php echo $picb; ?>
                                      </div>
                                    
                                      <div class="item img-rounded">
                                        <?php echo $picc; ?>
                                      </div>

                                      <div class="item img-rounded">
                                        <?php echo $picd; ?>
                                      </div>

                                    </div>
                                   

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#imgnxt" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left"></span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#imgnxt" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right"></span>
                                      <span class="sr-only">Next</span>
                                    </a>

                                   
                                  </div>
                                </div>

                               



                                

                                  <div class="col-md-7 ">
                               
<table >
  
  <tbody>
    <tr>
      <td>
        <span style="font-family: Verdana;font-size: 24pt;color: gold"><?php echo $rental_name; //$rental_name; ?></span>
      </td>
    </tr>
  </tbody>
</table>

<table>


<tbody>
   

    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt;color: gold">Contact</span>
      </td>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">&nbsp;:&nbsp;</span>
      </td>
      <td>
        <span style="font-family:Andale Mono;font-size: 10pt"><?php echo $contact; ?></span>

      </td>

    </tr>

  </tbody>


  
</table>












<hr/>



<table>

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold">Address</td>
      </tr>

    <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo  $street . ", ". $barangay.",  ". $citymunicipality."<br/>". $zipcode. "  ". $regionprov. ",  ".$country; ?></span>
      </td> 
    </tr>
    <tr>
      <td><br/></td>
    </tr>
  </tbody>

</table>
<table>
    

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold;">Number of Space Available</td>
      </tr>

    <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo $rentalspaceavail; ?></span>
      </td> 
    </tr>

    
    <td><br/></td>
  </tbody>

</table>

<table>
    

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold;">Max Number of Guest</td>
      </tr>

    <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo $rentalrentee; ?></span>
      </td> 
    </tr>

    
    <td><br/></td>
  </tbody>

</table>


<table>
    

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold"> Vacancy</td>
      </tr>

    <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo $vacancytype; ?></span>
      </td> 
    </tr>

     <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2); ?></span>
      </td> 

    </tr>
  
  </tbody>

</table>
<hr/>
<table>
    

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold">Status</td>

       
      </tr>

    <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php

        if ($row['availability'] == "Open")
         echo "<span class='text-success'>".$row['availability']."</span"; 
       else 
         echo "<span class='text-danger'>".$row['availability']."</span"; 
         ?></span>
      </td> 


      
    </tr>

     
  </tbody>

</table>
<hr/>
<form method="post">
 

   <a class="btn btn-primary" href="sendmsg.php?send=<?php echo $row["id"];?>">Send Message</a>
  
</form>
                                      

                                   


                                      

                                    
                                    
                                  </div>


                            
                              </div>

    
    



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




































 <!-- Trigger the modal with a button -->
 



























<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>

