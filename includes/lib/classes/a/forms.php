<?php
class forms{
        var $id			    =	0;
        var $name	        =	'';
        var $email		    =	'';
        var $phone		    =	'';
        var $comments		=	'';
        var $inventory_id	=	'';
        var $date			=	'';
        var $request_type	=	'';
        var $besttime		=	'';
        var $subject		=	'';
        var $offer		    =	'';
        var $friendname		= 	'';
        var $friendemail	= 	'';
        var $CASL           =   '';
        var $table_name		=	'forms';
    
    function save(){
            $sqlarray 			=	 array(
                                    "name"	        =>	$this->name,
                                    "email"		    =>	$this->email,
                                    "offer"		    =>	$this->offer,
                                    "friendname"	=>	$this->friendname,
                                    "friendemail"	=>	$this->friendemail,
                                    "phone"		    =>	$this->phone,
                                    "request_type"	=>	$this->request_type,
                                    "subject"		=>	$this->subject,
                                    "comments"		=>	$this->comments,
                                    "inventory_id"	=>	$this->inventory_id,
                                    "date"			=>	$this->date,
                                    "besttime"		=>	$this->besttime,
                                     "CASL"	    	=>	$this->CASL,
                                    );
                                    
                            
            $check_result = tep_db_fetch_array(tep_db_query("select count(*) as count from  {$this->table_name} where id='{$this->id}'"));
            if($check_result['count']>0) 	tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"');
            else 							tep_db_perform($this->table_name,$sqlarray);
            
    }
        
    function delete($id){
            tep_db_query("delete from {$this->table_name} where id=$id");
    }
    
    
    
    function getlist($request_type,$sort_by='id', $sort_order='desc'){
        
        if($request_type=="contactus"){$request_type="Contact Us -";}
    
            $sql		=	"select * from {$this->table_name} where request_type='$request_type' order by $sort_by $sort_order ";
            $query_sql	=	tep_db_query($sql);
            $result 	= 	array();
            while($query_result = tep_db_fetch_array($query_sql)){
                array_push($result, $query_result);
            }
            return $result;
            
    }
    
    
    
    function load($request_id){
        
        $sql 						= "select * from {$this->table_name} where id=$request_id";
        $sqlresult 					= tep_db_query($sql);
        $sqlarray 					= tep_db_fetch_array($sqlresult);
        
        if($sqlarray){
        
        $this->id 			= isset($sqlarray['id'])		        ?	$sqlarray['id']:0;
        $this->name 	    = isset($sqlarray['name'])	            ?	$sqlarray['name']:'';
        $this->email 		= isset($sqlarray['email'])		        ?	$sqlarray['email']:'';
        $this->phone 		= isset($sqlarray['phone'])		        ?	$sqlarray['phone']:'';
        $this->offer 		= isset($sqlarray['offer'])		        ?	$sqlarray['offer']:'';
        $this->friendname 	= isset($sqlarray['friendname'])		?	$sqlarray['friendname']:'';
        $this->friendemail 	= isset($sqlarray['friendemail'])		?	$sqlarray['friendemail']:'';
        $this->subject 		= isset($sqlarray['subject'])			?	$sqlarray['subject']:'';
        $this->comments 	= isset($sqlarray['comments'])			?	$sqlarray['comments']:'';
        $this->inventory_id = isset($sqlarray['inventory_id'])		?	$sqlarray['inventory_id']:'';
        $this->date 		= isset($sqlarray['date'])			    ?	$sqlarray['date']:'';
        $this->besttime 	= isset($sqlarray['besttime'])			?	$sqlarray['besttime']:'';
        $this->request_type = isset($sqlarray['request_type'])		?	$sqlarray['request_type']:'';
        $this->CASL         = isset($sqlarray['CASL'])	         	?	$sqlarray['CASL']:'';
        
        }
    }
        
    /////////// ********** end of class ////////////////////
}
?>