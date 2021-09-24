<?php

class prescriptions {

    var $id = '';
    var $user_id = '';
    var $physician_id = '';
    var $pharmacy_id = '';
    var $description = '';
    var $extended_health = '';
    var $date_processed = '';
    var $image = '';
    var $status = '';
    var $time_received = '';
    var $time_processed = '';
    var $time_shipped = '';
    var $urgency = '';
    var $delivery_status = '';
    var $review_status = '';
    var $review_reason = '';
    var $image_path = '';
    var $fax_id = '';
    var $fax_status = '';
    var $updated_at = '';
    var $created_at = '';
    var $medical_notes = '';
    var $tax_status = '';
    var $image_binary = '';
    var $table_name = 'prescription';

    function save() {
        $sqlarray = array(
            "id" => $this->id,
            "user_id" => $this->user_id,
            "physician_id" => $this->physician_id,
            "pharmacy_id" => $this->pharmacy_id,
            "description" => $this->description,
            "extended_health" => $this->extended_health,
            "date_processed" => $this->date_processed,
            "image" => $this->image,
            "status" => $this->status,
            "time_received" => $this->time_received,
            "time_processed" => $this->time_processed,
            "time_shipped" => $this->time_shipped,
            "urgency" => $this->urgency,
            "delivery_status" => $this->delivery_status,
            "review_status" => $this->review_status,
            "review_reason" => $this->review_reason,
            "image_path" => $this->image_path,
            "fax_id" => $this->fax_id,
            "fax_status" => $this->fax_status,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
            "medical_notes" => $this->medical_notes,
            "tax_status" => $this->tax_status,
            "image_binary" => $this->image_binary,
        );
        if ($this->id > 0)
            tep_db_perform($this->table_name, $sqlarray, 'update', ' id="' . $this->id . '"');
        else {
            tep_db_perform($this->table_name, $sqlarray);
            $this->id = tep_db_insert_id();
        }
    }

    function delete($id) {
        $query = "delete from {$this->table_name}  where id='$id';";
        tep_db_query($query);
    }

    function load($id) {
        $sql = "select * from {$this->table_name}  where id='$id'";


        $sqlresult = tep_db_query($sql);
        $sqlarray = tep_db_fetch_array($sqlresult);
        if ($sqlarray) {
            $this->id = isset($sqlarray['id']) ? $sqlarray['id'] : '';
            $this->user_id = isset($sqlarray['user_id']) ? $sqlarray['user_id'] : '';
            $this->physician_id = isset($sqlarray['physician_id']) ? $sqlarray['physician_id'] : '';
            $this->pharmacy_id = isset($sqlarray['pharmacy_id']) ? $sqlarray['pharmacy_id'] : '';
            $this->description = isset($sqlarray['description']) ? $sqlarray['description'] : '';
            $this->extended_health = isset($sqlarray['extended_health']) ? $sqlarray['extended_health'] : '';
            $this->date_processed = isset($sqlarray['date_processed']) ? $sqlarray['date_processed'] : '';
            $this->image = isset($sqlarray['image']) ? $sqlarray['image'] : '';
            $this->status = isset($sqlarray['status']) ? $sqlarray['status'] : '';
            $this->time_received = isset($sqlarray['time_received']) ? $sqlarray['time_received'] : '';
            $this->time_processed = isset($sqlarray['time_processed']) ? $sqlarray['time_processed'] : '';
            $this->time_shipped = isset($sqlarray['time_shipped']) ? $sqlarray['time_shipped'] : '';
            $this->urgency = isset($sqlarray['urgency']) ? $sqlarray['urgency'] : '';
            $this->delivery_status = isset($sqlarray['delivery_status']) ? $sqlarray['delivery_status'] : '';
            $this->review_status = isset($sqlarray['review_status']) ? $sqlarray['review_status'] : '';
            $this->review_reason = isset($sqlarray['review_reason']) ? $sqlarray['review_reason'] : '';
            $this->image_path = isset($sqlarray['image_path']) ? $sqlarray['image_path'] : '';
            $this->fax_id = isset($sqlarray['fax_id']) ? $sqlarray['fax_id'] : '';
            $this->fax_status = isset($sqlarray['fax_status']) ? $sqlarray['fax_status'] : '';
            $this->udated_at = isset($sqlarray['updated_at']) ? $sqlarray['updated_at'] : '';
            $this->created_at = isset($sqlarray['created_at']) ? $sqlarray['created_at'] : '';
            $this->medical_notes = isset($sqlarray['medical_notes']) ? $sqlarray['medical_notes'] : '';
            $this->tax_status = isset($sqlarray['tax_status']) ? $sqlarray['tax_status'] : '';
            $this->image_binary = isset($sqlarray['image_binary']) ? $sqlarray['image_binary'] : '';
        }
    }

