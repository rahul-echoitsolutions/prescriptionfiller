<?php 
function pagination(){
	global $page,$total_page,$selrows;
?>
		<div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top" align="right" id="page_link">
						<?php if($page>1){?>
							<a href="javascript:dopage('1')"><font color="#666666">First</font></a>&nbsp;
							<a href="javascript:dopage('<?php echo $page -1;?>')"><font color="#666666">&lt;Prev&nbsp;</font></a>
						<?php }else{?>
							<font color="#666666">First</font>&nbsp;
							<font color="#666666">&lt;Prev&nbsp;</font>
						<?php } if($page<$total_page){?>
							<a href="javascript:dopage('<?php echo $page+1;?>')"><font color="#666666">Next&gt;&nbsp;</font></a>
							<a href="javascript:dopage('<?php echo $total_page;?>')"><font color="#666666">Last</font></a>
						<?php }else{?>
							<font color="#666666">Next&gt;&nbsp;</font>&nbsp;
							<font color="#666666">Last</font>
						<?php } ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<font color="#666666"><?php echo 'Page ' . $page . ' of ' . $total_page; ?></font>
						&nbsp;&nbsp;&nbsp;
						<font color="#666666">Rows</font>&nbsp;
						<?php 
							//echo tep_draw_pull_down_menu('selrows',$rows_array,$selrows,'style="width:40px;MARGIN-TOP:1px;" onchange="javascript:loadrows();"');
						?>
						<select name="selrows" style="width:40px;MARGIN-TOP:1px;" onchange="javascript:loadrows();">
							<option value="-1" <?php if($selrows=="-1") echo "selected";?>>All</option>
							<option value="20" <?php if($selrows=="20") echo "selected";?>>20</option>
							<option value="30" <?php if($selrows=="30") echo "selected";?>>30</option>
							<option value="50" <?php if($selrows=="50") echo "selected";?>>50</option>
							<option value="100" <?php if($selrows=="100") echo "selected";?>>100</option>
							<option value="200" <?php if($selrows=="200") echo "selected";?>>200</option>
							<option value="500" <?php if($selrows=="500") echo "selected";?>>500</option>
						</select>
						<?php echo tep_draw_hidden_field('page','',' id="page"');?>
					</td>
				</tr>
			</table>
			<script>
				//paging scripts
				function loadrows(){
					var ddlrows = document.forms[0].elements['selrows'];
					var hdnpage = document.forms[0].elements['page'];
					if(ddlrows){
					  hdnpage.value = "1";
					  document.forms[0].submit();
					}
				}
				function dopage(pno){
					var hdnpage = document.forms[0].elements['page'];
					if(hdnpage){
					  hdnpage.value = pno;
					  document.forms[0].submit();
					}
				}
			//paging scripts
			</script>
		</div>
<?php 
}

function sharespaging(){		
		global $page,$total_page,$selrows,$sourcepage;
		
		if($sourcepage=='') $sourcepage='shares.php';
		
		$adjacents = 3;
		
		if($page) 
			$start = ($page - 1) * $selrows; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		
				
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//< page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = $total_page;
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		
		if($lastpage > 1)
		{	
			
			$pagination .= "<div class=\"pagination\">Page ";
			//< button
			if ($page > 1) 
				$pagination.= "<a style='margin-right:5px;' href=".$sourcepage."?page=$prev><</a>";
			else
				$pagination.= "<span style='margin-right:5px;' class=\"disabled\"><</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=".$sourcepage."?page=$counter>$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=".$sourcepage."?page=$counter>$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=".$sourcepage."?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=".$sourcepage."?page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=".$sourcepage."?page=1>1</a>";
					$pagination.= "<a href=".$sourcepage."?page=2>2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=".$sourcepage."?page=$counter>$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=".$sourcepage."?page=$lpm1>$lpm1</a>";
					$pagination.= "<a href=".$sourcepage."?page=$lastpage>$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=".$sourcepage."?page=1\>1</a>";
					$pagination.= "<a href=".$sourcepage."?page=2\>2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=".$sourcepage."?page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=".$sourcepage."?page=$next>></a>";
			else
				$pagination.= "<span class=\"disabled\">></span>";
			$pagination.= "</div>\n";		
		}
		echo $pagination;
	}
	
	//pagination function for frondend screens like account settnigs, tickets..
	function pagination_fe($type=''){
		global $page,$total_page,$selrows;
		$next = $page==$total_page?$total_page:$page+1;
		$prev = $page==1?1:$page-1;
		?>
		<div class="navbutton">
    	<table class="navdata">
    		<tr>
    			<td><a href="javascript:dopagefe(<?php echo $prev;?>,'<?php echo $type;?>')" class="navfl">&laquo; Previous</a></td>
    			<?php 
    				for($i=1;$i<=$total_page;$i++){
    					$class="box";
    					if($i==$page){
    						$class="activebox";
    					}?>
    			<td><a href="javascript:dopagefe(<?php echo $i;?>,'<?php echo $type;?>')" class="<?php echo $class;?>"><?php echo $i;?></a></td>
    			<?php
						}
					?>
    			<td><a href="javascript:dopagefe(<?php echo $next;?>,'<?php echo $type;?>')" class="navfl">Next &raquo;</a></td>
    		</tr>
    	</table>
    </div>
    <?php echo tep_draw_hidden_field('page'.$type,'',' id="page'.$type.'"');?>
    <script>
	    function dopagefe(pno,type){
				var hdnpage = document.forms[0].elements['page'+type];
				if(hdnpage){
				  hdnpage.value = pno;
				  document.forms[0].submit();
				}
				
				
			}
    </script>
		<?php
	}
?>
<?php
function testimonialspaging(){		
		global $page,$total_page,$selrows,$sourcepage;
		
		if($sourcepage=='') $sourcepage='testimonials.php';
		
		$adjacents = 3;
		
		if($page) 
			$start = ($page - 1) * $selrows; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		
				
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//< page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = $total_page;
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		
		if($lastpage > 1)
		{	
			
			$pagination .= "<div class=\"pagination\">Page ";
			//< button
			if ($page > 1) 
				$pagination.= "<a style='margin-right:5px;' href=".$sourcepage."?page=$prev><</a>";
			else
				$pagination.= "<span style='margin-right:5px;' class=\"disabled\"><</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=".$sourcepage."?page=$counter>$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=".$sourcepage."?page=$counter>$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=".$sourcepage."?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=".$sourcepage."?page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=".$sourcepage."?page=1>1</a>";
					$pagination.= "<a href=".$sourcepage."?page=2>2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=".$sourcepage."?page=$counter>$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=".$sourcepage."?page=$lpm1>$lpm1</a>";
					$pagination.= "<a href=".$sourcepage."?page=$lastpage>$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=".$sourcepage."?page=1\>1</a>";
					$pagination.= "<a href=".$sourcepage."?page=2\>2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=".$sourcepage."?page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=".$sourcepage."?page=$next>></a>";
			else
				$pagination.= "<span class=\"disabled\">></span>";
			$pagination.= "</div>\n";		
		}
		echo $pagination;
	}
?>