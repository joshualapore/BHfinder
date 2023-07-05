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

     $host_email= $_SESSION['email'];

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

} else{
  $admin ="";
  $dashboard = '';
  $client = '';
}


                        
if ($resulttt->num_rows > 0) {
$roww = $resulttt->fetch_assoc();
$userlevel = $roww['userlevel'];



}






















    // define variables and set to empty values

$rentalname =  $rentalrentee = $rentalspaceavail = $rentalowner = $rentalnumber = $rentalbrgy = $rentalstreet = $rentalcitymun = $rentalprovince = $rentalcountry = $rentalzip = $rentaltype = $rentalprice = $rentalreg = $file = "";

$rentalnameErr = $rentalspaceavailErr= $rentalrenteeErr = $rentalownerErr = $rentalnumberErr = $rentalbrgyErr = $rentalstreetErr = $rentalcitymunErr = $rentalprovinceErr = $rentalcountryErr = $rentalzipErr = $rentaltypeErr = $rentalpriceErr = $rentalregErr = $fileErr = "";


    $success = 0;
    $count = 0;
    $msg = '';
    
    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $id = $_SESSION['id'];
        
        $rentalname = test_input($_POST["rentalname"]);
       // $rentalowner = test_input($_POST["rentalowner"]);
        $rentalnumber = test_input($_POST["rentalnumber"]);
        $rentalbrgy = test_input($_POST["rentalbrgy"]);
        $rentalstreet = test_input($_POST["rentalstreet"]);
        $rentalcitymun = test_input($_POST["rentalcitymun"]);
        $rentalprovince = test_input($_POST["rentalprovince"]);
        $rentalcountry = test_input($_POST["rentalcountry"]);
        $rentalzip = test_input($_POST["rentalzip"]);
        $rentaltype = test_input($_POST["rentaltype"]);
        $rentalprice = test_input($_POST["rentalprice"]);



        $rentalspaceavail = test_input($_POST["rentalspaceavail"]);
        $rentalrentee = test_input($_POST["rentalrentee"]);
        //$rentalreg = test_input($_POST["rentalreg"]);
        
        //Validating our rental name
        if (empty($_POST["rentalname"])) {
            $rentalnameErr = "*";
            $count++;
        } else {
            $rentalname = test_input($_POST["rentalname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$rentalname)) {
                $rentalnameErr = "Only letters and white space allowed"; 
                $count++;
            }
        }

        //Validating our rental owner
       // if (empty($_POST["rentalowner"])) {
           // $rentalownerErr = "Rental owner / landlord name is required";
          //  $count++;
       // } else {
          //  $rentalowner = test_input($_POST["rentalowner"]);
            // check if name only contains letters and whitespace
           // if (!preg_match("/^[a-zA-Z ]*$/",$rentalowner)) {
             //   $rentalownerErr = "Only letters and white space allowed"; 
            //    $count++;
           // }
       // }

        //Validating our rental contact number
        if (empty($_POST["rentalnumber"])) {
            $rentalnumberErr = "*";
            $count++;
        } else {
            $rentalnumber = test_input($_POST["rentalnumber"]);


            $sql = "SELECT * FROM rentalaccount WHERE contact = '$rentalnumber' AND host_id != '$id'";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {

                $rentalnumberErr = "Contact number already exists in database";
                $rentalnumber = "";
                $count++;
            }


            // check if name only contains letters and whitespace

            if (!preg_match("/^[ 0-9 +-]*$/",$rentalnumber)) {
                $rentalnumberErr = "Only number from + 0 - 9 is allowed"; 
                $count++;
            }


             if(strlen(trim($rentalnumber)) < 7 || strlen(trim($rentalnumber)) > 13  != NULL){
            $rentalnumberErr = "Invalid";
            $count++;
        }


        }


 








        //Validating our $rentalbrgy = test_input($_POST["rentalbrgy"]);
        if (empty($_POST["rentalbrgy"])) {
            $rentalbrgyErr = "*";
            $count++;
        } else {
            $rentalbrgy = test_input($_POST["rentalbrgy"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z 0-9]*$/",$rentalbrgy)) {
                $rentalbrgyErr = "Only letters and white space allowed"; 
                $count++;
            }
        }

        //Validating our  $rentalstreet = test_input($_POST["rentalstreet"]);
        if (empty($_POST["rentalstreet"])) {
            $rentalstreetErr = "*";
            $count++;
        } else {
            $rentalstreet = test_input($_POST["rentalstreet"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z 0-9]*$/",$rentalstreet)) {
                $rentalstreetErr = "Only letters, numbers and white space allowed"; 
                $count++;
            }
        }

        //Validating our $rentalcitymun = test_input($_POST["rentalcitymun"]);
        if (empty($_POST["rentalcitymun"])) {
            $rentalcitymunErr = "*";
            $count++;
        } else {
            $rentalcitymun = test_input($_POST["rentalcitymun"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$rentalcitymun)) {
                $rentalcitymunErr = "Only letters and white space allowed"; 
                $count++;
            }
        }


        //Validating our  $rentalprovince = test_input($_POST["rentalprovince"]);
        if (empty($_POST["rentalprovince"])) {
            $rentalprovinceErr = "*";
            $count++;
        } else {
            $rentalprovince = test_input($_POST["rentalprovince"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$rentalprovince)) {
                $rentalprovinceErr = "Only letters and white space allowed"; 
                $count++;
            }
        }

        //Validating our $rentalcountry = test_input($_POST["rentalcountry"]);
        if ($_POST["rentalcountry"] == "None") {
            $rentalcountryErr = "*";
            $count++;
        } else {
            $rentalcountry = test_input($_POST["rentalcountry"]);
         
        }

        //Validating our $rentalzip = test_input($_POST["rentalzip"]);
        if (empty($_POST["rentalzip"])) {
           $rentalzipErr = "*";
            $count++;
        } else {
            $rentalzip = test_input($_POST["rentalzip"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[0-9 +-]*$/",$rentalzip)) {
                $rentalzipErr = "Only number from 0-9 is allowed"; 
                $count++;
            }
        }



        //Validating our $rentaltype = test_input($_POST["rentaltype"]);
        if ($_POST["rentaltype"] == "None") {
            $rentaltypeErr = "*";
            $count++;
        } else {
           $sql = "SELECT * FROM rentalaccount WHERE vacancytype = '$rentaltype' AND rental_name = '$rentalname'";

            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                $rentaltypeErr = "Vacancy already exist";
                $rentalnameErr = "Rental name already exist";
                $rentalname = "";
                $rentaltype = "";
                $count++;
            }




          

           
        }

        //Validating our $rentalprice = test_input($_POST["rentalprice"]);
        if (empty($_POST["rentalprice"])) {
            $rentalpriceErr = "*";
            $count++;
        } else {
            $rentalprice = test_input($_POST["rentalprice"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[1-9][0-9]*$/",$rentalprice)) {
                $rentalpriceErr = "Only number from 0-9 is allowed"; 
                $count++;
            }

            if(strlen(trim($rentalprice))  > 5 != NULL){
            $rentalpriceErr = "range from 1.00 - 20,000.00";
            $count++;
        }

        }



         //Validating our $rentalspaceavail
        if (empty($_POST["rentalspaceavail"])) {
            $rentalspaceavailErr = "*";
            $count++;
        } else {
            $rentalspaceavail = test_input($_POST["rentalspaceavail"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[1-9][0-9]*$/",$rentalspaceavail)) {
                $rentalspaceavailErr = "Only number from 1-9 is allowed"; 
                $count++;
            }
        }


          //Validating our $rentalrentee
        if (empty($_POST["rentalrentee"])) {
            $rentalrenteeErr = "*";
            $count++;
        } else {
            $rentalrentee = test_input($_POST["rentalrentee"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[1-9][0-9]*$/",$rentalrentee)) {
                $rentalrenteeErr = "Only number from 1-9 is allowed"; 
                $count++;
            }
        }






















        // Check if image file is a actual image or fake image
  
        
        $file = $_FILES['filea'];

        $filename = $_FILES['filea']['name'];
        $fileTmpname = $_FILES['filea']['tmp_name'];
        $fileError = $_FILES['filea']['error'];
        $fileSize = $_FILES['filea']['size'];
        
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
                        echo "";
                        //Update database image column with the fileNameNew
          
            
                      
                    } else {
                       $count++;
                        $fileErr = "Your Rental Photo failed to upload";
                    }
                } else {
                   $count++;
                    $fileErr = "Your Rental Photo is too large";
                }
            } else {
               $count++;
                $fileErr = "There was an error uploading your Rental Photo";
            }
        } else {

           $count++;
           $fileErr = "Choose a Rental Picture with valid extension";

           }
            




        
        //If we are free of errors
        if($count == 0){

             $sql = "INSERT INTO rentalaccount (host_id,  host_username,  host_email, rental_name, contact, barangay, street, citymunicipality, regionprov, country, zipcode, vacancytype, price,rentalspaceavail, rentalrentee, rental_imga, active, createdat, availability)
            VALUES ('$id','$user__','$host_email', '$rentalname ', '$rentalnumber', '$rentalbrgy', '$rentalstreet', '$rentalcitymun', '$rentalprovince', '$rentalcountry', '$rentalzip', '$rentaltype', '$rentalprice','$rentalspaceavail','$rentalrentee','$fileNameNew', 0, " . time() . " ,'Open')";

            if ($conn->query($sql) === TRUE) {
               $msg = "<p class='text-success'>Your rental account has been created successfully. Please wait up to 3 working days for us to verify your rental account</p>";

               $rentalname =$rentalrentee =$rentalspaceavail   = $rentalnumber = $rentalbrgy = $rentalstreet = $rentalcitymun = $rentalprovince = $rentalcountry = $rentalzip = $rentaltype = $rentalprice = $rentalreg =  "";


        }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo 'Something went wrong';
            }
    }

  }

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
    <section class="content-header">
      <div class="block-heading">
                    <h1 class="text-info">Register Rental Space</h1>
                    
                </div>
     
    </section>









  






    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->















 <?php 
                        if($msg != ''){

                            
                             echo '
                             <script src="assets/jquery/dist/jquery.min.js"></script>

                             <script>
                            $(document).ready(function(){
                              

                                $("p").fadeOut(8000);
                              
                            });
                            </script>
                            
                            '.$msg;'
                            ';
                                                     
                        }
                    ?>





















