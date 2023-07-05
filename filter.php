<?php
$error = NULL;

include('database_connection.php');
?>


<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BHfinder</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Font Awesome -->
  
   <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">

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


<body class="hold-transition skin-blue constainer-fluid" style="background: #ecf0f5">
  
  <!-- Main Header -->
  <header class="main-header">
      

    <!-- Logo -->
    <a href="index.php" class="logo"  style="background-color: #3c8dbc">
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



<!-- Main content --><section class="content-header constainer" >




  <div class="constainer-fluid">



     
          



        <div class="row">
        
            <div class="col-md-2">    
            <a href="index.php" class="btn btn-info" style=" ;font-family: Andale Mono;
                          font-size: 12pt;
                          padding-left: 10px;
                          padding-right: 10px;
                          border-radius: 40px;
                          width: 50%;
                           border: rgba(58, 133, 191);
                           line-height: 15px;
                         ">Search</a>                  
        <div class="list-group">
          <h3 class="text-info">Price</h3>
          <input  type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">200 - 20000</p>
                    <div class="form-group" id="price_range" style="background:#243665"></div>
                    <p ><span >Min</span><span class="pull-right">Max</span></p>
                </div>  

                <div class="list-group">
          <h3 class="text-info">Vacancy</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">
          <?php

                    $query = "SELECT DISTINCT(vacancytype) FROM rentalaccount WHERE active = '1' ORDER BY id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector vacancytype" value="<?php echo $row['vacancytype']; ?>"  > <?php echo $row['vacancytype']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>


                <div class="list-group">
          <h3 class="text-info">Barangay</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">
          <?php

                    $query = "SELECT DISTINCT(barangay) FROM rentalaccount WHERE active = '1' ORDER BY id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector barangay" value="<?php echo $row['barangay']; ?>"  > <?php echo $row['barangay']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

                  <div class="list-group">
          <h3 class="text-info">Street</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">
          <?php

                    $query = "SELECT DISTINCT(street) FROM rentalaccount WHERE active = '1' ORDER BY id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector street" value="<?php echo $row['street']; ?>"  > <?php echo $row['street']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

        
                    </div>

            <div class="col-md-10">
              <br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
  text-align:center; 
  background: url('loader.gif') no-repeat center; 
  height: 150px;
}
</style>

<script>
$(document).ready(function(){

   filter_data();

    function filter_data()
    {
      

        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var vacancytype = get_filter('vacancytype');
        var barangay = get_filter('barangay');
        var street = get_filter('street');
        
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, vacancytype:vacancytype, barangay:barangay, street:street},
            success:function(data){
                $('.filter_data').html(data);
            }
        });

    }











    function get_filter(class_name)
    {
        var filter = [];


        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());

        });


        return filter;


    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:200,
        max:20000,
        values:[200, 20000],
        step:200,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>





























   

</section>
<br/><br/><br/>
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



<?php echo $error; 
   ?>

</body>
</html>

<!-- JS SCRIPTS -->

<!-- jQuery 3 -->





