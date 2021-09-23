<?php

class members {

    var $id = '';
    var $name = '';
    var $first_name = '';
    var $last_name = '';
    var $date_of_birth = '';
    var $sex = '';
    var $phone_number = '';
    var $email = '';
    var $address = '';
    var $city = '';
    var $province = '';
    var $postal_code = '';
    var $password = '';
    var $medical_insurance_provider = '';
    var $carrier_number = '';
    var $plan_number = '';
    var $member_id = '';
    var $issue_number = '';
    var $personal_health_number = '';
    var $shots = '';
    var $drugs = '';
    var $vaccinations = '';
    var $user_type = '';
    var $date_registered = '';
    var $remember_token = '';
    var $created_at = '';
    var $updated_at = '';
    var $allergies = '';
    var $activated = '';
    var $table_name = 'users';

    function save() {



        $sqlarray = array(
            "id" => $this->id,
            "name" => $this->name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "date_of_birth" => $this->date_of_birth,
            "sex" => $this->sex,
            "phone_number" => $this->phone_number,
            "email" => $this->email,
            "address" => $this->address,
            "city" => $this->city,
            "province" => $this->province,
            "postal_code" => $this->postal_code,
            "password" => $this->password,
            "medical_insurance_provider" => $this->medical_insurance_provider,
            "carrier_number" => $this->carrier_number,
            "plan_number" => $this->plan_number,
            "member_id" => $this->member_id,
            "issue_number" => $this->issue_number,
            "personal_health_number" => $this->personal_health_number,
            "shots" => $this->shots,
            "drugs" => $this->drugs,
            "vaccinations" => $this->vaccinations,
            "user_type" => $this->user_type,
            "date_registered" => $this->date_registered,
            "remember_token" => $this->remember_token,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "allergies" => $this->allergies,
            "activated" => $this->activated,
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
            $this->name = isset($sqlarray['name']) ? $sqlarray['name'] : '';
            $this->first_name = isset($sqlarray['first_name']) ? $sqlarray['first_name'] : '';
            $this->last_name = isset($sqlarray['last_name']) ? $sqlarray['last_name'] : '';
            $this->date_of_birth = isset($sqlarray['date_of_birth']) ? $sqlarray['date_of_birth'] : '';
            $this->sex = isset($sqlarray['sex']) ? $sqlarray['sex'] : '';
            $this->phone_number = isset($sqlarray['phone_number']) ? $sqlarray['phone_number'] : '';
            $this->email = isset($sqlarray['email']) ? $sqlarray['email'] : '';
            $this->address = isset($sqlarray['address']) ? $sqlarray['address'] : '';
            $this->city = isset($sqlarray['city']) ? $sqlarray['city'] : '';
            $this->province = isset($sqlarray['province']) ? $sqlarray['province'] : '';
            $this->postal_code = isset($sqlarray['postal_code']) ? $sqlarray['postal_code'] : '';
            $this->password = isset($sqlarray['password']) ? $sqlarray['password'] : '';
            $this->medical_insurance_provider = isset($sqlarray['medical_insurance_provider']) ? $sqlarray['medical_insurance_provider'] : '';
            $this->carrier_number = isset($sqlarray['carrier_number']) ? $sqlarray['carrier_number'] : '';
            $this->plan_number = isset($sqlarray['plan_number']) ? $sqlarray['plan_number'] : '';
            $this->member_id = isset($sqlarray['member_id']) ? $sqlarray['member_id'] : '';
            $this->issue_number = isset($sqlarray['issue_number']) ? $sqlarray['issue_number'] : '';
            $this->personal_health_number = isset($sqlarray['personal_health_number']) ? $sqlarray['personal_health_number'] : '';
            $this->shots = isset($sqlarray['shots']) ? $sqlarray['shots'] : '';
            $this->drugs = isset($sqlarray['drugs']) ? $sqlarray['drugs'] : '';
            $this->vaccinations = isset($sqlarray['vaccinations']) ? $sqlarray['vaccinations'] : '';
            $this->user_type = isset($sqlarray['user_type']) ? $sqlarray['user_type'] : '';
            $this->date_registered = isset($sqlarray['date_registered']) ? $sqlarray['date_registered'] : '';
            $this->remember_token = isset($sqlarray['remember_token']) ? $sqlarray['remember_token'] : '';
            $this->created_at = isset($sqlarray['created_at']) ? $sqlarray['created_at'] : '';
            $this->updated_at = isset($sqlarray['updated_at']) ? $sqlarray['updated_at'] : '';
            $this->allergies = isset($sqlarray['allergies']) ? $sqlarray['allergies'] : '';
            $this->activated = isset($sqlarray['activated']) ? $sqlarray['activated'] : '';
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

    function verifyLogin($email, $password) {
        $sql = "select * from {$this->table_name}  where email='$email' ";
        $sqlresult = tep_db_query($sql);
        $query_result = tep_db_fetch_array($sqlresult);

        $pwd = $query_result['password'];
        $verified = password_verify($password, $pwd);

        if ($verified) {
            return $query_result['id'];
        }
    }

    function emailExists($email) {
        $sql = "select id from {$this->table_name}  where email='$email' ";
        $sqlresult = tep_db_query($sql);
        $query_result = tep_db_fetch_array($sqlresult);
        if ($query_result['id'] > 0)
            return '1';
        else
            return 0;
    }

    function checkLogin($member_id) {

        if ($member_id < 1) {
            echo "<script>      
                window.location.href = '" . HTTP_HOME_URL . "';
               
    </script>";
            die();
        }
    }

    function checkIfEmailExists($email) {
        $sql = "select * from {$this->table_name}  where email='{$email}'";


        $sqlresult = tep_db_query($sql);
        $rows = tep_db_num_rows($sqlresult);
        if ($rows > 0) {
            return "1";
        } else
            return "0";
    }

    function getUserID($email) {
        $sql = "select id from {$this->table_name}  where email='$email'";
        $row = tep_db_result_row($sql);
        if ($row) {
            return $row[0];
        }
        return '';
    }

    function savePassword($member_id, $password) {

        $pwd = password_hash($password);

        $sql = "update {$this->table_name} set password ='$pwd') where id='$member_id' ";
        tep_db_query($sql);
        $rows = tep_db_num_rows($sql);
        if ($rows > 0) {
            return true;
        } else
            return false;
    }

############### END OF CLASS DEFINITION #######################################
}

?>