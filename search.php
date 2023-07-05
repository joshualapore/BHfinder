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

    $msg = '';

    $error = NULL;

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
  <title>Search | BHfinder</title>
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


   <style type="text/css">
      input:focus {
    outline:none !important;

}

button:focus {
    outline:none !important;

}
  </style>
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
      
        <li class="active"><a href="search.php"><i class="fa fa-search" style="color: #8bd8bd"></i> <span>Search</span></a></li>
       

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
    <form  method="post" style="background-color: #212d32">
              <div class="container " style="width: 80%;">
                <br/>

      


                              <label class="form-group"  style="
                            font-size: 10pt;
                            margin: all;
                            border: 8px solid rgba(58, 133, 191);
   
                             border-radius: 40px;
                         
                  
                            ">

            <div class="input-group ">

              <input  style="width :100% ;font-family:andale mono;
                          font-size: 12pt;
                          padding-left: 10px;
                          padding-right: 10px;
                          border-bottom-left-radius: 40px;
               border-top-left-radius: 40px;
                           border: rgba(58, 133, 191);
                           line-height:40px;
                         
                          
                         
                         "    
                           type="text" name="search" placeholder="e.g.Apartment" value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>">
        

               <div class="input-group-addon" style=";
               background-color: rgba(58, 133, 191);
               border: transparent; border-bottom-right-radius: 40px;
               border-top-right-radius: 40px;
               background-color: Transparent;

              ">&nbsp;

                <button name="submit" type="submit" id="search-btn" style="
                background-color: Transparent;
                background-repeat:no-repeat;
                border: none;
                
                cursor:pointer;

                overflow: hidden;  
                border-bottom-right-radius: 40px;
               border-top-right-radius: 40px;">


               <i style="font-size: 19pt;color: white" class="fa fa-search"" ></i></button>

                

            

            </div>

                         </div>




 
      </label>
     
      <a href="filtersearch.php" class="btn btn-info" style=" 
                          font-size: 10pt;
                          width: 30%;
                        
                          padding-left: 10px;
                          padding-right: 10px;
                          border-radius: 40px;
              
                           border: rgba(58, 133, 191);
                           line-height: 15px;margin-top: -3%
                         ">Filter data</a>
                      


    </div>


    </form>


