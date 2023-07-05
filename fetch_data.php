<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM rentalaccount WHERE active = '1' AND availability ='open'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["vacancytype"]))
	{
		$vacancy_filter = implode("','", $_POST["vacancytype"]);
		$query .= "
		 AND vacancytype IN('".$vacancy_filter."')
		";
	}

	if(isset($_POST["barangay"]))
	{
		$barangay_filter = implode("','", $_POST["barangay"]);
		$query .= "
		 AND barangay IN('".$barangay_filter."')
		";
	}
	if(isset($_POST["street"]))
	{
		$street_filter = implode("','", $_POST["street"]);
		$query .= "
		 AND street IN('".$street_filter."')
		";
	}
	
	

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
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


			$output .= '

			<div class="col-sm-5 col-lg-4 col-md-4">
				<div style="border:1px solid  #ccc; border-radius:5px; padding:16px; margin-bottom:10px;height:480px">
			
					
				 <p class="text-info" align="left" style="font-family:Arial;font-size: 18pt;">'.$row['rental_name'].'</p>

                                    <p align="left" style="font-family:Arial;font-size: 12pt">'.$row['vacancytype'].'</p>


                                    <p align="left" style="margin-top: -5px;font-family:Arial;font-size: 10pt">
                                      '.$row['street'] . "<br/>  Brgy. ". $row['barangay']."<br/>"
                                      .$row['zipcode']." ". $row['citymunicipality']. ", ". $row['regionprov'].'&nbsp;<i class="fa fa-location-arrow"></i></p>

                                    
               



					   <div id="imgnxt" class="carousel slide" data-ride="carousel">
                              
                                    <div class="carousel-inner">

                                      <div class="item active img-rounded">
                                      '.$pica.'
                                      </div>

                                      <div class="item img-rounded">
                                       '.$picb.'
                                      </div>
                                    
                                      <div class="item img-rounded">
                                        '.$picc.'
                                      </div>

                                      <div class="item img-rounded">
                                        '.$picd.'
                                      </div>

                                    </div>
                                    <br/>
                                  
                                    <p class="text-info" align="left" style="font-family:Arial;font-size: 12pt">


                                   

                                     ₱ '.number_format($row["price"],2).'


                                    </p>

                                    <input  type="hidden" name="id" value="'.$row['id'].'">


                                      <form  action="http://maps.google.com/maps" method="get" target="_blank">
  
                                      <input type="hidden" name="daddr" 
                                      value="'.$row['street'].', '.$row['citymunicipality'].', '.$row['regionprov'].', '.$row['country'].'" />
                                   <button  type="submit"  class="" style="margin-left: -7px; outline:none ;cursor: pointer; border: transparent;background: #ecf0f5"><span class="text-info">Get Direction&nbsp;<i class="fa fa-compass"></i></span></button>

                                    <a href="viewrentaldetails.php?view='.$row["id"].'">See details &nbsp;<i class="fa fa-info"></i></a>

                              </form>

                                      
                                   

                               
                      

                                   

                                   
                                  </div>
				</div>

			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}















                              
                         
   





?>