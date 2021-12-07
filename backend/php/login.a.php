<?php

if (isset($_POST["submit"])) {
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	
	require_once 'dbh.h.php';
	
	# Check input formatting
	if (empty($uid) || empty($pwd)) {
		header("location: ../../frontend/html/index.php?error=empty");
		exit();
	}
	if (!preg_match("/^[a-zA-Z0-9]*/", $uid)) {
		header("location: ../../frontend/html/index.php?error=uid");
		exit();
	}
	
	# Verify uid/pwd
	$row = sql_query("SELECT * FROM user WHERE username = ?;","s", $uid);
	if (!$row) {
		header("location: ../../frontend/html/index.php?error=wronglogin");
		exit();
	}
	$hashedPwd = $row["password_hash"];	
	$checkPwd = password_verify($pwd, $hashedPwd);
	if($checkPwd !== true) {
		header("location: ../../frontend/html/index.php?error=wronglogin");
		exit();
	}
	
	# Start the user's session
	session_start();
	$_SESSION["id"] = $row["user_id"];
	$_SESSION["uid"] = $row["username"];
	$_SESSION["lvl"] = $row["admin_level"];
	$_SESSION["tmp"] = $row["tmp_password"];
	$_SESSION["fn"] = $row["first_name"];
	$_SESSION["ln"] = $row["last_name"];
	header("location: ../../frontend/html/index.php?error=none");
	exit();
}
else {
	header("location: ../../frontend/html/index.php?error=submit");
	exit();
}