<?php

class vehicles	{


		var  $id      						= 0;
        var  $make                          = '';
        var  $model                         = '';
        var  $class                         = '';
        var  $year                          = '';
        var  $table_name	                = "vehicles";
		


function save(){

				$sqlarray = array(

                        "id"=> $this->id,

                        "make"=> $this->make,

                        "model" => $this->model,	

                        "class" => $this->class,

                        "year" => $this->year,

                        
				);
				


		if($this->tenant_id>0)

			tep_db_perform($this->table_name,$sqlarray,'update',' id="' . $this->id . '"');

		else{

			tep_db_perform($this->table_name,$sqlarray);

			$this->id=tep_db_insert_id();

		}

}

	

function delete($id){
		$query = "update  {$this->table_name} set Archive_Flag = 1  where id='$id';";
		tep_db_query($query);
}

	

	

function load($id){

		

		$sql 			= 	"select * from {$this->table_name}  where id=" . $id;

		$sqlresult 		= 	tep_db_query($sql);

		$sqlarray 		= 	tep_db_fetch_array($sqlresult);

		

		if($sqlarray){
			$this->id 							=isset($sqlarray['id'])?  $sqlarray['id']:0;
            $this->make 							=isset($sqlarray['make'])?  $sqlarray['make']:0;
            $this->model              	=isset($sqlarray['model'])?  $sqlarray['model']:'';
            $this->class                	=isset($sqlarray['class'])?  $sqlarray['class']:'';
            $this->year                		=isset($sqlarray['year'])?  $sqlarray['year']:'';


		}
}




function getlistMake($yearStart="1984", $yearEnd=''){
    
    $yearEnd=($YearEnd>'')? $yearEnd : date("Y");

    
			
		
		
		
		$query 			= 		"select distinct make from {$this->table_name} where year>='$yearStart' AND year <='$yearEnd' ORDER BY make ASC ";
		


		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);

		

		if($num_rows>0)	{

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else {

		return "empty";

        }

}

function getlistModel($make="",$yearStart="1984", $yearEnd=''){
    
    $yearEnd=($YearEnd>'')? $YearEnd : date("Y");

    $make=str_replace("_"," ",$make);
			
		
		
		
		$query 			= 		"select distinct model from {$this->table_name} where LENGTH(model)<40 AND make = '$make'  ORDER BY  model ASC";
		


		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);

		

		if($num_rows>0)	{

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else {

		return "empty";

        }

}



function getlistClass($make="",$model="",$yearStart="1984", $yearEnd=''){
    
    $yearEnd=($YearEnd>'')? $YearEnd : date("Y");

    
			
		
		
		
		$query 			= 		"select distinct class from {$this->table_name} where year>='$yearStart' AND year <='$yearEnd' ORDER BY class ASC ";
		

        

		$query_sql		=		tep_db_query($query);
		$num_rows 		= 		tep_db_num_rows($query_sql);

		

		if($num_rows>0)	{

			

				$result = array();

				while($query_result=tep_db_fetch_array($query_sql)){

				array_push($result, $query_result);

				}

				return $result;

		}

		else {

		return "empty";

        }

}



function getTotalRecords(){



		$query 			=	"select count(*) as total from {$this->table_name}";

		$query_sql		=	tep_db_query($query);

		$num_rows 		=	tep_db_num_rows($query_sql);

		

		if($num_rows>0) {

				$query_result	=	tep_db_fetch_array($query_sql);

				return $query_result['total'];

		}

		else

		return "empty";



}




/////////////////////////////////end of class definition////////////////	

}

?>