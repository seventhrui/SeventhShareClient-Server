<?php
if (isset ( $_POST ["submit"] ) && $_POST ["submit"] == "Register") {
	$name = $_POST ["username"];
	$password = $_POST ["password"];
	$psw_confirm = $_POST ["confirm"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$qq = $_POST["qq"];
	if ($email == "" || $password == "" || $psw_confirm == "") {
		echo "<script>alert('��ȷ����Ϣ�����ԣ�'); history.go(-1);</script>";
	} else {
		if ($password == $psw_confirm) {
			
			require_once 'include/DB_Functions.php';
			$db = new DB_Functions();
			$result = $db->isUserExisted($name);
			if ($result) 			// ����Ѿ����ڸ��û�
			{
				echo "<script>alert('�û����Ѵ���'); history.go(-1);</script>";
			} else 			// �����ڵ�ǰע���û�����
			{
				$insert = $db->storeUser($name,$password,$phone,$email,$qq);
				if ($insert) {
					echo "<script>alert('ע��ɹ���'); history.go(-2);</script>";
				} else {
					echo "<script>alert('ϵͳ��æ�����Ժ�'); history.go(-1);</script>";
				}
			}
		} else {
			echo "<script>alert('���벻һ�£�'); history.go(-1);</script>";
		}
	}
} else {
	echo "<script>alert('�ύδ�ɹ���'); history.go(-1);</script>";
}