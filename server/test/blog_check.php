<?php
if (isset ( $_POST ["submit"] ) && $_POST ["submit"] == "getblogs") {
	$id = $_POST ["customerid"];
	
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions ();
	$blog = $db->getBlogsByCustomerID($id);
	if ($blog) {
		// header ( "Location: message.php" );
		print_r($blog);
	} else {
		echo "<script>alert('空获取！');history.go(-1);</script>";
	}
} else {
	echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}