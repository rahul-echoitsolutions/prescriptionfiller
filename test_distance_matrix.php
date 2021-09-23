<?php
  //request the directions
  
  $aaa=file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=M4C4Y7&destinations=H1A0A2&key=AIzaSyBXPMFFiEYKAxEPe-SzRFwrwOFDwZ0vvx0');

  $bbb=json_decode($aaa,true);
  

echo $bbb['rows'][0]['elements'][0]['distance']['text'];

$address="V6H2X5";


function get_lat_long($address){
    $address = str_replace(" ", "+", $address);
    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=AIzaSyBXPMFFiEYKAxEPe-SzRFwrwOFDwZ0vvx0");
    $json = json_decode($json);
        ob_start();
   print_r($json);
   $xxx=ob_get_clean();
   echo "Got to line ".__LINE__." in ".__FILE__." xxx is $xxx <br />";

echo "Got to line ".__LINE__." in ".__FILE__." <br /><br />";

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
   
     $city = $json->{'results'}[0]->{'address_components'}[2]->{'long_name'};
     $province = $json->{'results'}[0]->{'address_components'}[4]->{'short_name'};
    
    return $lat.','.$long.','.$city.','.$province;
}

echo get_lat_long($address);
?>