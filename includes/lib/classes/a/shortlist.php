<?php
class shortlist{
            var $shortlist_id       = '';
            var $member_id          = 0;
            var $vehicle_id         = 0;
			var $dealer_id			= 0;
			var $quote_id			= 0;
            var $date               = '';
            var $table_name 		= 'shortlist';
	
	
   function save(){
				$sqlarray = array(
                        "shortlist_id"      => $this->shortlist_id,
                        "member_id"         => $this->member_id,
						"quote_id"			=> $this->quote_id,
                        "vehicle_id"        => $this->vehicle_id,
						"dealer_id"			=> $this->dealer_id,
                        "date"              => $this->date);
            if($this->id>0){
                tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"');
		          }else{
				tep_db_perform($this->table_name,$sqlarray); 
				$this->id=tep_db_insert_id();
				}
            	}           
    	function load($id){
            	$sql 		= "select * from {$this->table_name} where shortlist_id='$id'";
				$sql 		= tep_db_query($sql);
				$sqlarray 	= tep_db_fetch_array($sql);
			  if($sqlarray){
                    $this->shortlist_id = isset($sqlarray['shortlist_id']) ?$sqlarray['shortlist_id']:'';
                    $this->member_id = isset($sqlarray['member_id']) ?$sqlarray['member_id']:0;
                    $this->vehicle_id = isset($sqlarray['vehicle_id']) ?$sqlarray['vehicle_id']:0;
                    $this->date = isset($sqlarray['date']) ?$sqlarray['date']:'';
				   	$this->dealer_id = isset($sqlarray['dealer_id']) ?$sqlarray['dealer_id']:0;
				  	$this->quote_id = isset($sqlarray['quote_id']) ?$sqlarray['quote_id']:0;
     	       }
	}
     function getlist(){
		$query 			= 		"select * from {$this->table_name}  order by id DESC";
		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);
		if($num_rows>0)	{
				$result = array();
				while($query_result=tep_db_fetch_array($query_sql)){
				array_push($result, $query_result);
				}
				return $result;
		}
		else 
		return "empty";
}
     function isInShortlist($member_id, $quote_id){
     	$query 			= 		"select * from {$this->table_name}  where member_id = '$member_id' 
								And quote_id = '$quote_id' limit 1"; 
		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);
		if($num_rows>0)	{
				return 'yes';
		}
		else 
		return "no";
     }
	
	function delete($id){
     	$query 			= 		"delete from {$this->table_name}  where id = '$id'";
		$query_sql		=		tep_db_query($query);
     }
	
	
	function getIDFromMemberIDAndVehicleID($member_id, $vehicle_id){
     	$query 			= 		"select id from {$this->table_name}  where member_id = '$member_id' 
								And vehicle_id = '$vehicle_id' limit 0,1";
		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);
		if($num_rows>0)	{
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['id'];
		}
		else    return "empty";
	}
	
	
	function getIDFromMemberIDAndQuoteID($member_id, $quote_id){
     	$query 			= 		"select id from {$this->table_name}  where member_id = '$member_id' 
								And quote_id = '$quote_id' limit 0,1";
		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);
		if($num_rows>0)	{
				$query_result=tep_db_fetch_array($query_sql);
				return $query_result['id'];
		}
		else    return "empty";
	}
    function isPaid($member_id, $dealer_id,$vehicle_id){
     	$query 			= 		"select * from {$this->table_name}  where member_id = '$member_id' 
								And dealer_id = '$dealer_id' and vehicle_id = '$vehicle_id' limit 0,1";
		

        
        $query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);
		if($num_rows>0)	{
				return true;
		}
		else    return false;
	}
	### END OF CLASS DEFINITION ###
}