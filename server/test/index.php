<?php
/**
 * File to handle all API requests
* Accepts GET and POST
*
* Each request will be identified by TAG
* Response will be JSON data

/**
* check for POST request
*/
if (isset ( $_POST ['tag'] ) && $_POST ['tag'] != '') {
	// get tag
	$tag = $_POST ['tag'];
	
	// include db handler
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions ();
	
	// response Array
	$response = array (
			"tag" => $tag,
			"success" => 0,
			"error" => 0 
	);
	
	// check for tag type
	if ($tag == 'login') {
		// Request type is check Login
		$name = $_POST ['email'];
		$password = $_POST ['password'];
		
		// check for user
		$user = $db->getUserByNameAndPassword ( $name, $password );
		if ($user != false) {
			// user found
			// echo json with success = 1
			$response ["success"] = 1;
			$response ["id"] = $user ["id"];
			$response ["customer"] ["id"] = $user ["id"];
			$response ["customer"] ["name"] = $user ["name"];
			$response ["customer"] ["email"] = $user ["email"];
			$response ["customer"] ["phone"] = $user ["phone"];
			$response ["customer"] ["qq"] = $user ["qq"];
			$response ["customer"] ["uptime"] = $user ["uptime"];
			echo json_encode ( $response );
		} else {
			// user not found
			// echo json with error = 1
			$response ["error"] = 1;
			$response ["error_msg"] = "Incorrect email or password!";
			echo json_encode ( $response );
		}
	} else if ($tag == 'register') {
		// Request type is Register new user
		$name = $_POST ['name'];
		$pass = $_POST ['pass'];
		$email = $_POST ['email'];
		$phone = $_POST ['phone'];
		$qq = $_POST ["qq"];
		
		// check if user is already existed
		if ($db->isUserExisted ( $name )) {
			// user is already existed - error response
			$response ["error"] = 2;
			$response ["error_msg"] = "User already existed";
			echo json_encode ( $response );
		} else {
			// store user
			$user = $db->storeUser ( $name, $pass, $email, $phone, $qq );
			if ($user) {
				// user stored successfully
				$response ["success"] = 1;
				$response ["id"] = $user ["id"];
				$response ["customer"] ["name"] = $user ["name"];
				$response ["customer"] ["email"] = $user ["email"];
				$response ["customer"] ["phone"] = $user ["phone"];
				$response ["customer"] ["qq"] = $user ["qq"];
				$response ["customer"] ["uptime"] = $user ["uptime"];
				echo json_encode ( $response );
			} else {
				// user failed to store
				$response ["error"] = 1;
				$response ["error_msg"] = "Error occured in Registartion";
				echo json_encode ( $response );
			}
		}
	} else if ($tag == 'publish') {
		$title = $_POST ['title'];
		$content = $_POST ['content'];
		$customerid = $_POST ['customerid'];
		//$customerid = 5;
		$blog = $db->storeBlog ( $customerid, $title, $content );
		if ($blog) {
			$response ["success"] = 1;
			$response ["id"] = $blog ["id"];
			$response ["blog"] ["customerid"] = $blog ["customerid"];
			$response ["blog"] ["title"] = $blog ["title"];
			$response ["blog"] ["content"] = $blog ["content"];
			$response ["blog"] ["commentcount"] = $blog ["commentcount"];
			$response ["blog"] ["uptime"] = $blog ["uptime"];
			echo json_encode ( $response );
		} else {
			// user failed to store
			$response ["error"] = 1;
			$response ["error_msg"] = "Error occured in Publish";
			echo json_encode ( $response );
		}
	} else {
		echo "Invalid Request";
	}
} else {
	echo "Access Denied";
}
