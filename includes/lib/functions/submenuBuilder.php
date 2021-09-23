<?php 
	 function getSubmenu($menu){ 
        $query = "select * from " . TABLE_CONTENTS . " where menupos ='$menu' and status = 'active' and submenupos=0 order by IF (menuorder = 0, 9999999, menuorder)"; 
        $query_sql=tep_db_query($query);
		$rowscount = tep_db_num_rows($query_sql);
		if($rowscount>0)
		{
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else { return "empty"; 
        }
    }
    
    
    function get2ndTierLinks($menu,$submenupos){ 
        $query = "select * from " . TABLE_CONTENTS . " where menupos ='$menu' and status = 'active' and submenupos=$submenupos 
        order by IF (menuorder = 0, 9999999, menuorder)"; 
        $query_sql=tep_db_query($query);
		$rowscount = tep_db_num_rows($query_sql);
		if($rowscount>0)
		{
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else { return "empty"; 
        }
    }
    
    
    function generate2ndTierLinks($menu,$submenupos) {
        
          $subAbout   = get2ndTierLinks($menu,$submenupos);
          $text       = '';
          $url        = HTTP_HOME_URL;
          if(is_array($subAbout)){
              $text = "<ul class='dropdown-menu'>";
              foreach ($subAbout as $key=>$value){
                  $nofollow = ($value['nofollow']==1)?'rel = "nofollow"':'';
                  $text .= "<li><a href=\"{$url}{$value['url_key']}\" $nofollow>{$value['title']}</a></li>";
              }
              $text .= ("</ul>");   
          }
          
          return $text;
    }
    
    
        function loadProvinces($name,$id,$style='',$val='') {
        $StateProv["BC"]="British Columbia";
        $StateProv["AB"]="Alberta";
        $StateProv["SK"]="Saskatchewan";
        $StateProv["MB"]="Manitoba";
        $StateProv["ON"]="Ontario";
        $StateProv["QC"]="Quebec";
        $StateProv["NB"]="New Brunswick";
        $StateProv["NS"]="Nova Scotia";
        $StateProv["NL"]="Newfoundland";
        $StateProv["YT"]="Yukon Territory";
        $StateProv["NT"]="Northwest Territory";
        $StateProv["NU"]="Nunavut Territory";
        $StateProv["PE"]="Prince Edward Island";
        $prov3.= "<select name=\"$name\" id=\"$id\" $style>";
        $prov3.= "<option value=\"\">Select Province</option>";
        foreach($StateProv as $key=>$value) {
            $selected = ($key == $val)?'selected="selected"':'';
            $prov3.= "<option value=\"$key\" $selected>$value</option>";
        }
        $prov3.= "</select>";
     
        return $prov3;
    }
?>