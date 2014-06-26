<?php
if (isset ( $_POST ["submit"] ) && $_POST ["submit"] == "Register") {
	$name = $_POST ["username"];
	$password = $_POST ["password"];
	$psw_confirm = $_POST ["confirm"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$qq = $_POST["qq"];
	if ($email == "" || $password == "" || $psw_confirm == "") {
		echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
	} else {
		if ($password == $psw_confirm) {
			
			require_once 'include/DB_Functions.php';
			$db = new DB_Functions();
			$result = $db->isUserExisted($name);
			if ($result) 			// 如果已经存在该用户
			{
				echo "<script>alert('用户名已存在'); history.go(-1);</script>";
			} else 			// 不存在当前注册用户名称
			{
				$insert = $db->storeUser($name,$password,$phone,$email,$qq);
				if ($insert) {
					echo "<script>alert('注册成功！'); history.go(-2);</script>";
				} else {
					echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
				}
			}
		} else {
			echo "<script>alert('密码不一致！'); history.go(-1);</script>";
		}
	}
} else {
	echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}