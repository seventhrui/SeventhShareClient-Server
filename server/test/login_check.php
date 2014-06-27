<?php
if (isset ( $_POST ["submit"] ) && $_POST ["submit"] == "Login") {
	$name = $_POST ["username"];
	$password = $_POST ["password"];
	if ($name == "" || $password == "") {
		echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
	} else {
		
		require_once 'include/DB_Functions.php';
		$db = new DB_Functions();
		$user = $db->getUserByNameAndPassword($name, $password);
		if ($user) {
			//header ( "Location: message.php" );
			echo "<script>alert('登录成功！');history.go(-1);</script>";
			header("Location: blog.php");
		} else {
			echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
		} 
	}
} else {
	echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}