<?php 
	function registration(){
		global $request,$session,$state_array;
?>
<tr class="grid_container">
<td  colspan="3" style="padding-top:5px;">					
<div align=left>
<span id="ctl00_cphPageContent_lblError" style="color:Red;"></span>
<div id="pagecontent" style="padding-left:10px;">		
<table border=0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td id="ctl00_cphPageContent_tdRegister">
<b>Register information</b>
<div  class="register_container">
<table cellpadding=0 cellspacing=0 width="100%" border=0>
<tr>
	<td width="50%">
	<table width="100%" border=0 cellpadding=0 cellspacing=5>
		<tr>
			<td width="100px"> First Name:</td>
			<td>
				<?php echo tep_draw_input_field("txtFirstName",'',' id="txtFirstName" style="width:130px;" maxlenght="100" onkeyup="javascript:fillinfo();"');?>
				<span id="firstname" style="color:Red;display:none;">Required</span>
				Last Name:
				<?php echo tep_draw_input_field("txtLastName",'',' id="txtLastName" style="width:130px;" maxlenght="64" onkeyup="javascript:fillinfo();"');?>
				<span id="lastname" style="color:Red;display:none;">Required</span>
			</td>
		</tr>
		<tr>
			<td>Address1:</td>
			<td>
				<?php echo tep_draw_input_field("txtAddress1",'',' id="txtAddress1" style="width:370px;" maxlenght="100" onkeyup="javascript:fillinfo();"');?>
				<span id="address1" style="color:Red;display:none;">Required</span>
			</td>
		</tr>	
		<tr>
			<td>Address2:</td>
			<td>
				<?php echo tep_draw_input_field("txtAddress2",'',' id="txtAddress2" style="width:370px;" maxlenght="100" onkeyup="javascript:fillinfo();"');?>
				<span id="address2" style="color:Red;display:none;">Required</span>
			</td>
		</tr>
		<tr>
			<td>City:</td>
			<td>
				<?php echo tep_draw_input_field("txtCity",'',' id="txtCity" style="width:60px;" maxlenght="50" onkeyup="javascript:fillinfo();"');?>
				<span id="city" style="color:#FF0033;display:none;">Required</span>
				State:<?php echo tep_draw_pull_down_menu("txtState",$state_array,'',' id="txtState" onChange="javascript:fillinfo();"');?>
				<span id="state" style="color:Red;display:none;">Required</span>
				Zip:  <?php echo tep_draw_input_field("txtZip",'',' id="txtZip" style="width:50px;" maxlenght="10" onkeyup="javascript:fillinfo();"');?>
				<span id="zip" style="color:Red;display:none;">Required</span>
			</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>
			<?php 
				echo tep_draw_input_field("txtEmail",$session->get("temp_login_email"),' id="txtEmail" style="width:240px;background-color:#f0f0f0;" maxlenght="100" readonly');
			?>
			</td>
		</tr>
		<tr id="ctl00_cphPageContent_trPass">
			<td>Password:</td>
			<td>
				<?php echo tep_draw_password_field("txtPassword",'',' id="txtPassword" style="width:130px;" maxlenght="20"');?>
				<span id="password" style="color:Red;display:none;">Required</span>
			</td>
		</tr>
		<tr id="ctl00_cphPageContent_trConfirmPass">
			<td>Confirm Password:</td>
			<td>
				<?php echo tep_draw_password_field("txtCPassword",'',' id="txtCPassword" style="width:130px;" maxlenght="20"');?>
				<span id="confirm_password" style="color:Red;display:none;">Required</span>
			</td>
		</tr>
	</table>
	</td>
</tr>
</table>
</div>
</td>
</tr>
</table></div></td></tr>
<?php }?>
<?php 
	function shipping_information(){
		global $request,$session,$state_array,$customer_result,$state_code_array;
?>
	<tr class="grid_container">
	<td style="padding-left:10px;">
	<div style="padding:5px;"><b>Shipping Information</b></div>
	<div class="checkout_container">
	<table width="100%" border=0 cellpadding=0 cellspacing=5>
	<tr>
	<td style="width:95px;">Method:</td>
	<td>
	<span class="disableclass" id="spnMethodD"></span>
	<span id="spnMethod">
	<select name="shipMethod" id="shipMethod" style="width:154px;" onChange="tax_calculate();">
	<option selected="selected" value="">Ground Rates</option>
	<option value="4.95">3 Day Express</option>
	<option value="9.95">2 Day Express</option>
	<option value="14.95">Overnight</option>
	<option value="19.95">Overnight Priority</option>
	<option value="32.95">Saturday</option>
	</select>
	</span>
	</td>
	</tr>
	<tr>
	<td>Name:</td>
	<td>
	<span class="disableclass" id="spnNameD"></span>
	<span id="spnName">
	<?php echo tep_draw_input_field("shiptxtName",$customer_result['Shipping_Name'],' id="shiptxtName" style="width:150px;" maxlenght="64"');?>
	<span id="shipName" style="color:#FF0033;display:none;">Required</span>
	</span>														    
	</td>
	</tr>
	<tr>
	<td>Street Address:</td>
	<td>
	<span class="disableclass" id="spnAddressD"></span>
	<span id="spnAddress">
	<?php echo tep_draw_input_field("shiptxtAddress",$customer_result['Shipping_Address'],' id="shiptxtAddress" style="width:150px;" maxlenght="64"');?>
	<span id="shipAddress" style="color:#FF0033;display:none;">Required</span>
	</span>
	</td>
	</tr>								
	<tr>
	<td>City:</td>
	<td>
	<span class="disableclass" id="spnCityD"></span>
	<span id="spnCity">
	<?php echo tep_draw_input_field("shiptxtCity",$customer_result['Shipping_City'],' id="shiptxtCity" style="width:150px;" maxlenght="32"');?>
	<span id="shipCity" style="color:#FF0033;display:none;">Required</span>
	</span>
	</td>
	</tr>								
	<tr>
	<td>State:</td>
	<td>										
	<span class="disableclass" id="spnStateD"></span>
	<span id="spnState">
	<?php 
		$state_array1 = array_flip($state_code_array);
		echo tep_draw_pull_down_menu("shiptxtState",$state_array,$state_array1[$customer_result['Shipping_State']],' id="shiptxtState" style="width:154px;" onChange="tax_calculate();"');
	?>
	<span id="shipState" style="color:Red;display:none;">Required</span>
	</span>
	</td>
	</tr>
	<tr>
	<td>Zip:</td>
	<td>
	<span class="disableclass" id="spnZipD"></span>
	<span id="spnZip">
	<?php echo tep_draw_input_field("shiptxtZip",$customer_result['Shipping_Zip'],' id="shiptxtZip" style="width:150px;" maxlenght="10"');?>
	<span id="shipZip" style="color:#FF0033;display:none;">Required</span>
	</span>
	</td>
	</tr>							
	</table>
	</div>
	<br />
	</td>
	</tr>
<?php }?>
<?php 
function payment_information(){
	global $request,$session,$customer_result;
?>
	<tr class="grid_container">
		<td style="padding-left:10px;">
			<div style="padding:5px;"><b>Payment Information</b></div>
			<div class="checkout_container">
				<table width="100%" border=0 cellpadding=0 cellspacing=5>
					<tr>
						<td style="width:95px;">Payment Method:</td>
						<td>
							<?php 
								$payment_sql = "select * from " . TABLE_GATEWAY;
								$payment_result = tep_db_fetch_array(tep_db_query($payment_sql));
								$payment_array = array();
								if($payment_result['Is_AuthNet']=='Y')$payment_array[] = array("id"=>"au","text"=>"Credit Card");
								if($payment_result['Is_Paypal']=='Y')$payment_array[] = array("id"=>"pa","text"=>"Paypal");
								echo tep_draw_pull_down_menu("payment_mode",$payment_array,'',' id="payment_mode"');
							?>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
<?php 
}
?>
<?php 
function billing_information(){
	global $request,$session,$state_array,$customer_result,$state_code_array;
?>
	<tr class="grid_container">
		<td style="padding-left:10px;">
			<div style="padding:5px;"><b>Billing Information</b></div>
			<div class="checkout_container">
			<div style="position:relative;height:0px;">
			<div style="position:absolute;left:300px;top:50px;height:0px;width:500px;">
			<?php echo "<div style='height:40px;'>" . tep_image("images/cards.gif",'','','',' style="width:auto;height:auto;"') . "</div>";?>
			<?php echo tep_image("images/anet-logo_sm.gif",'','','',' style="width:auto;height:auto;"');?>
			</div>
			</div>
				<table width="100%" border=0 cellpadding=0 cellspacing=5>
					<tr>
						<td colspan='2'>* Required Fields</td>
					</tr>
					<tr>
						<td>Credit Card</td>
						<td>
						<?php echo tep_draw_input_field("txtCardNumber",""," id='txtCardNumber' style='width:150px;' maxlength='150'") . "&nbsp;*";?>
					</tr>
					<tr>
						<td>Card Holder Name</td>
						<td>
						<?php echo tep_draw_input_field("txtHolderName",""," id='txtHolderName' style='width:150px;' maxlength='50'") . "&nbsp;*";?>
					</tr>
					<tr>				
						<td>Card Type</td>
						<td>
							<?php 
								$card_types = array(array("id"=>"VI","text"=>"Visa"),
															array("id"=>"MC","text"=>"Master Card"),
															array("id"=>"NO","text"=>"Discover/Novus"),
															array("id"=>"AM","text"=>"American Express")
															);
								echo tep_draw_pull_down_menu("txtCardType",$card_types,""," id='txtCardType' style='width:115px;margin-bottom:2px;margin-top:2px;'");
							?>
						</td>
					</tr>				
					<tr>
						<td>Expiration Date</td>
						<td>
							<?php 
								$month_array = array(array("id"=>"01","text"=>"JAN"),
															array("id"=>"02","text"=>"FEB"),
															array("id"=>"03","text"=>"MAR"),
															array("id"=>"04","text"=>"APR"),
															array("id"=>"05","text"=>"MAY"),
															array("id"=>"06","text"=>"JUN"),
															array("id"=>"07","text"=>"JUL"),
															array("id"=>"08","text"=>"AUG"),
															array("id"=>"09","text"=>"SEP"),
															array("id"=>"10","text"=>"OCT"),
															array("id"=>"11","text"=>"NOV"),
															array("id"=>"12","text"=>"DEC")
															);
								$year_array = array(array("id"=>"2009","text"=>"2009"),
															array("id"=>"2010","text"=>"2010"),
															array("id"=>"2011","text"=>"2011"),
															array("id"=>"2012","text"=>"2012"),
															array("id"=>"2013","text"=>"2013"),
															array("id"=>"2014","text"=>"2014"),
															array("id"=>"2015","text"=>"2015"),
															array("id"=>"2016","text"=>"2016"),
															array("id"=>"2017","text"=>"2017"),
															array("id"=>"2018","text"=>"2018"),
															array("id"=>"2019","text"=>"2019"),
															array("id"=>"2020","text"=>"2020"),
															array("id"=>"2021","text"=>"2021"),
															array("id"=>"2022","text"=>"2022"),
															array("id"=>"2023","text"=>"2023"),
															array("id"=>"2024","text"=>"2024"),
															array("id"=>"2025","text"=>"2025"),
															array("id"=>"2026","text"=>"2026"),
															array("id"=>"2027","text"=>"2027"),
															array("id"=>"2028","text"=>"2028"),
															array("id"=>"2029","text"=>"2029"),
															array("id"=>"2030","text"=>"2030"),
															array("id"=>"2031","text"=>"2031"),
															array("id"=>"2032","text"=>"2032"),
															array("id"=>"2033","text"=>"2033"),
															array("id"=>"2034","text"=>"2034")
															);
								echo tep_draw_pull_down_menu("txtCardMonth",$month_array,""," id='txtCardMonth' style='width:55px;margin-bottom:2px;margin-top:2px;'");
								echo tep_draw_pull_down_menu("txtCardYear",$year_array,""," id='txtCardYear' style='width:55px;margin-bottom:2px;margin-top:2px;'");
							?>
					</td>
					</tr>
					<tr>
					<td valign=top>Security Code</td>
					<td>
					<?php echo tep_draw_input_field("txtSecCode",""," id='txtSecCode' style='width:50px;' maxlength='3'") . "&nbsp;*";?>
					<A style="COLOR: #02344f; TEXT-DECORATION: none; font-size:11px;" href="javascript:doopen('S')">What's this?</A><br>
					<DIV style="FONT-SIZE: 10px; COLOR: gray">(Last 3 digits of number printed on back)</DIV>
					</td>
					</tr>					
					<tr>
						<td style="width:95px;"><b>Billing Address</b></td>
						<td>
							<?php 
								echo tep_draw_checkbox_field("sameasregister",'','',' id="sameasregister" onClick="sameas(this);"');
								echo "Same as Registration";
							?>
						</td>
					</tr>
					<tr>
						<td>Name:</td>
						<td>
						<span class="disableclass" id="spnNameD"></span>
						<span id="spnName">
						<?php echo tep_draw_input_field("billtxtName",$customer_result['Bill_Name'],' id="billtxtName" style="width:150px;" maxlenght="64"');?>
						<span id="billName" style="color:#FF0033;display:none;">Required</span>
						</span>														    
						</td>
						</tr>
						<tr>
						<td>Street Address:</td>
						<td>
						<span class="disableclass" id="spnAddressD"></span>
						<span id="spnAddress">
						<?php echo tep_draw_input_field("billtxtAddress",$customer_result['Bill_Address'],' id="billtxtAddress" style="width:150px;" maxlenght="64"');?>
						<span id="billAddress" style="color:#FF0033;display:none;">Required</span>
						</span>
						</td>
						</tr>								
						<tr>
						<td>City:</td>
						<td>
						<span class="disableclass" id="spnCityD"></span>
						<span id="spnCity">
						<?php echo tep_draw_input_field("billtxtCity",$customer_result['Bill_City'],' id="billtxtCity" style="width:150px;" maxlenght="32"');?>
						<span id="billCity" style="color:#FF0033;display:none;">Required</span>
						</span>
						</td>
						</tr>								
						<tr>
						<td>State:</td>
						<td>										
						<span class="disableclass" id="spnStateD"></span>
						<span id="spnState">
						<?php 
							$state_array1 = array_flip($state_code_array);
							echo tep_draw_pull_down_menu("billtxtState",$state_array,$state_array1[$customer_result['Bill_State']],' id="billtxtState" style="width:154px;"');
						?>
						<span id="billState" style="color:Red;display:none;">Required</span>
						</span>
						</td>
						</tr>
						<tr>
						<td>Zip:</td>
						<td>
						<span class="disableclass" id="spnZipD"></span>
						<span id="spnZip">
						<?php echo tep_draw_input_field("billtxtZip",$customer_result['Bill_Zip'],' id="billtxtZip" style="width:150px;" maxlenght="10"');?>
						<span id="billZip" style="color:#FF0033;display:none;">Required</span>
						</span>
						</td>
					</tr>		
				</table>
			</div>
		</td>
	</tr>
<?php 
}
?>