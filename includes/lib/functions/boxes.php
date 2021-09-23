<?php 
	function products_category(){
		global $request,$session;
?>
		<table cellspacing="0" cellpadding="0" border="0" align="left" style="">
			<tr>
				<td style=" <?php echo tep_background_image("images/tab_left.gif");?>" id="tableft"></td>
				<td>
					<div style="width: 210px;" id="tabcenter" class="content_head">
						<div style="padding-top: 10px; float: left;">PRODUCTS CATEGORY</div>
					</div>
				</td>
				<td style=" <?php echo tep_background_image("images/tab_right.gif");?>" id="tabright"></td>
			</tr>
			<tr class="products">
				<td valign="top" colspan="3" style="border:1px solid #D2D7A5;padding:2px;" id="divProducts">
					<table id="prdGroups" width="100%" cellpadding="0" <?php if(HIDE_PRODUCT_GROUP=='Y')echo "cellspacing=0";?>>
						<?php 
							$gid = $request->getvalue('gid','int');
							$cid = $request->getvalue('cid','int');
							$pid = $request->getvalue('pid','int');
							if($pid>0){
								$ids_sql = "select * from " . TABLE_PRODUCTS . " where products_id='" . $pid . "'";
								$ids_result = tep_db_fetch_array(tep_db_query($ids_sql));
								if($gid==0)$gid = $ids_result['products_group'];
								if($cid==0)$cid = $ids_result['products_category'];
							}
							$group_sql = "select * from " . TABLE_PRODUCT_GROUPS . " where product_groups_archive='N' order by product_groups_name asc";
							$group_query = tep_db_query($group_sql);
							while($group_result=tep_db_fetch_array($group_query)){
								$category_sql = "select * from " . TABLE_PRODUCT_CATEGORY . " where product_category_archive='N' and product_category_group='" . $group_result['product_groups_id'] . "'";
								$category_query = tep_db_query($category_sql);
								//if(tep_db_num_rows($category_query)>0)
								//echo "<tr><td style='text-align:left;padding:6px 0px 0px 0px;'>";//background:url(images/rightmenu_bg.gif) repeat-x;
								//else
								//echo "<tr><td style='text-align:left;padding:4px 0px 4px 0px;'>";
								if(HIDE_PRODUCT_GROUP!='Y'){
									echo "<tr><td style='text-align:left;padding:6px 0px 0px 0px;'>";
									echo "<div style='margin-bottom:2px;'>";
									$product_count_sql = "select count(*) as count from " . TABLE_PRODUCTS . " where products_archive='N' and products_group='" . $group_result['product_groups_id'] . "'";
									$product_count = tep_db_fetch_array(tep_db_query($product_count_sql));
									if($gid==$group_result['product_groups_id'])echo tep_image("images/icons/product_down_arrow.gif");
									else echo tep_image("images/icons/product_arrow.gif");
									echo "<a href='" . tep_href_link(FILENAME_PRODUCTS,'gid=' . $group_result['product_groups_id']) . "'>";
									echo stripslashes($group_result['product_groups_name']);
									if($product_count['count']>0){
										echo "(" . $product_count['count'] . ")";
									}
									echo "<a/>";
									echo "</div>";
								}else{
									echo "<tr><td style='text-align:left;padding:0px;margin:0px;background:none;'>";
								}
								echo "<table width='100%' id='prdCategories' style='";
								if($gid==$group_result['product_groups_id'] || HIDE_PRODUCT_GROUP=='Y')echo "display:block;";
								if(HIDE_PRODUCT_GROUP=='Y')echo "margin:0px;padding:0px;";
								echo "'>";
								while($category_result=tep_db_fetch_array($category_query)){
									echo "<tr><td width='100%' style='width:195px;'>";
									$product_count_sql = "select count(*) as count from " . TABLE_PRODUCTS . " where products_archive='N' and products_category='" . $category_result['product_category_id'] . "'";
									$product_count = tep_db_fetch_array(tep_db_query($product_count_sql));
									echo "<a href='" . tep_href_link(FILENAME_PRODUCTS,'gid=' . $group_result['product_groups_id'] . '&cid=' . $category_result['product_category_id']) . "'";
									if($cid==$category_result['product_category_id'])echo " style='text-decoration:underline;'";
									echo ">";
									echo stripslashes($category_result['product_category_name']);
									if($product_count['count']>0){
										echo "(" . $product_count['count'] . ")";
									}
									echo "<a/>";
									echo "</td></tr>";
								}
								echo "</table>";
								echo "</td></tr>";
							}
						?>
					</table>
				</td>
			</tr>
		</table>
<?php 
	}
