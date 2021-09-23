<?php
class FAQS{
	var $FAQS_id = 0;
	var $question='';
	var $answer = '';
    var $category = '';
	function save(){
								$sqlarray = array(
                                "question"=>$this->question,
								"answer"=>$this->answer,
                                "category"=>$this->category,
									);
		if($this->FAQS_id>0){
			tep_db_perform(TABLE_FAQS,$sqlarray,'update',' FAQS_id="' . $this->FAQS_id . '"');
		}else{
			tep_db_perform(TABLE_FAQS,$sqlarray);
			$this->FAQS_id=tep_db_insert_id();
		}
	}
	function delete($id){
		$query = "delete from " . TABLE_FAQS . " where FAQS_id='" . $id . "';";
		tep_db_query($query);
	}
	function check_answer($unique_answer,$FAQS_id){
		$query	= "select * from " . TABLE_FAQS . " where unique_answer='$unique_answer' and FAQS_id='$FAQS_id'";
		$result	=	tep_db_query($query);
		if(tep_db_num_rows($result)>0)
		{
			return "exist";	
		}
		else
		return "not_found";
	}
	function get_answer($unique_name){
		$query	= "select * from " . TABLE_FAQS . " where unique_name='$unique_name'";
		$result	=	tep_db_query($query);
		if(tep_db_num_rows($result)>0)
		{
			$arr = tep_db_fetch_array($result);
			return $arr['answer'];
		}
		else
		return "empty";
	}
	function get_title($unique_name){
		$query	= "select * from " . TABLE_FAQS . " where unique_name='$unique_name'";
		$result	=	tep_db_query($query);
		if(tep_db_num_rows($result)>0)
		{
			$arr = tep_db_fetch_array($result);
			return $arr['question'];
		}
		else
		return "empty";
	}
	function load($id){
		$sql = "select * from " . TABLE_FAQS . " where FAQS_id=" . $id;
		$sqlresult = tep_db_query($sql);
		$sqlarray = tep_db_fetch_array($sqlresult);
		if($sqlarray){
			$this->FAQS_id 		= isset($sqlarray['FAQS_id'])?$sqlarray['FAQS_id']:0;
			$this->question 			= isset($sqlarray['question'])?$sqlarray['question']:'';
			$this->answer			= isset($sqlarray['answer'])?$sqlarray['answer']:'';
            $this->category			= isset($sqlarray['category'])?$sqlarray['category']:'';
		}
	}
	function getlist($category=""){
    if($category){
        $query = "select * from " . TABLE_FAQS." where category ='$category' order by FAQS_id ASC";
    }else{
		$query = "select * from " . TABLE_FAQS." order by FAQS_id ASC";
        }
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
		else { return "empty"; }
	}
    function getcategories(){
        		$query = "select distinct category from " . TABLE_FAQS." order by category ASC";
                      
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
		else { return "empty"; }
    }
/////////////////////////////////end of class definition////////////////	
}
?>