    function getlist($options = '') {
        $page = (!empty($options['page'])) ? $options['page'] : '1';
        $rows = (!empty($options['rows_per_page'])) ? $options['rows_per_page'] : '10';
        $order_by = (!empty($options['order_by'])) ? $options['order_by'] : 'id';
        $sort_direction = (!empty($options['sort_direction'])) ? $options['sort_direction'] : 'desc';
        $end = $rows * ($page - 1);
        $limit = " limit $end,$rows";
        $query = " select * from {$this->table_name} order by $order_by $sort_direction";
        $query_sql = tep_db_query($query);
        $num_rows = tep_db_num_rows($query_sql);
        if ($num_rows > 0) {
            $result = array();
            while ($query_result = tep_db_fetch_array($query_sql)) {
                array_push($result, $query_result);
            }
            return $result;
        } else
            return "empty";
    }

    function getlistMember($options = '', $member_id) {
        $page = (!empty($options['page'])) ? $options['page'] : '1';
        $rows = (!empty($options['rows_per_page'])) ? $options['rows_per_page'] : '10';
        $order_by = (!empty($options['order_by'])) ? $options['order_by'] : 'id';
        $sort_direction = (!empty($options['sort_direction'])) ? $options['sort_direction'] : 'desc';
        $end = $rows * ($page - 1);
        $limit = " limit $end,$rows";
        $query = " select * from {$this->table_name} where user_id = '$member_id' order by $order_by $sort_direction";
        $query_sql = tep_db_query($query);
        $num_rows = tep_db_num_rows($query_sql);
        if ($num_rows > 0) {
            $result = array();
            while ($query_result = tep_db_fetch_array($query_sql)) {
                array_push($result, $query_result);
            }
            return $result;
        } else
            return "empty";
    }

    function getPhysician($id) {
        $query = "select * from physicians where id='$id'";

        $query_sql = tep_db_query($query);
        $num_rows = tep_db_num_rows($query_sql);
        if ($num_rows > 0) {
            $result = array();
            while ($query_result = tep_db_fetch_array($query_sql)) {
                array_push($result, $query_result);
            }
            $name = $result[0]['first_name'] . " " . $result[0]['last_name'];

            return $name;
        } else
            return "empty";
    }

    function getPharmacy($id) {
        $query = "select * from pharmacy where id='$id'";

        $query_sql = tep_db_query($query);
        $num_rows = tep_db_num_rows($query_sql);
        if ($num_rows > 0) {
            $result = array();
            while ($query_result = tep_db_fetch_array($query_sql)) {
                array_push($result, $query_result);
            }
            $name = $result[0]['name'];

            return $name;
        } else
            return "empty";
    }

    function getDoctorsList($id) {
        $query = "select distinct physician_id from {$this->table_name} where user_id='$id'  ";
        $query_sql = tep_db_query($query);

        while ($query_result = tep_db_fetch_assoc($query_sql)) {
            $result = array();
            array_push($result, $query_result);
            $doctorList .= $result[0]['physician_id'] . ",";
        }
        $doctorList = trim($doctorList, ",");
        return $doctorList;
    }

    function getImageFromID($id) {
        $query = "select image_binary from {$this->table_name} where id='$id'";

        $query_sql = tep_db_query($query);
        $num_rows = tep_db_num_rows($query_sql);
        if ($num_rows > 0) {
            $result = array();
            while ($query_result = tep_db_fetch_array($query_sql)) {
                array_push($result, $query_result);
            }
            $image = $result[0]['image_binary'];

            return $image;
        } else
            return "empty";
    }
    
    function getPrescriptionByPharmacy($pharmacy_id){
        
        $result = array();
        
        $sql = "SELECT * FROM {$this->table_name}  WHERE user_id =" . $_SESSION['user_id'] . " AND pharmacy_id = " . $pharmacy_id;

        $sqlresult = tep_db_query($sql);
        
         while ($query_result = tep_db_fetch_assoc($sqlresult)) {
            array_push($result, $query_result);
        }
        
        return $result;
    }
    
    function getPrescriptionByPhysician($physician_id){
        
        $result = array();
        
        $sql = "SELECT * FROM {$this->table_name}  WHERE user_id =" . $_SESSION['user_id'] . " AND physician_id = " . $physician_id;

        $sqlresult = tep_db_query($sql);
        
         while ($query_result = tep_db_fetch_assoc($sqlresult)) {
            array_push($result, $query_result);
        }
       
        return $result;         
    }

############### END OF CLASS DEFINITION #######################################
}

?>