?>
<?php 
	function latest_products(){
		global $request;
?>
		<table cellspacing="0" cellpadding="0" border="0" align="left" style="">
			<tr>
				<td style=" <?php echo tep_background_image("images/tab_left.gif");?>" id="tableft"></td>
				<td>
					<div style="width: 210px;" id="tabcenter" class="content_head">
						<div style="padding-top: 10px; float: left;">LATEST PRODUCTS</div>
					</div>
				</td>
				<td style=" <?php echo tep_background_image("images/tab_right.gif");?>" id="tabright"></td>
			</tr>
			<tr>
				<td valign="top" colspan="3" style="border:1px solid #D2D7A5;padding:2px;">
					<div>
						<?php 
							$latest_product_sql = "select p.* from " . TABLE_PRODUCTS . " p, ";
							$latest_product_sql .= TABLE_PRODUCT_GROUPS . " pg," . TABLE_PRODUCT_CATEGORY . " pc ";
							$latest_product_sql .= " where p.products_group=pg.product_groups_id";
							$latest_product_sql .= " and p.products_category=pc.product_category_id";
							$latest_product_sql .= " and p.products_archive='N' and pg.product_groups_archive='N' and pc.product_category_archive='N' ";
							$latest_product_sql .= " order by p.products_created_date desc limit 0,1";
							$latest_product_query = tep_db_query($latest_product_sql);
							if(tep_db_num_rows($latest_product_query)>0){
								$latest_product_result = tep_db_fetch_array($latest_product_query);
								echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
								echo "<tr>";
								echo "<td valign='top' style='padding:5px;text-align:left;'>";
								echo "<a href='" . tep_href_link(FILENAME_PRODUCT_DETAILS,'pid=' . $latest_product_result['products_id']) . "'>";
								echo tep_image("images/products/" . $latest_product_result['products_image'],'','120','120','',true,true);
								echo "</a></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td valign='top' style='padding-left: 10px; padding-right: 5px;text-align:left;'>";
								echo "<b>" . $latest_product_result['products_name'] . "</b>";
								echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td valign='top' style='padding-left: 10px; padding-right: 5px;text-align:right;'>";
								echo "<a href='" . tep_href_link(FILENAME_PRODUCT_DETAILS,'pid=' . $latest_product_result['products_id']) . "'>";
								echo "<b>" . "More Details >" . "</b>";
								echo "</a>";
								echo "</td>";
								echo "</tr>";
								echo "</table>";
							}
						?>
					</div>
				</td>
			</tr>
		</table>
<?php 
	}
?>
<?php 
	function featured_products(){
		global $request;
		
?>
		<table cellspacing="0" cellpadding="0" border="0" align="left" style="">
			<tr>
				<td style=" <?php echo tep_background_image("images/tab_left.gif");?>" id="tableft"></td>
				<td>
					<div style="width:495px;" id="tabcenter" class="content_head">
						<div style="padding-top: 10px; float: left;">FEATURED PRODUCTS</div>
					</div>
				</td>
				<td style=" <?php echo tep_background_image("images/tab_right.gif");?>" id="tabright"></td>
			</tr>
			<tr>
				<td valign="top" colspan="3" style="padding:5px;border:1px solid #D2D7A5;" class="products_grid">
					<table width='100%' border='0' cellpadding='0' cellspacing='0'>
						<?php 
							$featured_sql = "select p.* from " . TABLE_PRODUCTS . " p, ";
							$featured_sql .= TABLE_PRODUCT_GROUPS . " pg," . TABLE_PRODUCT_CATEGORY . " pc ";
							$featured_sql .= " where p.products_group=pg.product_groups_id";
							$featured_sql .= " and p.products_category=pc.product_category_id";
							$featured_sql .= " and p.products_archive='N' and pg.product_groups_archive='N' and pc.product_category_archive='N' and products_is_featured='Y'";
							//$featured_sql = "select * from " . TABLE_PRODUCTS . " where products_archive='N' and products_is_featured='Y'";
							$featured_query = tep_db_query($featured_sql);
							$icnt = 0;
							
							while($featured_result=tep_db_fetch_array($featured_query)){
								if(($icnt%2)==0)echo "<tr>";
								echo "<td valign='top' class='products_box'>";
								echo "<table border='0' cellpadding='0' cellspacing='0' style='width:235px;'>";
								echo "<tr><td valign='top' class='products_heading' colspan='2'>" . $featured_result['products_name'] . "</td><tr>";
								echo "<tr height='20'><td valign='top' colspan='2'></td></tr>";
								echo "<tr><td valign='top' style='width:105px;'>";
								echo "<div style='width:100px;height:100px;'>";
								echo "<a href='" . tep_href_link(FILENAME_PRODUCT_DETAILS,'pid=' . $featured_result['products_id']) . "'>";
								echo tep_image("images/products/" . $featured_result['products_image'],'','100','100','',true,true);
								echo "<a>";
								echo "</div>";
								echo "</td><td valign='top' align='center'>";
								echo tep_image("images/add_to_cart.png",'','','',' style="cursor:pointer;" onClick="addtocart(' . $featured_result['products_id'] . ');"');
								echo "<br>";
								echo "<a href='" . tep_href_link(FILENAME_PRODUCT_DETAILS,'pid=' . $featured_result['products_id']) . "'>";
								echo tep_image("images/buttons/details.gif");
								echo "</a>";
								echo "</td></tr>";
								$dot_value='';
								if(strlen($featured_result['products_short_description'])>155)
								$dot_value=' ... ';
								echo "<tr><td valign='top' colspan='2' style='text-align:left;font-weight:bold;padding-top:8px;'>" .substr($featured_result['products_short_description'],0,155) .$dot_value. "</td></tr>";
								echo "</table>";
								echo "</td>";
								$icnt++;
								
							}
						?>
					</table>
				</td>
			</tr>
		</table>
<?php 
	}
?>