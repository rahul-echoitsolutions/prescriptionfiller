<?php

require_once("includes/lib/common.php");
require("includes/lib/classes/a/points.php");
require("includes/lib/classes/a/shortlist.php");
require("includes/lib/classes/a/dealers.php");
require("includes/lib/classes/a/transactions.php");
require("includes/lib/classes/a/members.php");
require("includes/lib/classes/a/dealer_quotes.php");
require("includes/lib/classes/a/settings.php");
use \PhpPot\Service\StripePayment;
require_once "stripe-php/StripeConfig.php";
require_once "stripe-php/StripePayment.php";


function no_($var=""){
   $xxx= str_replace("_"," ",$var);
   return $xxx;
}
// whatever you echo or print will be passed back into the 'response' variable in the call back function
				$shortlist 		= new shortlist();
				$transactions	= new transactions();
				$points			= new points();
				$member 		= new members();
				$quote 			= new quotes();
				$settings 		= new settings();


				$string 	=	explode("::",$_POST['r_id']);
				$action		=	$_POST['action'];

				$shortlist->member_id					   	  =	$string[1];
				$shortlist->vehicle_id                        =	$string[0];
                $shortlist->dealer_id   				      =	$string[2];
				$shortlist->quote_id						  = $string[3];
                
				
				$member->load($shortlist->member_id);
				
				$quote->loadDealer($shortlist->vehicle_id,$shortlist->dealer_id );
				
				

				/// New Short List Entry !!!
				if($action == 'add') {
					
					$shortlist->date		                   =	date("Y-m-d H:i:s");
					
					$shortlist->save();	
					
					$dealers = new dealers();
					
					$dealers->load($shortlist->dealer_id);
					
					echo "<br />Shortlisted <BR>";
					echo "<span>$dealers->company_trade_name <BR> <a href=\"tel:$dealers->phone\" style='color:#00A2E8;'>".cleanPhone($dealers->phone)."</a></span>";
					
					// Points !!!
					$dealerFreePoints 	= $points->getDealerFreePoints($shortlist->dealer_id);
					$PointsperLeadCost 	= $settings->get_value('points_for_free_lead');
					
					
					if($dealerFreePoints >= $PointsperLeadCost) {
						
						$points->dealer_id 			= $shortlist->dealer_id;
						$points->points    			= (-1)*$PointsperLeadCost;
						$points->points_description = "Free Lead";
						$points->points_date		= date("Y-m-d H:i:s");
						
						$points->save();
						
						
						$options 			= array();

						$options['quote'] 	= $quote;

						$options['member'] 	= $member;

						$options['settings']= $settings;

						$options['dealers']	= $dealers;	
						
						$options['pointscost'] = $PointsperLeadCost;
						
						$options['pointsleft'] = $dealerFreePoints - $PointsperLeadCost;
						
					
						/// send New lead EMAIL !!!
						$transactions->sendNewFreePointsLeadEmail($options);
						
						die();
					}
					
			
					//// Stripe Transactions Start !!!
					if($dealers->stripe_custID!="") {
						
						
						$transactions->amount 				= $settings->get_value("cost_per_lead");
						
						$transactions->created				= date("Y-m-d H:i:s");
						
						$transactions->dealer_id			= $shortlist->dealer_id;
						
						$transactions->vehicle_id			= $shortlist->vehicle_id;
						
						$transactions->member_id			= $shortlist->member_id;
						
						$transactions->shortlist_id			= $shortlist->id;
                        
                       
                        
                        $desc=" Fee for Vehicle $quote->vehicle_make ".no_($quote->vehicle_model)." for customer $member->first_name $member->last_name";
                        
                        //$desc="xxxxx TEST";
						
						//mail("birwin@suddensales.com", "Error Message ", "Got to ".__LINE__." in ".__FILE__." desc is $desc and  settings->get_value(cost_per_lead) is ".$settings->get_value("cost_per_lead")." ");

						$stripePayment 	= new StripePayment();
						
						try { 
							
							
							
							Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);	
		
							$result = 	Stripe\Charge::create([
							  'amount' => ($settings->get_value("cost_per_lead")*100),
							  'currency' => 'cad',
							  'customer' => $dealers->stripe_custID,
							  'description' => $desc,
							]);	
                            
							$result = $result->jsonSerialize();
							
              						
							$transactions->jsonResponse 		= json_encode($result);
							
							$transactions->stripeStatusCode 	= $result['status'];
							
							$transactions->stripeTransactionID 	= $result['balance_transaction'];
			
									
							// if successful charge 
							if ($result['amount_refunded'] == 0 && empty($result['failure_code']) && $result['paid'] == 1 && $result['captured'] == 1 && $result['status'] == 'succeeded') {

							   $transactions->status = "success";
							  	
							 
							   $options 			= array();
								
							   $options['quote'] 	= $quote;
								
							   $options['member'] 	= $member;
								
							   $options['settings']	= $settings;
								
							   $options['dealers']	= $dealers;	
								
				
								/// send New lead EMAIL !!!
								$transactions->sendNewLeadEmail($options);
                
                          
							} 
							// else charge is FAILED !!!
							else	{
								
								$transactions->status = "failed";
							}
							
							
							$transactions->save();
							
						
						
						/// Transaction couldn't be processed due to some technical issue ////	
						} catch (Exception $e) {
							
							
							$transactions->jsonResponse = $transactions->jsonResponse."/+/".$e->getMessage();
							
							$transactions->save();
						}
						
						
						
					}  // end check if Credit card is attached to dealer's profile
					
					//// Stripe Transactions END !!!
					
					die();
					
					
				}  /// END of ADDING new shortlist 

				else { 
					
					$record_id = $shortlist->getIDFromMemberIDAndQuoteID($shortlist->member_id,$shortlist->quote_id);
					if($record_id > 0) {
						$shortlist->delete($record_id);
						die();
					}
				}
?>
//