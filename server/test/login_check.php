<?php
if (isset ( $_POST ["submit"] ) && $_POST ["submit"] == "Login") {
	$name = $_POST ["username"];
	$password = $_POST ["password"];
	if ($name == "" || $password == "") {
		echo "<script>alert('�������û��������룡'); history.go(-1);</script>";
	} else {
		
		require_once 'include/DB_Functions.php';
		$db = new DB_Functions();
		$user = $db->getUserByNameAndPassword($name, $password);
		if ($user) {
			//header ( "Location: message.php" );
			echo "<script>alert('��¼�ɹ���');history.go(-1);</script>";
			header("Location: blog.php");
		} else {
			echo "<script>alert('�û��������벻��ȷ��');history.go(-1);</script>";
		} 
	}
} else {
	echo "<script>alert('�ύδ�ɹ���'); history.go(-1);</script>";
}