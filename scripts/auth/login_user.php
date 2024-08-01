<?php
	// include "../include/functions.php";

	// session_start(); // Starting Session
	// $error=''; // Variable To Store Error Message
	
	// $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);	
	// if (!$token || $token !== $_SESSION['csrftoken']) {
	// 	$error = "Please try again";
	// 	header("location: ../../pages/auth/login.php?error=".$error);		
	// 	return;
	// }

	// if (empty($_POST['phone']) || empty($_POST['password']) ) {
	// 	$error = "Please fill all inputs";
	// 	header("location: ../../index.php?error=".$error);
	// 	return;
	// }
	
	// $phone = $_POST['phone'];
	// $password = $_POST['password'];

	// $phone = stripslashes($phone);
	
	// $data = array(
	// 	'phone' => $phone,
	// 	'password' => $password,
	// );

	// $response = CallAPIWithoutAuth("POST","user/loginPhone",$data);
	// $result = JSON_decode($response);

	// if ($result->error){
	// 	header("location: ../../index.php?error=".$result->message);	
	// }else{
	// 	$user = $result->user;
		
	// 	$_SESSION['loginUser'] = $result->data;				// store user
	// 	$_SESSION['sessionToken'] = $result->data->token;	// adding sessionToken to session
	// 	header("location: ../../app.php");
	// }

?>