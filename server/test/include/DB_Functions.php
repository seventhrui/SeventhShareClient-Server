<?php
class DB_Functions {
	private $db;
	function __construct() {
		require_once 'DB_Connect.php';
		// connecting to database
		$this->db = new DB_Connect ();
		$this->db->connect ();
	}
	function __destruct() {
	}
	
	/**
	 * 存储新客户
	 * 
	 * @param unknown $name        	
	 * @param unknown $password        	
	 * @param unknown $phone        	
	 * @param unknown $email        	
	 * @param unknown $qq        	
	 * @return multitype: boolean
	 */
	public function storeUser($name, $password, $email, $phone, $qq) {
		$uuid = uniqid ( '', true );
		$hash = $this->hashSSHA ( $password );
		$encrypted_password = $hash ["encrypted"]; // encrypted password
		$salt = $hash ["salt"]; // salt
		$uptime = date ( 'Y-m-d H:i:s' );
		$result = mysql_query ( "INSERT INTO customer( name, pass, email, phone, qq, salt) VALUES( '$name', '$encrypted_password', '$email', '$phone', '$qq', '$salt')" );
		
		if ($result) {
			$uid = mysql_insert_id ();
			$result = mysql_query ( "SELECT * FROM customer WHERE id = $uid" );
			return mysql_fetch_array ( $result );
		} else {
			return false;
		}
	}
	
	/**
	 * 通过用户名和密码查询用户<br/>
	 * 登陆成功后设置状态码为2(登录)
	 */
	public function getUserByNameAndPassword($name, $password) {
		$result = mysql_query ( "SELECT * FROM customer WHERE name = '$name'" ) or die ( mysql_error () );
		$no_of_rows = mysql_num_rows ( $result );
		
		if ($no_of_rows > 0) {
			$result = mysql_fetch_array ( $result );
			$salt = $result ['salt'];
			$id = $result ['id'];
			$encrypted_password = $result ['pass'];
			$hash = $this->checkhashSSHA ( $salt, $password );
			if ($encrypted_password == $hash) {
				// state 默认值 1 表示正常和下线，2上线，0异常
				mysql_query ( "UPDATE customer SET state=2 WHERE id= '$id'" );
				return $result;
			}
		} else {
			return false;
		}
	}
	/**
	 * 修改customer state
	 * 0 异常
	 * 1 正常/下线
	 * 2 上线
	 * 
	 * @param unknown $id        	
	 * @param unknown $state        	
	 * @return boolean
	 */
	public function updateCustomerStateByCustomerID($id, $state) {
		mysql_query ( "UPDATE customer SET state=$state WHERE id= '$id'" );
		return false;
	}
	/**
	 * 查询用户是否存在
	 */
	public function isUserExisted($name) {
		$result = mysql_query ( "SELECT email from customer WHERE name = '$name'" );
		$no_of_rows = mysql_num_rows ( $result );
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
		$salt = sha1 ( rand () );
		$salt = substr ( $salt, 0, 10 );
		$encrypted = base64_encode ( sha1 ( $password . $salt, true ) . $salt );
		$hash = array (
				"salt" => $salt,
				"encrypted" => $encrypted 
		);
		return $hash;
	}
	public function checkhashSSHA($salt, $password) {
		$hash = base64_encode ( sha1 ( $password . $salt, true ) . $salt );
		return $hash;
	}
	
	/**
	 * 保存Blog
	 * @param unknown $customerid
	 * @param unknown $title
	 * @param unknown $content
	 * @return multitype:|boolean
	 */
	public function storeBlog($customerid, $title, $content) {
		$uptime = date ( 'Y-m-d H:i:s' );
		$result = mysql_query ( "INSERT INTO blog( customerid, title, content, uptime) VALUES( '$customerid', '$title', '$content', '$uptime')" );
		
		if ($result) {
			$cid = mysql_insert_id ();
			$result = mysql_query ( "SELECT * FROM blog WHERE id = $cid" );
			return mysql_fetch_array ( $result );
		} else {
			return false;
		}
	}
	
	/**
	 * 通过customer id 获取  Blog
	 * @param unknown $customerid
	 * @return Ambigous <resource, multitype:>|boolean
	 */
	public function getBlogsByCustomerID($customerid){
		$result = mysql_query("SELECT * FROM blog WHERE customerid='$customerid'");
		$no_of_rows = mysql_num_rows ( $result );
		//$r="";
		if ($no_of_rows > 0) {
			//$result = mysql_fetch_array ( $result );
			//$result = mysql_result($result,0);
			/* while ($b=mysql_fetch_array($result)){
				$r.=$b['title']."-";
			} 
			return $r;*/
			return $result;
		} else {
			return false;
		}
	}
}

?>
