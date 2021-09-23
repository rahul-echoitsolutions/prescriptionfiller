<?php
class rates{
        var $id             = 0;
        var $Variable       = 0;
        var $six_Months     = 0;
        var $one_Year       = 0;
        var $two_Years      = 0;
        var $three_Years    = 0;
        var $four_Years     = 0;
        var $five_Years     = 0;
        var $go_rate_date   = '';
        var $table_name		= 'interest_rates_go';
        
       
    
    function save(){
            $sqlarray 			=	 array(
                                    "Variable"      => $this->Variable,
                                    "six_Months"    => $this->six_Months,
                                    "one_Year"      => $this->one_Year,
                                    "two_Years"     => $this->two_Years,
                                    "three_Years"   => $this->three_Years,
                                    "four_Years"    => $this->four_Years,
                                    "five_Years"    => $this->five_Years,
                                    "go_rate_date"  => $this->go_rate_date,
                                    );
                                    
                            
            $check_result = tep_db_fetch_array(tep_db_query("select count(*) as count from  {$this->table_name} where id='{$this->id}'"));
            if($check_result['count']>0) 	tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"');
            else 							tep_db_perform($this->table_name,$sqlarray);
            
    }
        
    function delete($id){
            tep_db_query("delete from {$this->table_name} where id=$id");
    }
    
    
    
    function getlist($sort_by='id', $sort_order='desc'){

// if the interest rate is more than one day old, check it. If it is, dump it into the table.
$sql		=	"select max(go_rate_date) from {$this->table_name}";
$query_sql	=	tep_db_query($sql);
$test_date  =   tep_db_fetch_array($query_sql);

$max_date   =   $test_date[0];

if($max_date<date("Y-m-d")){
    
    // Load the data scraping tool
         include("/home/carleado/public_html/includes/simple_html_dom.php");
    
    // The source of the data to scrape
        $fileNM="http://mortgagealliance.com/eduardapita/mortgage-rates";
        
        // load the source into a variable        
        $html = file_get_html($fileNM)or die(mail("Webmaster<".$webmaster_email.">","Site Error", " File: " . __FILE__ . " on line: " . __LINE__." fileNM is $fileNM and Chain is $chain and user is $emp and db is $db ".mysql_error()." ", "From: Server <".$webmaster_email.">"). " File: " . __FILE__ . " on line: " . __LINE__." and file is $fileNM and flagProg is $flagProg Chain is $chain and user is $emp and db is $db ".mysql_error());
         
         
   // can scrape multiiple instances, for example tds in a table. Not needed here, so it only goes through once.         
   for($i=1;$i<=1;$i++){             
            
            unset($imCt);
            
foreach($html->find('h3') as $element){ 
    $imCt++;
        if($imCt/$i==intval($imCt/$i)){
            //NOTE: strip_tags is important to clean array so it can be sorted
            $rate_i="rate_".$i;
            
            ${$rate_i}[]=strip_tags($element);
            
            
        }
    }
    }
    
    // build the array to insert the data
     $sqlarray2 			=	 array(
                                    "Variable"      => $rate_1[29],
                                    "six_Months"    => 0,
                                    "one_Year"      => $rate_1[9],
                                    "two_Years"     => $rate_1[12],
                                    "three_Years"   => $rate_1[15],
                                    "four_Years"    => $rate_1[18],
                                    "five_Years"    => $rate_1[21],
                                    "go_rate_date"  => date("Y-m-d"),
                                    );
    
    // insert the data into the table.
    tep_db_perform($this->table_name,$sqlarray2);
    

    
    
}


// pull latest rates from the table.
    
            $sql		=	"select * from {$this->table_name} order by $sort_by $sort_order ";
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
            
            $this->id           =isset($sqlarray['id'])         ?    $sqlarray['id']            : 0;
            $this->Variable     =isset($sqlarray['Variable'])   ?    $sqlarray['Variable']      : 0;
            $this->six_Months   =isset($sqlarray['six_Months']) ?    $sqlarray['six_Months']    : 0;
            $this->one_Year     =isset($sqlarray['one_Year'])   ?    $sqlarray['one_Year']      : 0;
            $this->two_Years    =isset($sqlarray['two_Years'])  ?    $sqlarray['two_Years']     : 0;
            $this->three_Years  =isset($sqlarray['three_Years'])?    $sqlarray['three_Years']   : 0;
            $this->four_Years   =isset($sqlarray['four_Years']) ?    $sqlarray['four_Years']    : 0;
            $this->five_Years   =isset($sqlarray['five_Years']) ?    $sqlarray['five_Years']    : 0;
            $this->go_rate_date =isset($sqlarray['go_rate_date'])?   $sqlarray['go_rate_date']  : 0;
        }
    }
        
    /////////// ********** end of class ////////////////////
}
?>