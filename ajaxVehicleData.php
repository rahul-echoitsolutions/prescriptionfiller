<?php
	include("includes/lib/common.php");	
	 include("includes/lib/classes/a/vehicles.php");
    $vehicles = new vehicles();
   
   
   
   if(isset($_POST["make"]) && !empty($_POST["make"])){
    
    $getModels=$vehicles->getlistModel($_POST["make"]);
    //Get all state data
    
        echo '<option value="">Select Model</option>';
         foreach($getModels as $list) { 
            
            $model2=str_replace(" ", "_",$list['model']);
    
    echo "<option value='$model2'>".$list['model']."</option>";
    }
    }else{
        echo '<option value="">Model not available</option>';
    }

?>