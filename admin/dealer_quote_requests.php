<?php 
require("../includes/lib/common.php");
require("../includes/lib/classes/a/applications.php"); 
require("../includes/lib/classes/a/users.php");
require("../includes/lib/classes/a/dealer_quotes.php");
require("../includes/lib/classes/a/points.php"); 
require("../includes/lib/classes/a/settings.php");
require("../includes/lib/classes/a/shortlist.php");
require("../includes/lib/classes/a/dealers.php");
require("../includes/lib/classes/a/vehicles.php");



//enableErrors();
$dealer_id   = $request->getvalue('request');
$actives = $request->getvalue('active');

if(!$dealer_id AND $_SESSION['user_id']){
    $dealer_id=$_SESSION['user_id'];
}
if($_SESSION['mode']=="dealer" OR $_SESSION['mode']=="broker"){
    if($dealer_id>"" AND $dealer_id <>$_SESSION['user_id'] ){
        header("Location: https://carleado.com/admin/dashboard.php");
        die;
    }
}
$quotes = new quotes();
$users = new users();
$apps = new applications();
$points = new points();
$settings = new settings();
$short      = new shortlist();
$dealers = new dealers();
$vehicles	=  new vehicles();


 if($_SESSION['mode']=="admin"){
 $users->require_logged_in("login.php");   
 }else{
    $users->require_logged_in("login_dealer.php");
 }

$requestID = $request->getvalue('request');
////////// deleteing a record /////////
////////////////// end of deletion ////////////

// this restores the dealer id if it is lost.
$_GET['request']=(!$_GET['request'])? $_SESSION['user_id'] : $_GET['request'];


$dealers->load($_GET['request']);



if($request->postvalue('exclude')){
    
    foreach($request->postvalue('exclude') as $excludeMe){
    
    $quotes->id      			=  '';
    $quotes->dealer_id 			= $_GET['request']; 
	$quotes->vehicle_id 	    = $excludeMe;
    
    $quotes->saveExclude();
    }
}


if($_SESSION['mode']=="admin"){
	

	
$appsList = $apps->getlist();
}else{
    $appsList = $apps->getlistDealer("",$_GET['request']);
    
}

$activeMakes = $apps->getActiveMakes($appsList);

sort($activeMakes);

?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?PHP echo SITE_TITLE;?> - Quote Requests</title>
	<meta name="description" content="">
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="css/style.css">
    
    <?php  require("includes/main.php");?>
    
    <style>
    
    .comboselect{
        height:150px !important;
    }
    .combowrap{
        min-height: 200px !important;
        margin-bottom:20px !important;
        
    }
    .comboselectbox .searchable{
       height:200px !important;
       
    }
    .combowrap{
        height:200px !important;
        margin-bottom:20px !important;
       
    }
    .redText{
        color:red;
    }
    </style>
</head>
<body>
<?php

