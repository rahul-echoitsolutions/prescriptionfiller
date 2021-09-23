<?php
class medianRates{
        var $id                  = 0;
        var $rate_2              = 0;
        var $rate_3              = 0;
        var $rate_4              = 0;
        var $rate_5              = 0;
        var $rate_6              = 0;
        var $rate_7              = 0;
        var $rate_8              = 0;
        var $rate_institution    = '';
        var $rate_date           ='';
        var $table_name          = 'interest_rate';
        
       
    
      
    
    
    function getlist($sort_by='id', $sort_order='desc'){
    
            $sql		=	"select * from {$this->table_name} order by $sort_by $sort_order ";
            $query_sql	=	tep_db_query($sql);
            $result 	= 	array();
            while($query_result = tep_db_fetch_array($query_sql)){
                array_push($result, $query_result);
            }
            return $result;
            
    }
    
    
    
    /////////// ********** end of class ////////////////////
}
?>