<div class="container">

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">



<div class="row">

  <div class="col-md-6  form-group">

    <label class="text-info"><h4>Rental Name</h4></label>
    <input value="<?php echo $rentalname; ?>" name="rentalname" type="text" class="form-control"  placeholder="Rental Name" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
    <span class="error form-text text-danger"><?php echo $rentalnameErr; ?></span>

  </div>


 

  <div class="col-md-6 form-group">
  
   <label class="text-info"><h4>Contact Number</h4></label>
    <input value="<?php echo $rentalnumber; ?>" name="rentalnumber" type="text" class="form-control"  placeholder="Contact Number" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
<span class="error form-text text-danger"><?php echo $rentalnumberErr; ?></span>
  </div>
</div>

<div class="row">

  <div class="col-md-6  form-group">

    <label class="text-info"><h4>Brgy.</h4></label>
    <input value="<?php echo $rentalbrgy; ?>" name="rentalbrgy" type="text" class="form-control"  placeholder="Brgy." style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
<span class="error form-text text-danger"><?php echo $rentalbrgyErr; ?></span>
  </div>

  <div class="col-md-6 form-group">
  
   <label class="text-info"><h4>Street /Unit /Bldg /Village</h4></label>
    <input value="<?php echo $rentalstreet; ?>" name="rentalstreet" type="text" class="form-control"  placeholder="Street/Unit/Bldg/Village" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
