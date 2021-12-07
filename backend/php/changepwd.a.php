<?php

session_start();

if (isset($_POST["submit"])) {
	$pwd = $_POST["pwd"];
	$pwdr = $_POST["pwdr"];
	
	require_once 'dbh.h.php';
	
	
	# Check input formatting
	if (empty($pwd) || empty($pwdr)) {
		header("location: ../../frontend/html/newPassword.php?error=empty");
		exit();
	}
	if ($pwd !== $pwdr) {
		header("location: ../../frontend/html/newPassword.php?error=pwdr");
		exit();
	}
	
	# Get the user from the current login session
	if (!isset($_SESSION["id"])) {
		header("location: ../../frontend/html/newPassword.php?error=session");
		exit();
	}
	$id = $_SESSION["id"];
	
	# Change the password
	$pwdHash = password_hash($pwd, PASSWORD_DEFAULT);
	sql_query("UPDATE user SET password_hash = ? WHERE user.user_id = ?;", "si", $pwdHash, $id);
	sql_query("UPDATE user SET tmp_password = 0 WHERE user.user_id = ?;", "i", $id);
	
	$_SESSION["tmp"] = 0;
	header("location: ../../frontend/html/newPassword.php?error=none");
	exit();
}
else {
	header("location: ../../frontend/html/newPassword.php?error=submit");
	exit();
}