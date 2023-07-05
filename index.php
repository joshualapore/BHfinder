<?php
$error = NULL;
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

  <style type="text/css">
      input:focus {
    outline:none !important;

}

button:focus {
    outline:none ;
    cursor: pointer;
    

}

  </style>



  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<body class="hold-transition skin-blue constainer-fluid" style="background: #ecf0f5">
  
  <!-- Main Header -->
  <header class="main-header">
      

    <!-- Logo -->
    <a href="filter.php" class="logo"  style="background-color: #3c8dbc">
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

<div >
  

  
    <!-- Content Header (Page header) -->



 


<!-- Main content -->
<section class="content-header container" style="margin-top: 2%">


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
          // header("location:index.php?search=" . $query);  
              echo "<script type='text/javascript'>window.top.location='index.php?search=".$query."';</script>"; 
      }  else{
        
           echo "<script type='text/javascript'>window.top.location='filter.php';</script>"; 

           exit();
      }
 }  
 ?>  
 
             
                <div class="login-logo">
                  <a href="index.php">
                <span class="logo-lg" style="color: #4eac8b"><b style="color: #3d155f">B</b><b style="color: #df678c">H</b><span style="
      color: #243665">find</span>er</span></a>

      <h4><small class="text-info">find the ideal boarding houses for you...</small></h4>


           </div>
            
            <div class="container">


            <form  method="post" >
              <div class="container">
                <br/>

            <label class="form-group"  style="font-family: Andale Mono;
                            font-size: 12pt;

                            border: 15px solid rgba(58, 133, 191);
   
                             border-radius: 40px;
                         
                  
                            ">

            <div class="input-group ">

              <input  style="width :100% ;font-family: Andale Mono;
                          font-size: 12pt;
                          padding-left: 10px;
                          padding-right: 10px;
                          border-bottom-left-radius: 40px;
               border-top-left-radius: 40px;
                           border: rgba(58, 133, 191);
                           line-height: 40px;
                         
                          
                         
                         "    
                           type="text" name="search" placeholder="e.g.Apartment" value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>">
        

               <div class="input-group-addon" style="
               background-color: rgba(58, 133, 191);
               border: .10px;

              ">

                <button class="" name="submit" type="submit" id="search-btn" style="
                background-color: Transparent;
                
                border: none;
                cursor:pointer;
                
                

               
                border-bottom-right-radius: 40px;
               border-top-right-radius: 40px;">


               <i style="font-size: 19pt;color: white" class="fa fa-search"" ></i></button>
            

            </div>

              </label>
             </div>


 
    

    

    </div>


    </form>

      <a href="filter.php" class="btn btn-info" style=" ;font-family: arial ;
                          
                          padding-left: 10px;
                          padding-right: 10px;
                          border-radius: 40px;
                           width: 30%;
                         margin-top: -2%;
                         margin-left: 35%;
                           border: rgba(58, 133, 191);
                           line-height: 15px;
                         ">Filter data</a>
                     

   
</div><br/>


            


             
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

                                    <a href="login.php">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>

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

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2); ?></p>


                                     

                                       <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                    <a href="login.php">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>


                            

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

                                    <a href="login.php">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>

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

                                      <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt"><?php echo "₱ ".number_format($row["price"],2); ?></p>
                                        <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" value=" 
                                      <?php echo  $row['street'] . ", ". $row['citymunicipality']. ", ". $row['regionprov']. ", ". $row['country']; ?>" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                    <a href="login.php">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>

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

                                    <a href="login.php">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>

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

                          $sql_query = "SELECT * FROM rentalaccount WHERE $condition AND active ='1' AND availability ='open' order by id DESC";
                        


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

                                    <a href="login.php">Details &nbsp;<i class="glyphicon glyphicon-folder-open"></i></a>

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
<br/>
<!-- end of main content -->

<!-- footer -->

<footer style="position:fixed;
  width: 100%;
   bottom: 0;z-index: 9999

  
   " class="bg-black">
        
   
      
    <div class="constainer-fluid text-center bg-black" style="margin-top: 1%">

      
        <strong >Copyright &copy; 2019 <a href="index.php">BHfinder.com</a>.</strong> All rights reserved.
    </div>

    <br/>
        
    </footer>
<!-- end of footer -->

</div>

<?php echo $error; ?>

</body>
</html>

<!-- JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>





