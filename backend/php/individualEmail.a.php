<?php

session_start();

if(!isset($_SESSION["fn"]) || !isset($_SESSION["ln"])) {
	header("location: ../../frontend/html/staffView.php?indivEmail=session");
	exit();
}

if (isset($_POST["submit"])) {
	$email = $_POST["email"];
	
	require_once 'dbh.h.php';
	
	# Check input formatting
	check_email($email,"location: ../../frontend/html/staffView.php?indivEmail=email");
	
	# Send "invite email" email
	$message = $_SESSION["fn"] . " " . $_SESSION["ln"] . " has invited you to create a professor account.\n";
	$message .= "Sign up and create your book requests here: http://localhost/COP4710-FP/frontend/html/register.php";
	$retval = send_email($email,"Bookstore Professor Invitation",$message);
	
	if( $retval !== true ) {
		header("location: ../../frontend/html/staffView.php?indivEmail=sendmail");
		exit();
    }
	header("location: ../../frontend/html/staffView.php?indivEmail=success");
	exit();
}
else {
	header("location: ../../frontend/html/staffView.php?indivEmail=submit");
	exit();
}