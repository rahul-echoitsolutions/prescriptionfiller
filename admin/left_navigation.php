<?php
	// left_navigation.php
    $page = basename($_SERVER['PHP_SELF']);
if($session->get('mode')==''){
    echo "<h2>NOT AUTHORIZED</h2>";
    die;
} 
?>
			<ul id="nav">
				<li class="i_house"><a href="dashboard.php"><span>Dashboard</span></a></li>
                <?php if($session->get('mode')=='admin') { ?>
				<li class="i_male_contour"><a><span>Users</span></a>
					<ul>
						<li><a href="users.php"><span>Manage Users</span></a></li>
						<li><a href="manage_users.php"><span>Add User</span></a></li>
					</ul>
				</li>
               <?php } ?> 
               <?php if($session->get('mode')=='admin') { ?>
               <li class="i_duplicate"><a><span>Blogs</span></a> 
                <ul>
                        <li><a href="blog_cats.php"><span>View Categories</span></a></li>
						<li><a href="manage_blog_cats.php"><span>Create New Category</span></a></li>
                        <li><a href="blogs.php"><span>View Blogs</span></a></li>
                        <li><a href="manage_blog.php"><span>Post new Blog</span></a></li>
                        <li><a href="blogComments.php"><span>Blog Comments</span></a></li>
				</ul>
                </li>
                <?php } ?> 
				<?php /*<li class="i_blocks_images"><a><span>Services</span></a> 
                <ul>
						<li><a href="services.php"><span>Services List</span></a></li>
						<li><a href="manage_services.php"><span>Add Service</span></a></li>
				</ul>
                </li>    
                <li class="i_table"><a><span>Brands</span></a> 
                <ul>
						<li><a href="brands.php"><span>Brands List</span></a></li>
						<li><a href="manage_brands.php"><span>Add Brand</span></a></li>
				</ul>
                </li>
        *   <li class="i_speech_bubbles_2"><a><span>Blogs</span></a> 
        *                 <ul>
        * 						<?php if($session->get('mode')=='admin') { ?>
        *                         <li><a href="blog_cats.php"><span>View Categories</span></a></li>
        * 						<li><a href="manage_blog_cats.php"><span>Create New Category</span></a></li>
        *                         <li><a href="writers.php"><span>View Writers</span></a></li>
        *                         <li><a href="manage_writer.php"><span>Add New Writer</span></a></li>
        *                         <?php } ?>
        *                         <?php if($session->get('mode')=='writer') { ?>
        *                         <li><a href="manage_writer.php?request=<?php echo $session->get('user_id');?>"><span>Update Information</span></a></li>
        *                         <?php } ?>
        *                         <li><a href="blogs.php"><span>View Blogs</span></a></li>
        *                         <li><a href="manage_blog.php"><span>Post new Blog</span></a></li>
        *                         <?php if($session->get('mode')=='admin') { ?>
        *                         <li><a href="writer_messages.php"><span>View Messages</span></a></li>
        *                         <?PHp } ?>
        * 				</ul>
        *                 </li>   
        */
     if($session->get('mode')=='admin') { ?>
                         <li class="i_graph"><a><span>Content Pages</span></a> 
                        <ul>
         						<li><a href="contents.php"><span>Page List</span></a></li>
         						<li><a href="manage_contents.php"><span>Add Another Page</span></a></li>
        				</ul>
                        </li>     
                         <li class="i_laptop"><a><span>Website Settings</span></a> 
                       <ul>
         						<li><a href="settings.php"><span>Settings</span></a></li>
        						<li><a href="manage_settings.php"><span>Add Setting</span></a></li>
       				</ul>
                         </li>     
<?php
	          /*               <li class="i_car"><a><span>Submissions</span></a> 
                            <ul>
         						<li><a href="vehicle_submissions.php"><span>Submissions</span></a></li>
       				        </ul>
                         </li> 
                         */
?> 
                      <li class="i_users"><a><span>Members</span></a> 
                            <ul>
         						<li><a href="members.php"><span>Manage Members</span></a></li>
                                <li><a href="manage_members.php"><span>Add Members</span></a></li>
       				        </ul>
                         </li> 
                          <?php } ?>
                          
                          
                           
                          <?php if($session->get('mode')=='broker'){ ?>
                          <li class="i_file_cabinet"><a><span>Brokers</span></a> 
                       <ul>
        						<li><a href="manage_brokers.php?request=<?php echo $_SESSION['user_id'];?>"><span>Your Profile</span></a></li>
                                <li><a href="broker_quote_requests.php"><span>Quote Requests</span></a></li>
       				</ul>
                         </li> 
                           <?php } 
                            if($session->get('mode')=='xxxxx'){ ?>
                          <li class="i_suitecase"><a><span>Brokers</span></a> 
                       <ul>
         						<li><a href="brokers.php"><span>Brokers List</span></a></li>
        						<li><a href="manage_brokers.php"><span>Add Brokers</span></a></li>
                                <li><a href="broker_quote_requests.php"><span>Brokers Quote Requests</span></a></li>
       				</ul>
                         </li> 
                          <?php } ?> 
                          
                          <?php  /* if($session->get('mode')=='admin') { ?>
                          <li class="i_suitecase"><a><span>Credit</span></a> 
                       <ul>
         						                                <li><a href="broker_quote_requests.php"><span>Brokers Quote Requests</span></a></li>
       				</ul>
                         </li> 
                          
                          
                        
                          
                          
                           <?php }
                             */ ?> 
                          
                         <?php /* if($session->get('mode')=='dealer'){ ?>
                         <li class="i_cash_register"><a><span>Your Profile</span></a> 
                       <ul>
        						<li><a href="manage_dealers.php?request=<?php echo $_SESSION['user_id'];?>"><span>Your Profile</span></a></li>
       				</ul>
                         </li>
                          <li class="i_car"><a><span>Available Leads</span></a> 
                         <ul>
                         <li><a href="dealer_quote_requests.php?request=<?php echo $_SESSION['user_id'];?>"><span>Vehicle Quote Requests</span></a></li>
                         </ul>
                         </li>
                          <?php } 
                          
                          */?>
                          
                          
                          
                           
                          <?php 
                          /*
                           if($session->get('mode')=='admin'){ ?>
                         <li class="i_cash_register"><a><span>Physicians</span></a> 
                       <ul>
         						<li><a href="dealers.php"><span>Physician List</span></a></li>
        						<li><a href="manage_dealers.php"><span>Add Physicians</span></a></li>
                                <?php
//	<li><a href="dealer_quote_requests.php"><span>Dealer Quote Requests</span></a></li>
?>
       				</ul>
                         </li>
                         
                         <?php }
                         */
                          ?>
                         
                     
                         <?php if($session->get('mode')=='admin'){ ?>
                         
                   
	 
     
          <?php
                        /*<li class="i_speech_bubbles_2"><a <?php if($page=='formqueries.php') echo 'class="active"';?>><span>Form Requests / Queries</span></a> 
                            <ul <?php if($page=='formqueries.php') echo 'style="display:block"';?> >
         						<li><a href="formqueries.php?type=contactus" <?php echo isset($type) && $type=='contactus'?'class="active"':'';?>><span>Contact Us</span></a></li>
      */              
?>            
                                
                               <?php
	/**
 *  <li><a href="formqueries.php?type=callback" <?php echo isset($type) && $type=='callback'?'class="active"':'';?>><span>Call Back</span></a></li>
 *                                 <li><a href="formqueries.php?type=offer" <?php echo isset($type) && $type=='offer'?'class="active"':'';?>><span>Offer</span></a></li>
 *                                 <li><a href="formqueries.php?type=testdrive" <?php echo isset($type) && $type=='testdrive'?'class="active"':'';?>><span>Test Driver</span></a></li>
 *                                 <li><a href="formqueries.php?type=emailafriend" <?php echo isset($type) && $type=='emailafriend'?'class="active"':'';?>><span>Email a Friend</span></a></li>
 *                                 <li><a href="formqueries.php?type=moreinfo" <?php echo isset($type) && $type=='moreinfo'?'class="active"':'';?>><span>More Info</span></a></li>
 *                                 <li><a href="formqueries.php?type=historyreport" <?php echo isset($type) && $type=='historyreport'?'class="active"':'';?>><span>History Report</span></a></li>
 *                                 <li><a href="formqueries.php?type=vehiclesourcing" <?php echo isset($type) && $type=='vehiclesourcing'?'class="active"':'';?>><span>Vehicle Sourcing</span></a></li>
 * 
       				        </ul>
                         </li> 
 */
?>
        			
                    		<li class="i_facebook_like"><a><span>Allergies</span></a> 
                         <ul>
        						<li><a href="allergy_descriptions.php"><span>Allergy Descriptions</span></a></li>
         						<li><a href="manage_allergy_descriptions.php"><span>Add Allergy Descriptions</span></a></li>
        				<br />
        						<li><a href="allergies.php"><span>Allergies</span></a></li>
         						<li><a href="manage_allergies.php"><span>Add Allergy</span></a></li>
        				</ul>
                         </li>
                         
                          
                    	<li class="i_facebook_like"><a><span>Health</span></a> 
                         <ul>
                         <li><a href="health.php"><span>Health</span></a></li>
         						<li><a href="manage_health.php"><span>Add Health</span></a></li><br />
                         
                         
                         
        						<li><a href="health_issues.php"><span>Health Issues</span></a></li>
         						<li><a href="manage_health_issues.php"><span>Add Health Issues</span></a></li>
        				
                        	
                        
        				</ul>
                         </li> 
                    
                    
                    
                    
                    <li class="i_facebook_like"><a><span>Insurers</span></a> 
                         <ul>
                         <li><a href="insurers.php"><span>Insurers</span></a></li>
         						<li><a href="manage_insurers.php"><span>Add Insurers</span></a></li><br />
        				</ul>
                         </li> 
                    
                    
                    
                    
                              <li class="i_facebook_like"><a><span>Prescriptions</span></a> 
                         <ul>
                         <li><a href="prescriptions.php"><span>Prescriptions</span></a></li>
         						<li><a href="manage_prescriptions.php"><span>Add Prescriptions</span></a></li><br />
        				
                        <li><a href="review_reasons.php"><span>Pres. Review Reasons</span></a></li>
         						<li><a href="manage_review_reasons.php"><span>Add Pres Review Reasons</span></a></li><br />
                        
                        
                        
                        </ul>
                         </li> 
                    
                    
        <li class="i_facebook_like"><a><span>Pharmacies</span></a> 
                         <ul>
                         <li><a href="pharmacies.php"><span>Pharmacies</span></a></li>
         						<li><a href="manage_pharmacies.php"><span>Add Pharmacies</span></a></li><br />
        				
                        <li><a href="pharmacy_additional.php"><span>Pharmacy Branches</span></a></li>
         						<li><a href="manage_pharmacy_additional.php"><span>Add Pharmacy Branches</span></a></li><br />
                        
                        
                        </ul>
                         </li> 
                    
                    
                    
                    <li class="i_facebook_like"><a><span>Chains</span></a> 
                         <ul>
                         <li><a href="chains.php"><span>Chains</span></a></li>
         						<li><a href="manage_chains.php"><span>Add Chains</span></a></li><br />
        				
                        
                        </ul>
                         </li> 
                    
                                 <li class="i_facebook_like"><a><span>Physicians</span></a> 
                         <ul>
                         <li><a href="physicians.php"><span>Physicians</span></a></li>
         						<li><a href="manage_physicians.php"><span>Add Physicians</span></a></li><br />
        	                         <li><a href="doctor_additional.php"><span>Clinics and Offices</span></a></li>
         						<li><a href="manage_doctor_additional.php"><span>Add Clinics and Offices</span></a></li><br />			
                        
                        </ul>
                         </li> 
                    
                    	<li class="i_facebook_like"><a><span>Testimonials</span></a> 
                         <ul>
        						<li><a href="testimonials.php"><span>Testimonial List</span></a></li>
         						<li><a href="manage_testimonials.php"><span>Add Testimonial</span></a></li>
        				</ul>
                         </li>  
                         <li class="i_question"><a><span>FAQs</span></a> 
                         <ul>
        						<li><a href="faqs.php"><span>FAQ List</span></a></li>
         						<li><a href="manage_faqs.php"><span>Add FAQs</span></a></li>
        				</ul>
                         </li>
                     <?php
                     /*
	 <li class="i_money"><a><span>Transactions</span></a> 
                         <ul>
        						<li><a href="dealer_transactions.php"><span>Transaction List</span></a></li>
        				</ul>
                         </li>
                         */
?>
                         
                         
                         
                         
                         
                         
                         
                         
                         
                         
                         
                         
                          
                            <?php } ?>


                          
                         
                       
                         
                        
                           
                         
                          <li class="i_locked"><a href="logout.php?" onclick="return confirm('Are you sure you want to Signout?')"><span>Logout</span></a>
                        
                                 </li>
                         



                    
                         
                         
                         
                       
                         
                         
                         
                         
                         
                         
                         
                         
                         
                         
                         
                          
                          <?php /*
	<li class="i_graph"><a><span>Rates</span></a> 
                         <ul>
        						<li><a href="rates.php"><span>Rates List</span></a></li>
         						<li><a href="manage_rates.php"><span>Add Rates</span></a></li>
        				</ul>
                         </li>  
                            */ ?>               
			</ul>