<span class="error form-text text-danger"><?php echo $rentalstreetErr; ?></span>
  </div>
</div>


<div class="row">

  <div class="col-md-6  form-group">

    <label class="text-info"><h4>City /Municipality</h4></label>
    <input value="<?php echo $rentalcitymun; ?>" name="rentalcitymun" type="text" class="form-control"  placeholder="City / Municipality" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
<span class="error form-text text-danger"><?php echo $rentalcitymunErr; ?></span>
  </div>

  <div class="col-md-6 form-group">
  
   <label class="text-info"><h4>Region /Province</h4></label>
    <input value="<?php echo $rentalprovince; ?>" name="rentalprovince" type="text" class="form-control"  placeholder="Region / Province" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
<span class="error form-text text-danger"><?php echo $rentalprovinceErr; ?></span>
  </div>
</div>


<div class="row">

  <div class="col-md-6  form-group">

    <label class="text-info"><h4>Country</h4></label>
     <select value="<?php echo $rentalcountry; ?>" name="rentalcountry" class="form-control" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
                  <option value="None">Select a country</option>
                  <option value="Philippines">Philippines</option>
                </select>
                <span class="error form-text text-danger"><?php echo $rentalcountryErr; ?></span>

  </div>

  <div class="col-md-3 form-group">
  
   <label class="text-info"><h4>Zip Code</h4></label>
    <input value="<?php echo $rentalzip; ?>" name="rentalzip" type="text" class="form-control"  placeholder="Zip Code" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
    <span class="error form-text text-danger"><?php echo $rentalzipErr; ?></span>

  </div>
