<?php

class DB_Functions {

    private $db;

    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    function __destruct() {
        
    }

    /**
     * 存储新客户
     * @param unknown $name
     * @param unknown $password
     * @param unknown $phone
     * @param unknown $email
     * @param unknown $qq
     * @return multitype:|boolean
     */
    public function storeUser($name, $password, $phone, $email, $qq) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $uptime = date('Y-m-d H:i:s');
        $result = mysql_query("INSERT INTO customer( name, pass, phone, email, qq, salt) VALUES( '$name', '$encrypted_password', '$phone', '$email', '$qq', '$salt')");
        
        if ($result) {
            $uid = mysql_insert_id();
            $result = mysql_query("SELECT * FROM customer WHERE id = $uid");
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }

    /**
     * 通过用户名和密码查询用户
     */
    public function getUserByNameAndPassword($name, $password) {
        $result = mysql_query("SELECT * FROM customer WHERE name = '$name'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
        
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['pass'];
            $hash = $this->checkhashSSHA($salt, $password);
            if ($encrypted_password == $hash) {
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * 查询用户是否存在
     */
    public function isUserExisted($name) {
        $result = mysql_query("SELECT email from customer WHERE name = '$name'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 密码加密
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }


    public function checkhashSSHA($salt, $password) {
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        return $hash;
    }

}

?>
