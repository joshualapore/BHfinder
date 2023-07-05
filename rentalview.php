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

  $admin = '<li class=""><a href="adminaccounts.php"><i class="fa fa-users"  style="color: #8bd8bd"></i> <span>Admin Account</span></a></li>';

  $dashboard = '<li class="active"><a href="dashboard.php"><i class="fa fa-dashboard" style="color: #8bd8bd"></i> <span>Dashboard</span></a></li>';

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
                                //$ownername = $row['ownername'];
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
                                $host_email = $row['host_email'];
                                $active= $row['active'];
                                $createdat = $row['createdat'];
                               

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];




                   ?>









                

               
<div class="container">
  
  <div class="jumbotron" style="background: #212b34; color: white">









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


<table >
  

 

<tbody>
    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt;color: gold">User id</span>
      </td>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">&nbsp;:&nbsp;</span>
      </td>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo $id_; ?></span>
      </td>
    </tr>

    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt;color: gold">Host id</span>
      </td>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">&nbsp;:&nbsp;</span>
      </td>
      <td>
        <span style="font-family:Andale Mono;font-size: 10pt"><?php echo $host_id; ?></span>

      </td>

    </tr>
    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt;color: gold">Username</span>
      </td>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">&nbsp;:&nbsp;</span>
      </td>
      <td>
        <span style="font-family:Andale Mono;font-size: 10pt"><?php echo $host_username; ?></span>

      </td>

    </tr>

    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt;color: gold">Email</span>
      </td>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">&nbsp;:&nbsp;</span>
      </td>
      <td>
        <span style="font-family:Andale Mono;font-size: 10pt"><?php echo $host_email; ?></span>

      </td>

    </tr>

  </tbody>

   
 
                             
                        


  
</table>

<hr/>
<table >
  

 

<tbody>
    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt;color: gold">Active</span>
      </td>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">&nbsp;:&nbsp;</span>
      </td>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo $active; ?></span>
      </td>
    </tr>

    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt;color: gold">Created</span>
      </td>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">&nbsp;:&nbsp;</span>
      </td>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">
          <?php 
                                if($createdat == ''){
                                  echo'';
                                }else{

                                echo(date("m-d-Y",$createdat));} ?></span>
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
        <span style="font-family:Andale Mono;font-size: 12pt"><?php 


       
        echo "₱ ". number_format($price,2);

        ?></span>
      </td> 
    </tr>
  </tbody>

</table>
<br/>


<table>
    

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold;">Status</td>
      </tr>

    <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">

          <?php 

        if ($row['availability'] === 'Open') {
    
       echo " <span class='text-success'>".$row['availability']."</span> <br/>";}

        else{
            echo "
       
       <span class='text-danger'>".$row['availability']."</span> <br/>";}

     
        ?>

      </span>

      </td> 
    </tr>

    
  </tbody>

</table>




      


          <div class="row">
            <hr/>

    
        <span style="font-family: Andale Mono;font-size: 14pt;color: gold">Rental Image</span>

        <br/>
        <br/>

        <div class="col-md-3  form-group">


                        <?php 


                                if ($imga == ''){
                                   echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                                 
                                    echo '</div>';
                                    

                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                   
                                    echo '</div>';
                                    
                                }
                           // } else {
                               // echo "0 results";
                           // }
                        ?>



                      </div>

                       <div class="col-md-3  form-group">


                        <?php 

                        
                                if ($imgb == ''){
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                                              
                                    echo '</div>';
                                    
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                   

                                    echo '</div>';
                                    
                                }
                          
                        ?>



                      </div>

                      <div class="col-md-3  form-group">


                        <?php 

                      
                                if ($imgc == ''){
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                                          
                                    echo '</div>';
                                    
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                     

                                    echo '</div>';
                                    
                                }
                           
                        ?>



                      </div>


                      <div class="col-md-3  form-group">


                        <?php 

                      
                                if ($imgd == ''){
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                                           
                                    echo '</div>';
                                    
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                  

                                    echo '</div>';
                                    
                                }
                           
                        ?>



                      </div>




                      <div class="container"> 
                      <form method="">

                    

                      

                           
                            <a class="btn btn-info  " role="button" href="#" data-toggle="modal" data-target="#userModal" title="Accept account type">
                                        <i class="fa fa-user"  ></i>
                                    </a>



                        <a class="btn btn-danger " role="button" href="#" data-toggle="modal" data-target="#exampleModal" title="Delete rental account">
                                    <i class="glyphicon glyphicon-trash" style="margin-right: 0px;"></i>
                                </a>
                    </form>
                  </div>


                    </div>






          
















  </div>




</div>




              








</div>

















                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title text-info text-center" id="exampleModalLabel">Delete Rental Account</h3>
                                            
                                        </div>
                                        <div class="modal-body">
                                        <h4>Do you really want to rental delete this rental account?</h4>
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


                            <!-- Modal -->

                            <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title text-info text-center" id="userModalLabel">Confirm rental account</h3>
                                            
                                        </div>
                                        <div class="modal-body">
                                        <h4>Choose access</h4>

                                        <form class="text-monospace" method="post" action="">

                                          <div class="radio">
                                          <label><input type="radio" name="confirm" value="1">Yes</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" name="confirm" value="0" checked>No</label>
                                        </div>

                                        <input id="rrr" type="submit" name="active" value="Save" class="btn btn-success" >
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
                            if(isset($_POST['active'])){
                              
                              $active = mysqli_real_escape_string($conn, $_POST['confirm']);


                           

                               if ($active =='1'){


                                   mysqli_query($conn, "UPDATE rentalaccount set active ='$active' where id=".$idd);




                                 $message = "
                          <html>
                              <body style='font-family: Arial, Helvetica, sans-serif;
                                                  line-height:1.8em;''>
                              <h2>BHfinder</h2>
                              <p>Dear ".$host_username.", <br><br>Your rental space is verified, <br/>Thank for registering.</p>

                          <br/> 
                         <br/>  [THIS IS AN AUTOMATED MESSAGE - <b>PLEASE DO NOT REPLY</b>].

                           </body>
                              </html>";
                          
                          //sending email to the user
                          send_mail($host_email, $message);

                           echo '

                              <script>
                                (function() {
                                  
                                  window.location.href = window.location.href;

                                 
                                  
                                })();
                                </script>
                                ';
                          
                        
                      }

                      if ($active =='0'){


                                   mysqli_query($conn, "UPDATE rentalaccount set active ='$active' where id=".$idd);




                                 $message = "
                          <html>
                              <body style='font-family: Arial, Helvetica, sans-serif;
                                                  line-height:1.8em;''>
                              <h2>BHfinder</h2>
                              <p>Dear ".$host_username.", <br><br>Something wrong with your rental space, <br/>please recheck your rental information.</p>

                          <br/> 
                         <br/>  [THIS IS AN AUTOMATED MESSAGE - <b>PLEASE DO NOT REPLY</b>].

                           </body>
                              </html>";
                          
                          //sending email to the user
                          send_mail($host_email, $message);

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
                              $sql = "DELETE FROM rentalaccount WHERE id=".$idd;

                              if ($conn->query($sql) === TRUE) {
                                 echo '

                              <script>
                                (function() {
                                  
                                 window.top.location="dashboard.php";

                                 
                                  
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

