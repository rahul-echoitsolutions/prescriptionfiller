<?php
class blogwriters{
	var $writer_id		=	0;
	var $first_name		=	'';
	var $last_name		=	'';
	var $email			=	'';
	var $active_date	=	'';
	var $password		=	'';
	var $bio			=	'';
	var $image			=	'';
	var $table_name		=	TABLE_BLOGWRITERS;

	function save(){
		$sqlarray 		= 		array(
								"writer_id"		=>	$this->writer_id,
								"first_name"	=>	$this->first_name,
								"last_name"		=>	$this->last_name,
								"email"			=>	$this->email,
								"active_date"	=>	$this->active_date,
								"password"		=>	$this->password,
								"bio"			=>	$this->bio,
								"image"			=>	$this->image);
								
						
		//$check_result = tep_db_fetch_array(tep_db_query("select count(*) as count from  {$this->table_name} where email='{$this->email}' and password='{$this->password}'"));
		if($this->writer_id>0) 	tep_db_perform($this->table_name,$sqlarray,'update',' writer_id="' . $this->writer_id . '"');
		else 							tep_db_perform($this->table_name,$sqlarray);
		
	}
	
	function delete($writer_id){
		tep_db_query("delete from {$this->table_name} where writer_id=$writer_id");
	}



	function getlist($writer_id){
		$subquery 	=	($writer_id>0)?" where writer_id=$writer_id ":'';
		$sql		=	"select * from {$this->table_name} order by writer_id DESC ";
		$query_sql	=	tep_db_query($sql);
		$result 	= 	array();
		while($query_result=tep_db_fetch_array($query_sql)){
			array_push($result, $query_result);
		}
		return $result;
	}



		function load($userid){
		
			$sql 		= "select * from {$this->table_name} where writer_id=".$userid;
			$sqlresult 	= tep_db_query($sql);
			$sqlarray 	= tep_db_fetch_array($sqlresult);
			
			if($sqlarray){
			$this->writer_id 	= isset($sqlarray['writer_id'])		?	$sqlarray['writer_id']:0;
			$this->first_name 	= isset($sqlarray['first_name'])	?	$sqlarray['first_name']:'';
			$this->last_name 	= isset($sqlarray['last_name'])		?	$sqlarray['last_name']:'';
			$this->email 		= isset($sqlarray['email'])			?	$sqlarray['email']:'';
			$this->password 	= isset($sqlarray['password'])		?	$sqlarray['password']:'';
			$this->bio	 		= isset($sqlarray['bio'])			?	$sqlarray['bio']:'';
			$this->image 		= isset($sqlarray['image'])			?	$sqlarray['image']:'';
			$this->active_date 	= isset($sqlarray['active_date'])	?	$sqlarray['active_date']:'';
			}
		}
	
	
	function validate_writer(){
				$sql 		= "select * from {$this->table_name}  where email='" . tep_db_input($this->email) . "' and password='" . tep_db_input($this->password) . "'";
				$sqlresult 	= tep_db_query($sql);
				$rows 		= tep_db_num_rows($sqlresult);
				$sqlarray 	= tep_db_fetch_array($sqlresult);	
					if($sqlarray){
						
							if(date('Y-m-d H:i:s')<$sqlarray['active_date'])
							return 'inactive';
							else {
								$writer_id = $sqlarray['writer_id'];
								$this->load($writer_id);
								return 'active';
							}
					}
					else
					return "invalid";
	}
	
	function checkIfEmailExists($email) { 
				$sql 		= "select * from {$this->table_name}  where email='{$this->email}'";
				$sqlresult 	= tep_db_query($sql);
				$rows 		= tep_db_num_rows($sqlresult);
				if($rows>0){
					return "1";
				}
				else return "0";
	}



}
?>