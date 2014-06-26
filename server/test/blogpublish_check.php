<?php
if (isset ( $_POST ["submit"] ) && $_POST ["submit"] == "Publish") {
	$title = $_POST ["title"];
	$content = $_POST ["content"];
	$customerid = $_POST ["customerid"];
	if ($title == "" || $content == "" || $customerid == "") {
		echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
	} else {
		require_once 'include/DB_Functions.php';
		$db = new DB_Functions ();
		$insert = $db->storeBlog($customerid, $title, $content);
		if ($insert) {
			echo "<script>alert('发布成功！'); history.go(-2);</script>";
		} else {
			echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
		}
	}
} else {
	echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}