$infoStatus=array(1=>"Credit Info", 2=>"Personal Info");
$colorStatus=array(1=>"339966",2=>"orange");


 include("admin_header.php"); ?>
				<nav>
			<?php include("left_navigation.php");?>
		</nav>
		<section id="content">
        <!-- Start of Bread Crumbs --------------->
        <div class="widget" id="widget_breadcrumb">
					<h3 class="handle">Sections</h3>
					<div>
						<ul class="breadcrumb" data-numbers="true">
							<li><a href="<?php echo HTTP_HOME_URL;?>admin/dashboard.php">Dealer Dashboard</a></li>
                            <li><a href="<?php echo HTTP_HOME_URL;?>admin/dealer_quote_requests.php">Quote Requests</a></li>
						</ul>
					</div>
				</div>
          <!-- End of Bread Crumbs --------------->   
		<div class="g6 nodrop">
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="accordion widget sortable collapsed ui-accordion-icons"  id="widget_accordion">
						<h4 ><a href="#">Filter Brands</a></h4>
        
        
        
    <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" role="tabpanel" style="display: none;">    
        
        
        
			<P><h1 style="margin: 0px;">Quote Requests</h1></P>
            
            <div style="float: left;">
            
            	
            	<form method="get" action="">
            	
            	<p><strong>*The makes you add to the right column will NOT show in your list</strong></p>		
            	<select name="active" id="active" multiple >
            	<?php foreach($activeMakes as $make) { if($make == "") continue; ?>
            	<option value="<?php echo $make;?>" <?php if(in_array($make,$actives)) echo "selected";?>><?php echo $make;?></option>
            	<?php } ?>
            </select>
            	
            	  
            	  <input type="hidden" name="request" value="<?Php echo $dealer_id;?>">
                  
                  <?php
                  $filerButton=($is_mobile)? " margin-top:270px; " : ""; ?>
            	
            	 <button  type="submit"  name="filter" style="margin:5px; <?php echo $filerButton; ?> ">Apply Filter</button>
            </form>
            
            </div>
            
            
            
        </div>   
        
            
         </div>   
       </div>     
            
  	<div class="g6 nodrop">                                                                                                                      
            <?php 
              if($session->get('mode')!='admin') { ?>
            
            <?php 
               if($session->get('mode')!='admin') { 
                
                $coinFormat=($is_mobile)? " margin-top: 10px; " : "";
                
                ?>
            
   
            
             <div style="display:inline; float: left; padding:10px; width:220px; height:110px; border:thin solid #ccc; text-align: center; <?php echo $coinFormat; ?>"><h3>YOUR CARCOINS</h3>
              <div style="font-size: 60px; color: green; margin-top:-15px; letter-spacing: -6px; font-family:'PT Sans', sans-serif !important; "><?php  //echo $points->getGrandTotal($dealers->id, $settings->get_value('points_for_quote'));
				
					echo $points->getDealerFreePoints($dealers->id);
				  ?>
            </div><div style=" font-size: 10px; line-spacing:6px;margin-top: -10px; margin-bottom:0px;">Based on <?echo ($points->quoteCoinCount($dealers->id));?> unique <?php echo ($points->quoteCoinCount($dealers->id)==1)? "quote" : "quotes";?>  less your redemptions plus your signing bonus or other awarded points.</div>
            
            
            </div> <?php } ?>
			
	

            <?php } ?>
            <div style="clear: both;"></div>
            <?php if(!$is_mobile){ ?>
			<button class="btn" style="background-color: #FFFF99;">Has Credit Info</button>
            <button class="btn" style="background-color: #87E987;">Has Contact Info</button>
            <?php } ?>
            <button class="btn" style="background-color: #CDEFFA;">Shortlisted</button>
		</div>
        
        </div>	
        <?php
	if($is_mobile){
	   echo "<p><strong>Click on a row to enter a quote. Sort by any column. Filter by brands above. Search by any criterea. Original sort is by date, newest first.</strong></p>";
	}