<!-- Main content -->
<section class="container" style="margin-top: 2%">


      <!--------------------------
        | Your Page Content Here |

        -------------------------->


































        <?php  
 $connect = mysqli_connect("localhost", "root", "", "my_db");  
 if(isset($_POST["submit"]))  
 {  
      if(!empty($_POST["search"]))  
      {  
           $query = str_replace(" ", "+", $_POST["search"]);  
          // print("location:search.php?search=" . $query);  

           echo "<script type='text/javascript'>window.top.location='search.php?search=".$query."';</script>"; 
      }  
      else
      {

         echo "<script type='text/javascript'>window.top.location='filtersearch.php';</script>"; 

      }
 }  
 ?>  
 
   
          
          

            


             
               <div class="container" style="">  
                    
                     <?php  
                     if(isset($_GET["search"]))  
                     {  
                          $condition = '';  

                          $query = explode(" ", $_GET["search"]);  
                          foreach($query as $text)  
                          {  
                        

                                $condition .= "vacancytype LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
                              
                          } 




                          $condition = substr($condition, 0, -4);  
                       
                          $output = '';

                          $sql_query = "SELECT * FROM rentalaccount WHERE $condition AND active ='1' AND availability ='open'  order by id DESC";
                        


                          $result = mysqli_query($connect, $sql_query);  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                                

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];

                                 if ($imga == ''){
                                  
                                    $pica =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $pica =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgb == ''){
                                  
                                    $picb =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picb =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgc == ''){
                                  
                                    $picc =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picc =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                if ($imgd == ''){
                                  
                                    $picd =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picd =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover;height:200px; width: 100%;" ></div>';
                                   
                                }

                                
                      


                                    ?>
                                    




                                    
                                    
                                      <div class="container">
                                        <div class="container">
                                          <div class="container">
                                     <div class="row">


                                    <div class="col-md-4 ">
                                  <div id="imgnxt" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                  

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
                                   

                                   
                                  </div>
                                </div>










                               



                                

                                  <div class="col-md-4 ">

                                    <p align="left" style="font-family:Arial;font-size: 18pt"><?php echo $row['rental_name']; ?></p>
                                    <p align="left" style="font-family:Arial;font-size: 12pt"><?php echo $row['vacancytype']; ?></p>

                                    <p align="left" style="margin-top: -5px;font-family:Arial;font-size: 10pt">
                                      <?php echo  $row['street'] . ",  Brgy. ". $row['barangay']."<br/>"
                                      .$row['zipcode']." ". $row['citymunicipality']. ", ". $row['regionprov']; ?><i class="glyphicon glyphicon-map-marker"></i></p>

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2); ?></p>

                                        <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                     <a href="viewrentaldetails.php?view=<?php echo $row["id"];?>">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>
                              </form>
                                     
                                    
                                  </div>


                            
                              </div></div></div></div>
                               <br/>
                                  <br/>





                                    <?php 







                               }  
                          }  
                         
                     }  




  

                    
                
              






















                   
                     if(isset($_GET["search"]))  
                     {  
                          $condition = '';  

                          $query = explode(" ", $_GET["search"]);  
                          foreach($query as $text)  
                          {  
                        

                                $condition .= "citymunicipality LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
                              
                          } 




                          $condition = substr($condition, 0, -4);  
                       
                          $output = '';

                          $sql_query = "SELECT * FROM rentalaccount WHERE $condition AND active ='1' AND availability ='open'  order by id DESC";
                        


                          $result = mysqli_query($connect, $sql_query);  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                                

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];

                                 if ($imga == ''){
                                  
                                    $pica =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $pica =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgb == ''){
                                  
                                    $picb =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picb =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgc == ''){
                                  
                                    $picc =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picc =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                if ($imgd == ''){
                                  
                                    $picd =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picd =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover;height:200px; width: 100%;" ></div>';
                                   
                                }

                                
                      


                                    ?>
                                    




                                    
                                    
                                      <div class="container">
                                        <div class="container">
                                          <div class="container">
                                     <div class="row">


                                    <div class="col-md-4 ">
                                  <div id="imgnxt" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                  

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
                                   

                                   
                                  </div>
                                </div>










                               



                                

                                  <div class="col-md-4 ">

                                    <p align="left" style="font-family:Arial;font-size: 18pt"><?php echo $row['rental_name']; ?></p>
                                    <p align="left" style="font-family:Arial;font-size: 12pt"><?php echo $row['vacancytype']; ?></p>

                                    <p align="left" style="margin-top: -5px;font-family:Arial;font-size: 10pt">
                                      <?php echo  $row['street'] . ",  Brgy. ". $row['barangay']."<br/>"
                                      .$row['zipcode']." ". $row['citymunicipality']. ", ". $row['regionprov']; ?><i class="glyphicon glyphicon-map-marker"></i></p>

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2);?></p>
                                        <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                     <a href="viewrentaldetails.php?view=<?php echo $row["id"];?>">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>
                              </form>
                                     
                                    
                                  </div>


                            
                              </div></div></div></div>
                               <br/>
                                  <br/>





                                    <?php 







                               }  
                          }  
                          
                     }  




  

                   if(isset($_GET["search"]))  
                     {  
                          $condition = '';  

                          $query = explode(" ", $_GET["search"]);  
                          foreach($query as $text)  
                          {  
                        

                                $condition .= "price LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
                              
                          } 




                          $condition = substr($condition, 0, -4);  
                       
                          $output = '';

                          $sql_query = "SELECT * FROM rentalaccount WHERE $condition AND active ='1' AND availability ='open'  order by id DESC";
                        


                          $result = mysqli_query($connect, $sql_query);  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                                

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];

                                 if ($imga == ''){
                                  
                                    $pica =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $pica =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgb == ''){
                                  
                                    $picb =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picb =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgc == ''){
                                  
                                    $picc =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picc =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                if ($imgd == ''){
                                  
                                    $picd =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picd =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover;height:200px; width: 100%;" ></div>';
                                   
                                }

                                
                      


                                    ?>
                                    




                                    
                                    
                                      <div class="container">
                                        <div class="container">
                                          <div class="container">
                                     <div class="row">


                                    <div class="col-md-4 ">
                                  <div id="imgnxt" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                  

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
                                   

                                   
                                  </div>
                                </div>










                               



                                

                                  <div class="col-md-4 ">

                                    <p align="left" style="font-family:Arial;font-size: 18pt"><?php echo $row['rental_name']; ?></p>
                                    <p align="left" style="font-family:Arial;font-size: 12pt"><?php echo $row['vacancytype']; ?></p>

                                    <p align="left" style="margin-top: -5px;font-family:Arial;font-size: 10pt">
                                      <?php echo  $row['street'] . ",  Brgy. ". $row['barangay']."<br/>"
                                      .$row['zipcode']." ". $row['citymunicipality']. ", ". $row['regionprov']; ?><i class="glyphicon glyphicon-map-marker"></i></p>

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2); ?></p>
                                       <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                     <a href="viewrentaldetails.php?view=<?php echo $row["id"];?>">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>
                              </form>
                                     
                                    
                                  </div>


                            
                              </div></div></div></div>
                               <br/>
                                  <br/>





                                    <?php 







                               }  
                          }  
                          
                     }  




  

                  if(isset($_GET["search"]))  
                     {  
                          $condition = '';  

                          $query = explode(" ", $_GET["search"]);  
                          foreach($query as $text)  
                          {  
                        

                                $condition .= "rental_name LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
                              
                          } 




                          $condition = substr($condition, 0, -4);  
                       
                          $output = '';

                          $sql_query = "SELECT * FROM rentalaccount WHERE $condition AND active ='1' AND availability ='open'  order by id DESC";
                        


                          $result = mysqli_query($connect, $sql_query);  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                                

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];

                                 if ($imga == ''){
                                  
                                    $pica =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $pica =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgb == ''){
                                  
                                    $picb =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picb =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgc == ''){
                                  
                                    $picc =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picc =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                if ($imgd == ''){
                                  
                                    $picd =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picd =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover;height:200px; width: 100%;" ></div>';
                                   
                                }

                                
                      


                                    ?>
                                    




                                    
                                    
                                      <div class="container">
                                        <div class="container">
                                          <div class="container">
                                     <div class="row">


                                    <div class="col-md-4 ">
                                  <div id="imgnxt" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                  

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
                                   

                                   
                                  </div>
                                </div>










                               



                                

                                  <div class="col-md-4 ">

                                    <p align="left" style="font-family:Arial;font-size: 18pt"><?php echo $row['rental_name']; ?></p>
                                    <p align="left" style="font-family:Arial;font-size: 12pt"><?php echo $row['vacancytype']; ?></p>

                                    <p align="left" style="margin-top: -5px;font-family:Arial;font-size: 10pt">
                                      <?php echo  $row['street'] . ",  Brgy. ". $row['barangay']."<br/>"
                                      .$row['zipcode']." ". $row['citymunicipality']. ", ". $row['regionprov']; ?><i class="glyphicon glyphicon-map-marker"></i></p>

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2);?></p>
                                        <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                     <a href="viewrentaldetails.php?view=<?php echo $row["id"];?>">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>
                              </form>
                                     
                                    
                                  </div>


                            
                              </div></div></div></div>
                               <br/>
                                  <br/>





                                    <?php 







                               }  
                          }  
                          
                     }  




  

                     if(isset($_GET["search"]))  
                     {  
                          $condition = '';  

                          $query = explode(" ", $_GET["search"]);  
                          foreach($query as $text)  
                          {  
                        

                                $condition .= "barangay LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
                              
                          } 




                          $condition = substr($condition, 0, -4);  
                       
                          $output = '';

                          $sql_query = "SELECT * FROM rentalaccount WHERE $condition AND active ='1' AND availability ='open'  order by id DESC";
                        


                          $result = mysqli_query($connect, $sql_query);  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                                

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];

                                 if ($imga == ''){
                                  
                                    $pica =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $pica =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgb == ''){
                                  
                                    $picb =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picb =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgc == ''){
                                  
                                    $picc =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picc =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                if ($imgd == ''){
                                  
                                    $picd =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picd =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover;height:200px; width: 100%;" ></div>';
                                   
                                }

                                
                      


                                    ?>
                                    




                                    
                                    
                                      <div class="container">
                                        <div class="container">
                                          <div class="container">
                                     <div class="row">


                                    <div class="col-md-4 ">
                                  <div id="imgnxt" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                  

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
                                   

                                   
                                  </div>
                                </div>










                               



                                

                                  <div class="col-md-4 ">

                                    <p align="left" style="font-family:Arial;font-size: 18pt"><?php echo $row['rental_name']; ?></p>
                                    <p align="left" style="font-family:Arial;font-size: 12pt"><?php echo $row['vacancytype']; ?></p>

                                    <p align="left" style="margin-top: -5px;font-family:Arial;font-size: 10pt">
                                      <?php echo  $row['street'] . ",  Brgy. ". $row['barangay']."<br/>"
                                      .$row['zipcode']." ". $row['citymunicipality']. ", ". $row['regionprov']; ?><i class="glyphicon glyphicon-map-marker"></i></p>

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2); ?></p>
                                      <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                     <a href="viewrentaldetails.php?view=<?php echo $row["id"];?>">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>
                              </form>
                                     
                                    
                                  </div>


                            
                              </div></div></div></div>
                               <br/>
                                  <br/>





                                    <?php 







                               }  
                          }  
                          
                     }  




  

                     if(isset($_GET["search"]))  
                     {  
                          $condition = '';  

                          $query = explode(" ", $_GET["search"]);  
                          foreach($query as $text)  
                          {  
                        

                                $condition .= "street LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
                              
                          } 




                          $condition = substr($condition, 0, -4);  
                       
                          $output = '';

                          $sql_query = "SELECT * FROM rentalaccount WHERE $condition AND active ='1' AND availability ='open'  order by id DESC";
                        


                          $result = mysqli_query($connect, $sql_query);  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                                

                                $imga = $row['rental_imga'];
                                $imgb = $row['rental_imgb'];
                                $imgc = $row['rental_imgc'];
                                $imgd = $row['rental_imgd'];

                                 if ($imga == ''){
                                  
                                    $pica =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $pica =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imga . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgb == ''){
                                  
                                    $picb =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picb =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgb . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                 if ($imgc == ''){
                                  
                                    $picc =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picc =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgc . '&quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                   
                                }

                                if ($imgd == ''){
                                  
                                    $picd =    '<div class="img-rounded" style="background-image: url(&quot; rentalimage/house.png &quot;);background-position: center;background-size: cover; height:200px; width: 100%;"></div>';
                                                 
                                   
                                 

                                } else {
                                   
                                   $picd =    '<div class="img-rounded" style="background-image: url(&quot;rentalimage/' . $imgd . '&quot;);background-position: center;background-size: cover;height:200px; width: 100%;" ></div>';
                                   
                                }

                                
                      


                                    ?>
                                    




                                    
                                    
                                      <div class="container">
                                        <div class="container">
                                          <div class="container">
                                     <div class="row">


                                    <div class="col-md-4 ">
                                  <div id="imgnxt" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                  

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
                                   

                                   
                                  </div>
                                </div>










                               



                                

                                  <div class="col-md-4 ">

                                    <p align="left" style="font-family:Arial;font-size: 18pt"><?php echo $row['rental_name']; ?></p>
                                    <p align="left" style="font-family:Arial;font-size: 12pt"><?php echo $row['vacancytype']; ?></p>

                                    <p align="left" style="margin-top: -5px;font-family:Arial;font-size: 10pt">
                                      <?php echo  $row['street'] . ",  Brgy. ". $row['barangay']."<br/>"
                                      .$row['zipcode']." ". $row['citymunicipality']. ", ". $row['regionprov']; ?><i class="glyphicon glyphicon-map-marker"></i></p>

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2); ?></p>
                                       <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                     <a href="viewrentaldetails.php?view=<?php echo $row["id"];?>">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>
                              </form>
                                     
                                    
                                  </div>


                            
                              </div></div></div></div>
                               <br/>
                                  <br/>





                                    <?php 







                               }  
                          }  
                          
                     }  




  

                     ?>   

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

     <?php  echo $error; ?>
</body>
</html>