<?php
$users=new users();
$userid=intval($session->get("user_id"));
$users->load($userid);
?>
				<div class="cat">
    			<div class="tit">Hi <?php echo $users->first_name?>,</div>
    			<ul>
    				<li class="noarrow">
    					<a href="<?php echo HTTP_HOME_URL ?>/m/dashboard.php">Home</a>
    				</li>
					<?php
					if($users->user_type=='R'){?>
						<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/merchantdeals.php">Deals</a></li>
					<?php } ?>
    				<li>
    					<div>
    						<ul>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/accountsettings.php#pi">Personal Information</a></li>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/accountsettings.php#li">Login Information</a></li>
    							<li class="noborder noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/accountsettings.php#set">Settings</a></li>
    						</ul>
    					</div>
    					<a href="<?php echo HTTP_HOME_URL;?>m/accountsettings.php">Account Settings</a>
    				</li>
    				<li>
    					<div>
    						<ul>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/<?php echo $users->user_type=='R'?"mprofiledetails.php":"profiledetails.php";?>#ep">Edit Profile</a></li>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/<?php echo $users->user_type=='R'?"mprofiledetails.php":"profiledetails.php";?>#ei">Edit Interests</a></li>
    							<li class="noborder noarrow"><a href="<?php echo HTTP_HOME_URL;?><?php echo $users->user_type=='R'?"viewmprofile.php":"viewprofile.php";?>?uid=<?php echo $userid;?>">View Profile</a></li>
    						</ul>
    					</div>
    					<a href="<?php echo HTTP_HOME_URL;?>m/profiledetails.php">Profile</a>
    				</li>
					<?php
					if($users->user_type!='R'){?>
    				<li>
                    <div>
    						<ul>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/user_events.php">Event History</a></li>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/user_deals.php">Shop & Swap History</a></li>

    						</ul>
    					</div>
                    <a href="<?php echo HTTP_HOME_URL;?>m/user_events.php">Calendar</a></li>
    				<?php } ?>
    				<li>
    					<div>
    						<ul>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/buyhistory.php">Billing &amp; Payment</a></li>
    						<!--	<li class="noborder noarrow"><a href="#">Payment Information</a></li> -->
    						</ul>
    					</div>
    					<a href="<?php echo HTTP_HOME_URL;?>m/buyhistory.php">Payment</a>
    				</li>
    				<li >
    					<div>
    						<ul>
    							<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/feedback.php">Feedback</a></li>
                  <li class="noborder noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/tickets/ticketlist.php">Support</a></li>
    						</ul>
    					</div>
    					<a href="<?php echo HTTP_HOME_URL;?>m/feedback.php">Leave Feedback</a>
    				</li>
    				<li class="noarrow"><a href="<?php echo HTTP_HOME_URL;?>m/inbox.php">Inbox</a></li>
    			</ul>
    		</div>