?>
   
        		<?php if($appsList!='empty')
				{
				    
                    $scrMobile=($is_mobile)? ' id="scrollMobile" ' : "";
                     
				?>	
             	<form id="frmID1"  name="frmID1" method="post"  enctype="multipart/form-data">
                
               
                
                
                <table class="datatable" <?php echo $scrMobile; ?>" style="overflow-x: auto;" data-page-length='50'>
				<thead>
					<tr>
                      <?php 	 if($_SESSION['mode']!="admin" and !$is_mobile){ ?>
					<th  data-type="@data-sort" style="max-width: 50px;">Remove</th>
                     <?php } 
                     if(!$is_mobile){ 
                     ?>
                       	<th>Credit</th>
                        <?php } ?>
                        <th >Submitted</th>
                        
                        <th  data-type="@data-sort">Vehicle</th>
                        <th  data-type="@data-sort">Model</th>
                        
                        <?php if(!$is_mobile){
                     ?>
                        <th>Year</th>
                        <th>Max Miles </th>
                        <th>Max Price</th>
                        <th>Your Quote</th>
                        <th>Action</th>
                              <?php } ?>
					</tr>
				</thead>
				<tbody>
                <?php    
					$i=10000;
                foreach($appsList as $list) { $i--;
                
                
					
					if($list['vehicle_make']!='' && in_array($list['vehicle_make'],$actives)) continue;
					
			//	echo "Got to line ".__LINE__." in ".__FILE__." list['member_id'] is {$list['member_id']} and dealer_id is $dealer_id and list['id'] is {$list['id']} <br /><br />";
	$bgclrPd=($short->isPaid($list['member_id'],$dealer_id,$list['id']))? " style='background-color:#CDEFFA' " : "";
?>
					<tr class="gradeX"  <?php echo $bgclrPd; ?>>
                    
                   <?php 	 
                   unset($pdFlag);
                   unset($bgclr);
                    unset($creditInfo);
                    
                    if($apps->appHasCreditInfo($list['member_id'],$list['id'])){
                        
                    if($short->isPaid($list['member_id'],$dealer_id,$list['id'])){
                        $bgclr='#87E987';
                        $creditInfo="<a href='buyer_credit_info.php?request=".$list['member_id']."&vehicle_id=".$list['id']."'>YES</a>";
                        $pdFlag=1;
                        }else{
                            $creditInfo="YES";
                            $bgclr='#FFFF99';
                            
                        }
                    }elseif($short->isPaid($list['member_id'],$dealer_id,$list['id'])){
                         $bgclr='#87E987';
                        $creditInfo="<a href='buyer_credit_info.php?request=".$list['member_id']."&vehicle_id=".$list['id']."'>INFO</a>";
                        $pdFlag=2;
                        
                    }
                   
                   
                   
                   
                   if($_SESSION['mode']!="admin" AND !$is_mobile){ ?>
                   
                   
                    <td data-order="<?php echo $i;?>"  style="max-width: 50px;"><input type="checkbox" name="exclude[]" value="<?php echo $list[id];?>" style="max-width: 40px;"></td>
                    <?php } 
                    
                    
                   
                    
                    if(!$is_mobile){
                     ?>
                        <td style="background-color: <?php echo $bgclr;?>;" ><?php echo $creditInfo;?></td>
                        <?php } ?>
                        
                        
                     <?php if(!$is_mobile){  ?> 
						<td style="max-width: 25vw !important; "><?php echo date("M d, y g:i a", strtotime($list['date_submitted']));?></td>
                        <?php  }else{ ?>
                            
                            <td style="max-width: 25vw !important; "><?php echo date("M d, y g:i a", strtotime($list['date_submitted']));?></td>
                            
                      <?php   }?>
                      
                      
                      
                              
                        <td  data-order="<?php echo $list['vehicle_make'].$list['vehicle_body_type'];?>">
                        
                        
                        
                        
                        <?php if($is_mobile AND $dealers->stripe_custID){ ?>
                      
                      <a href="submit_dealer_quotes.php?request=<?php echo $list['id'];?>"> 
                     <?php 	 }elseif($is_mobile){ ?>
                      
                       <a href="dealer_billing.php?request=<?php echo $dealer_id;?>&message=You must enter a payment &#10; method to submit a quote. %0D%0A %0D%0APlease Enter Your Credit Card.%0D%0A %0D%0AYou are only charged the low fee of $<?php echo number_format($settings->get_value("cost_per_lead"),2); ?> if your quote is shortlisted by the buyer.">
                       <?php } ?>

                        
                        <?php echo str_replace("_"," ",$list['vehicle_make']).str_replace("_"," ",$list['vehicle_body_type']);?>  </a>
           
           
           
           
           
           
           
           
           
                        
     <?php
	if($is_mobile){
	  
       if($quotes->getQuoteByAppid($list['id'],$dealer_id)){ 
        
        $badQuote=array("$",",");
        $goodQuote=array("","");
        
                           echo  "<span class='redText'><br />Quoted: ".tofloat((str_replace($badQuote,$goodQuote,$quotes->getQuoteByAppid($list['id'],$dealer_id)))/1000)."K</span>";
           if($pdFlag){
            
          echo "<br /><a href='buyer_credit_info.php?request=".$list['member_id']."&vehicle_id=".$list['id']."' style='color:".$infoStatus[$colorStatus]."'>".$infoStatus[$pdFlag]."</a>";
        }elseif($apps->appHasCreditInfo($list['member_id'],$list['id'])){
            echo "<br /><span style='color:orange; font-weight:600;'>Credit Info</span> ";
        }                
                           
                           
                           
                           
                           }else{
       $shortPrice=($list['vehicle_max_price']/1000)."K";
        echo "<br /> Max Price: $shortPrice";
        
        
        if($pdFlag){
            
          echo "<br /><a href='buyer_credit_info.php?request=".$list['member_id']."&vehicle_id=".$list['id']."' style='color:".$infoStatus[$colorStatus]."'>".$infoStatus[$pdFlag]."</a>";
        }elseif($apps->appHasCreditInfo($list['member_id'],$list['id'])){
            echo "<br /><span style='color:orange; font-weight:600;'>Credit Info</span> ";
        }
        
        
        
        
        
        
        
        
        
        }
	}
?>
                        
                        
                        
                       </td>
                       
                       
                       
                       
						<td  data-order="<?php $list['vehicle_model'];?>">
                        
                  <?php if($is_mobile AND $dealers->stripe_custID){ ?>
                      
                      <a href="submit_dealer_quotes.php?request=<?php echo $list['id'];?>"> 
                     <?php 	 }elseif($is_mobile){ ?>
                      
                       <a href="dealer_billing.php?request=<?php echo $dealer_id;?>&message=You must enter a payment method to submit a quote.%0D%0APlease Enter Your Credit Card.%0D%0AYou are only charged the low fee of $<?php echo number_format($settings->cost_per_lead,2); ?> if your quote is shortlisted by the buyer. " >
                       <?php } 
                        echo  str_replace("_"," ",$list['vehicle_model']);?>&nbsp;</a>
                        
                        
                         <?php
	if($is_mobile){
	  
       $shortMiles=($list['vehicle_max_miles']/1000)."K";
       if($shortMiles){
        echo "<br /> Max Miles: $shortMiles";
        
        
        
        
        
        }
	}
?>
                        </td>
                        
                        <?php if(!$is_mobile){
                     ?>
                        <td><?php echo $list['vehicle_year_min']." - ".$list['vehicle_year_max'];?> </td>
                        <td><?php echo tofloat($list['vehicle_max_miles']);?></td>
                        <td><?php if($list['vehicle_max_price']){ echo "$".number_format(tofloat($list['vehicle_max_price']),2);}?></td>
                        <td><?php  if($quotes->getQuoteByAppid($list['id'],$dealer_id)){ 
                           echo  "$".number_format(tofloat($quotes->getQuoteByAppid($list['id'],$dealer_id)),2);}?>
                            </td>
                      <td class="c">
                      
                      <?php if($dealers->stripe_custID){ ?>
                      
                      <a href="submit_dealer_quotes.php?request=<?php echo $list['id'];?>">Quote</a> 
                     <?php 	 }else{ ?>
                      
                       <a href="dealer_billing.php?request=<?php echo $dealer_id;?>&message=You must enter a payment method to submit a quote. %0D%0A %0D%0APlease Enter Your Credit Card.%0D%0A %0D%0AYou are only charged the low fee of $<?php echo number_format($settings->get_value("cost_per_lead"),2); ?> if your quote is shortlisted by the buyer.">Quote</a> 
                      
                      <?php } ?>
                      </td>
                      
                      <?php } ?>
					</tr>
                 <?php } ?>
				</tbody>
			</table>
            <input type="hidden" name="excludeList" value="111">
            
            <?php if($_SESSION['mode']=="dealer" AND !$is_mobile){?>
            <button  type="submit"  name="submit" value="Submit" id="btnSUBMIT"> Click To Remove Checked Items </button>
            <?php } ?>
                
            </form>
           <?php }  else {   echo " Sorry - no record found"; }  ?>
		</section><br /><br /><br />
    
                    
        <script>
					
			$(document).ready(function(){
				
				$("ul.comboselect li").each(function(){
					var text = $(this).attr('style');
					if(text == 'display: none;') {
						$(this).addClass('hidden');
					}
				});
				
				$("ul.comboselect li").removeAttr('style');
			});
			
			var is_mobile = '<?php echo $is_mobile;?>';
			
			if(is_mobile) {
				
				setTimeout(function() {
				$("#scrollMobile_wrapper").css("overflow-y","scroll");
				},1000);
			}
					
        </script>
        
        

		<?php include("footer.php");?>
</body>
</html>