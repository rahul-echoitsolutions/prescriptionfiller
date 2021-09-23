<?php

class users {

    var $user_id = 0;
    var $password = '';
    var $email = '';
    var $login_name = '';
    var $rights = 'FULL';
    var $status = 'inactive';
    var $full_name = '';
    var $first_name = '';
    var $last_name = '';
    var $date_entered = '';
    var $table_name = TABLE_USERS;

    function save() {
        $sqlarray = array(
            "password" => $this->password,
            "login_name" => $this->login_name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "full_name" => $this->full_name,
            "email" => $this->email,
            "date_entered" => $this->date_entered,
            "status" => $this->status
        );
        if ($this->user_id > 0) {
            tep_db_perform($this->table_name, $sqlarray, 'update', ' user_id="' . $this->user_id . '"');
        } else {
            tep_db_perform($this->table_name, $sqlarray);
            $this->user_id = tep_db_insert_id();
        }
    }

    function delete($userid) {
        $query = "delete from {$this->table_name}  where user_id='$userid';";
        tep_db_query($query);
    }

    function load($userid) {
        $sql = "select * from {$this->table_name}  where user_id=$userid";
        $sqlresult = tep_db_query($sql);
        $sqlarray = tep_db_fetch_array($sqlresult);
        if ($sqlarray) {
            $this->user_id = isset($sqlarray['user_id']) ? $sqlarray['user_id'] : 0;
            $this->password = isset($sqlarray['password']) ? $sqlarray['password'] : '';
            $this->login_name = isset($sqlarray['login_name']) ? $sqlarray['login_name'] : '';
            $this->full_name = isset($sqlarray['full_name']) ? $sqlarray['full_name'] : '';
            $this->email = isset($sqlarray['email']) ? $sqlarray['email'] : '';
            $this->status = isset($sqlarray['status']) ? $sqlarray['status'] : 0;
            $this->first_name = isset($sqlarray['first_name']) ? $sqlarray['first_name'] : '';
            $this->last_name = isset($sqlarray['last_name']) ? $sqlarray['last_name'] : '';
            $this->date_entered = isset($sqlarray['date_entered']) ? $sqlarray['date_entered'] : '';
        }
    }

    function getlist() {
        $query = "select * from {$this->table_name}";
        $query_sql = tep_db_query($query);
        $rowscount = tep_db_num_rows($query_sql);

        $result = array();
        while ($query_result = tep_db_fetch_array($query_sql)) {
            array_push($result, $query_result);
        }
        return $result;
    }

    function getusername($userid) {
        $sql = "select login_name as username from {$this->table_name}  where user_id=$userid";
        $row = tep_db_result_row($sql);
        if ($row) {
            return $row[0];
        }
        return '';
    }

    function getUserID($email) {
        $sql = "select user_id from {$this->table_name}  where email='$email'";
        $row = tep_db_result_row($sql);
        if ($row) {
            return $row[0];
        }
        return '';
    }

    function emailexists($email, $userid) {
        $sql = "select count(*) as count from {$this->table_name}  where user_id<>$userid and email='$email'";
        $row = tep_db_result_row($sql);
        if ($row) {
            if ($row[0] > 0)
                return true;
        }
        return false;
    }

    function fbemailexists($email) {
        $sql = "select count(*) as count from {$this->table_name}  where email='$email'";
        $row = tep_db_result_row($sql);
        if ($row) {
            if ($row[0] > 0)
                return true;
        }
        return false;
    }

    function validate($login, &$error) {
        $sql = "select user_id from {$this->table_name}  where login_name='" . tep_db_input($login) . "'";
        #die();
        $row = tep_db_result_row($sql);
        if ($row) {
            if ($row[0] > 0) {
                $this->load($row[0]);
                return true;
            }
        }
        $error = "Invalid Login!";
        return false;
    }

    function validate_user() {
        $sql = "select user_id from {$this->table_name}  where login_name='" . tep_db_input($this->login_name) . "' and password='" . tep_db_input($this->password) . "'";
        #die();
        $row = tep_db_result_row($sql);
        if ($row) {
            if ($row[0] > 0) {
                $this->load($row[0]);
                if ($this->status == 'inactive')
                    return 'inactive';
                else {
                    return 'active';
                }
            }
        }
        return "invalid";
    }

    function require_logged_in($url) {
        $sess = &$_SESSION;



        if ($sess['login_name'] == '') {
            header("Location:" . $url);
            exit();
        }
    }

}

?>