</div>

<div class="row">
   <div class="col-md-3 form-group">
      <label class="text-info"><h4>Type of Vacancy</h4></label>


                  <select value="<?php echo $rentaltype; ?>" name="rentaltype" class="form-control" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">
                  <option value="None">Please select your rental space </option>
                  <option value="House">House</option>
                  <option value="Apartment">Apartment</option>
                  <option value="Studio Type">Studio Type</option>
                  <option value="Room Common CR">Room Common CR</option>
                  <option value="Room Private CR">Room Private CR</option>
                  <option value="Room Private CR (Female only)">Room Private CR (Female only)</option>
                  <option value="Room Common CR (Female only)">Room Common CR (Female only)</option>
                  <option value="Bed Space">Bed Space</option>
                  <option value="Bed Space (Female only)">Bed Space (Female only)</option>
                  <option value="Transcient">Transcient</option>
                  <option value="Transcient (Female only)">Transcient (Female only)</option>
                  </select>

                  <span class="error form-text text-danger"><?php echo $rentaltypeErr; ?></span>

              </div>

              <div class="col-md-3 form-group">
  
             <label class="text-info"><h4>Number of Space Available</h4></label>
              <input value="<?php echo $rentalspaceavail; ?>" name="rentalspaceavail" type="text" class="form-control"  placeholder="Number of space available" style="line-height:50px;
                                                                                        border-radius: 5px;
                                                                                        padding: 0 20px;
                                                                                        color: #666; height: 40px">
              <span class="error form-text text-danger"><?php echo $rentalspaceavailErr; ?></span>

            </div>

             <div class="col-md-3 form-group">
  
             <label class="text-info"><h4>Max Number of Rentee</h4></label>
              <input value="<?php echo $rentalrentee; ?>" name="rentalrentee" type="text" class="form-control"  placeholder="Max number of rentee" style="line-height:50px;
                                                                                        border-radius: 5px;
                                                                                        padding: 0 20px;
                                                                                        color: #666; height: 40px">
              <span class="error form-text text-danger"><?php echo $rentalrenteeErr; ?></span>

            </div>

              

              



      


</div>

<div class="row">
   <div class="col-md-3  form-group">


      <label class="text-info" ><h4>Price</h4>
        <div class="form-group">
         <label class="sr-only">Amount (in Peso)</label>
            <div class="input-group">
              <div class="input-group-addon"><span class="text-info">₱</span></div>
              <input value="<?php echo $rentalprice; ?>" name="rentalprice" type="text" class="form-control"  placeholder="Amount" style="line-height:50px;
                                                                              border-radius: 5px;
                                                                              padding: 0 20px;
                                                                              color: #666; height: 40px">

               <div class="input-group-addon"><span class="text-info">.00</span></div>
             </div>


            </div>
      </label>
        <span class="error form-text text-danger"><?php echo $rentalpriceErr; ?></span>
      
  </div>
</div>




<div class="row">
  <div class="col-md-3 form-group">
<label class="text-info"><h4>Select Rental Photo</h4></label>
   <input value="<?php echo $file; ?>" class="form-control" type="file" name="filea" style="border-radius: 5px;">
   <span class="error form-text text-danger"><?php echo $fileErr; ?></span>
  



   </div>
</div>




      <div class="row" >
       
        <!-- /.col -->
        <div class="col-md-2">
          <button class="btn btn-primary btn-block form-control" type="submit">Register</button>
        </div>
        <!-- /.col -->
      </div>


</form>
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


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>