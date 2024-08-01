<?php
	// include "../include/functions.php";

	// session_start(); // Starting Session
	// $error=''; // Variable To Store Error Message
	
	// $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);	
	// if (!$token || $token !== $_SESSION['csrftoken']) {
	// 	$error = "Please try again";
	// 	header("location: ../../register.php?error=".$error);		
	// 	return;
	// }

	// if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) ) {
	// 	$error = "Please fill all inputs";
	// 	header("location: ../../register.php?error=".$error);
	// 	return;
	// }
	
	// $name = $_POST['name'];
	// $email = $_POST['email'];
	// $phone = $_POST['phone'];

	// $name = stripslashes($name);
	// $email = stripslashes($email);
	// $phone = stripslashes($phone);
	// /*
	// $data = array(
	// 	'name' => $name,
	// 	'email' => $email,
	// 	'phone' => $phone
	// );

	// $response = CallAPIWithoutAuth("POST","user/register",$data);
	// $result = JSON_decode($response);

	// if ($result->error){
	// 	header("location: ../../register.php?error=".$result->message);	
	// }else{
	// 	header("location: ../../index.php");
	// }
	// //*/
	// header("location: ../../pick_admission.php");
?>