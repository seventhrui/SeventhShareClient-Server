<?php
if (isset ( $_POST ["submit"] ) && $_POST ["submit"] == "Publish") {
	$title = $_POST ["title"];
	$content = $_POST ["content"];
	$customerid = $_POST ["customerid"];
	if ($title == "" || $content == "" || $customerid == "") {
		echo "<script>alert('��ȷ����Ϣ�����ԣ�'); history.go(-1);</script>";
	} else {
		require_once 'include/DB_Functions.php';
		$db = new DB_Functions ();
		$insert = $db->storeBlog($customerid, $title, $content);
		if ($insert) {
			echo "<script>alert('�����ɹ���'); history.go(-2);</script>";
		} else {
			echo "<script>alert('ϵͳ��æ�����Ժ�'); history.go(-1);</script>";
		}
	}
} else {
	echo "<script>alert('�ύδ�ɹ���'); history.go(-1);</script>";
}