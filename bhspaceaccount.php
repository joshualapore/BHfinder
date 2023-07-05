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
    $id__ = "";
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

  $dashboard = '<li class=""><a href="dashboard.php"><i class="fa fa-dashboard" style="color: #8bd8bd"></i> <span>Dashboard</span></a></li>';

  $client = '<li class=""><a href="clientaccounts.php"><i class="fa fa-users" style="color: #8bd8bd"></i> <span>Client Account</span></a></li>';

}else if ($userlevel == 'admin'){
   $admin="";

  $dashboard = '<li class=""><a href="dashboard.php"><i class="fa fa-dashboard" style="color: #8bd8bd"></i> <span>Dashboard</span></a></li>';

  $client = '';
  $admin ="";

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
         <?php echo $dashboard; ?>

        <li class=""><a href="profile.php"><i class="fa fa-user" style="color: #8bd8bd"></i> <span>Profile</span></a></li>
        <li class="active"><a href="bhspaceaccount.php"><i class="glyphicon glyphicon-home" style="color: #8bd8bd"></i> <span>BHspace</span></a></li>
      
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

 <?php
                        if (isset($_GET['message'])){

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


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 
    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->


























<div class="">
  
  <a href="bhspace.php" style="
                          font-size: 10pt;
                          padding-left: 10px;
                          padding-right: 10px;
                          border-radius: 40px;
              
                           border: rgba(58, 133, 191);
                           line-height: 20px;
                         " class="btn bg-olive text-info">Add a new listing</a>
  <br/> <br/>
</div>

                   
                
               

                    

                       
   








                

                   <?php
           require_once 'require/config.php';
           require_once 'require/functions.php';


            //sql command for fetching a record in a database
          $query = mysqli_query($conn, "SELECT  * FROM rentalaccount WHERE host_id = '$id' order by id DESC");
          $num_rows=mysqli_num_rows($query);
          //echo"Record count: ".$num_rows;
       
          //$row represents 1 row, assoc assosiative, 
           while ($row = mysqli_fetch_assoc($query)) 

            {
                // output data of each row
                                
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

                                $id_ = $row['id'];

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];
                             
   
                # code...
        
            ?>
               
  
  <div class="jumbotron" style="background: #212b34; color: white">







<table class="form-group">
  
  <tbody>
    <tr>
      <td>
        <span style="font-family: Verdana;font-size: 24pt;color: gold;"><?php echo $rental_name; //$rental_name; ?></span>
      </td>
    </tr>
  </tbody>
</table>
<table>


<tbody>
   

    <tr>
      <td>
        <span style="font-family:Andale Mono;font-size: 12pt">Contact</span>
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



<table>

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold;">Address</td>
      </tr>

      <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php echo  $street . ",  Barangay ". $barangay.",  ". $citymunicipality."<br/>". $zipcode. "  ". $regionprov. ",  ".$country; ?></span>
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
    <br/>
       <form method="post">
                 <a title='change Number of Space' style="font-family:Andale Mono;font-size: 8pt" href="rentalspaceavail.php?spaceavail=<?php echo $row['id']; ?>"   >Change Number of Space&nbsp;<i class='glyphicon glyphicon-cog' style='color: #8bd8bd'></i></a>
                   </form>
    </tr>
             

    
            

    
    
  </tbody>

</table>
<br/>

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
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold;"> Vacancy</td>
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
    <td><br/></td>
  </tbody>

</table>

<table>
    

    <tbody>

      <tr>
        <td style="font-family:Andale Mono;font-size: 14pt;color: gold;">Status</td>
      </tr>

    <tr>

      <td>
        <span style="font-family:Andale Mono;font-size: 12pt"><?php 
        if ($row['availability'] === 'Open') {
          # code...
       
       echo "
       
       <span class='text-success'>".$row['availability']."</span> <br/>";?>

       <form method="post">
                                        <a title='change rental status' style="font-family:Andale Mono;font-size: 8pt" href="rentalopenclosed.php?starr=<?php echo $row['id']; ?>"   >Change Status&nbsp;<i class='glyphicon glyphicon-cog' style='color: #8bd8bd'></i></a>
                                    </form>
              <?php

          
            }
        else{
            echo "
       
       <span class='text-danger'>".$row['availability']."</span> <br/>";?>

       <form method="post">
                                        <a title='change rental status' style="font-family:Andale Mono;font-size: 8pt" href="rentalopenclosed.php?starr=<?php echo $row['id']; ?>"   >Change Status&nbsp;<i class='glyphicon glyphicon-cog' style='color: #8bd8bd'></i></a>
                                    </form>
              <?php

          
            }
        ?></span>
      </td> 
    </tr>

    
  </tbody>

</table>




      


          <div class="row">
            <hr/>

    
        <span style="font-family: Andale Mono;font-size: 14pt">&nbsp;Rental Image</span>

        <br/>
        <br/>

        <div class="col-md-3  form-group">


                        <?php 


                                if ($imga == ''){
                                   echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                                 
                                    echo '</div>';
                                    ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimga.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php

                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                   
                                    echo '</div>';
                                     ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimga.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php
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
                                     ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimgb.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                   

                                    echo '</div>';
                                     ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimgb.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php
                                }
                          
                        ?>



                      </div>

                      <div class="col-md-3  form-group">


                        <?php 

                      
                                if ($imgc == ''){
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                                          
                                    echo '</div>';
                                     ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimgc.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                     

                                    echo '</div>';
                                     ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimgc.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php
                                }
                           
                        ?>



                      </div>


                      <div class="col-md-3  form-group">


                        <?php 

                      
                                if ($imgd == ''){
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                                           
                                    echo '</div>';
                                     ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimgd.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover; height:200px; width: 200px;">&nbsp;</div>';
                                  

                                    echo '</div>';
                                     ?>
                                    <form method="post">
                                        <a title='Upload new image' style="font-family:Andale Mono;font-size: 8pt" href="rentalimgd.php?edit=<?php echo $row['id']; ?>"   >Change Image&nbsp;<i class='fa fa-file-picture-o' style='color: #8bd8bd'></i></a>
                                    </form>
                                    <?php
                                }
                           
                        ?>



                      </div>




                      <div class="container"> 
                      <form method="post">

                      <input  type="hidden" name="id" value="<?php echo $row['id']; ?>">

                      

                            <a style="width: 100px"  class="btn bg-olive"  href="bhspaceedit.php?edit=<?php echo $row['id']; ?>"   >Edit</a>



                        <input style="width: 100px" type='submit' name='delete_button' id='delete_button' class="btn bg-maroon"  value='Delete' onclick='confirmation();return false;'>
                    </form>
                  </div>


                    </div>




</div>




                <?php }//ending tag of while ?>













  
  


 



  



                              <?php

                             //Delete account
                            if (isset($_POST['delete_button'])){

                          $id=$_POST['id'];
                          mysqli_query($conn, "DELETE FROM rentalaccount WHERE id=".$id);
                             
                               echo '

                              <script>
                                (function() {
                                  
                                  window.location.href = window.location.href;
                                  
                                })();
                                </script>
                                ';
                          }



                          
                        ?>


<script type="text/javascript">


    function confirmation()
     {
            if(confirm("Are you sure you want to delete rental account?")==1)
        {
            document.getElementById('delete_button').submit();
        }
        
    }


 </script>








  
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


</div>
</body>
</html>

