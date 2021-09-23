<?php
class points {
        var $points_id              = '';
        var $dealer_id              = '';
        var $points                 = '';
        var $points_description     = '';
        var $points_date            = '';
        var $table_name 		    = 'dealer_points';
    function save(){
		$sqlarray = array(
            "points_id"                     => $this->points_id,
            "dealer_id"                     => $this->dealer_id,
            "points"                        => $this->points,
            "points_description"            => $this->points_description,
            "points_date"                   => $this->points_date,
		);
		if($this->points_id>0) { 
			tep_db_perform($this->table_name,$sqlarray,'update',' points_id="' . $this->points_id . '"'); 
		}
		else {
			tep_db_perform($this->table_name,$sqlarray);
			$this->points_id = tep_db_insert_id();
		}
	}
	function delete($points_id){
		$query = "delete from {$this->table_name}  where points_id='$points_id';";
		tep_db_query($query);
	}
	function load($points_id){
		$sql 			= "select * from {$this->table_name}  where points_id='$points_id'";
		$sqlresult 		= tep_db_query($sql);
		$sqlarray 		= tep_db_fetch_array($sqlresult);
		if($sqlarray){
                $this->points_id            = isset($sqlarray['points_id']) ?$sqlarray['points_id']:'';
                $this->dealer_id            = isset($sqlarray['dealer_id']) ?$sqlarray['dealer_id']:'';
                $this->points               = isset($sqlarray['points']) ?$sqlarray['points']:'';
                $this->points_description   = isset($sqlarray['points_description']) ?$sqlarray['points_description']:'';
                $this->points_date          = isset($sqlarray['points_date']) ?$sqlarray['points_date']:'';
		}
	}
	function getlist(){
		$query 		=	"select * from {$this->table_name}  order by points_id desc";
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
    	function getlistDealer($dealer_id){
		$query 		=	"select * from {$this->table_name}  where dealer_id = '$dealer_id' order by points_date desc";
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
    	function gettotal($dealer_id){
		$query 		=	"select sum(points) from {$this->table_name}  ";
		$query_sql	=	tep_db_query($query);
		$rowscount	=	tep_db_num_rows($query_sql);
		$result = array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}
    function getGrandTotal($dealer_id,$points_for_quote){
        $sql 			= 	"select member_id, dealer_id, vehicle_id from dealer_quotes where 
		 					dealer_id = '$dealer_id' group by member_id, dealer_id, vehicle_id";
		$sqlresult 		= 	tep_db_query($sql);
		$num_rows 		=	tep_db_num_rows($sqlresult);
        $quotePoints	=	$num_rows*$points_for_quote;
		$query 			=	"select sum(points) from {$this->table_name} where dealer_id = '$dealer_id'";
		$query_sql		=	tep_db_query($query);
		$rowscount		=	tep_db_num_rows($query_sql);
		$query_result	=	tep_db_fetch_array($query_sql);
    	return ($query_result[0]); // + $quotePoints
    }
	function getDealerFreePoints($dealer_id) {
		$query 			=	"select sum(points) from {$this->table_name} 
							where dealer_id = '$dealer_id'";
		$query_sql		=	tep_db_query($query);
		$rowscount		=	tep_db_num_rows($query_sql);
		$query_result	=	tep_db_fetch_array($query_sql);
    	return ($query_result[0]);
	}
    
    function quoteCoinCount($dealer_id){
        $query 			=	"select sum(points) from {$this->table_name} where dealer_id = '$dealer_id' AND points_description='New Quote Reward'";
	//echo "Got to line ".__LINE__." in ".__FILE__." query is $query<br /><br />";
    
    	$query_sql		=	tep_db_query($query);
		$rowscount		=	tep_db_num_rows($query_sql);
		$query_result	=	tep_db_fetch_array($query_sql);
        return $rowscount;
    	//return ($query_result[0]);
	}
    
	######################### EOCD #########################################################
}