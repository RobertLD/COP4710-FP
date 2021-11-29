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
	$sql = "SELECT * FROM user WHERE username = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/index.php?error=uidstmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $uid);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($res);
	if (!$row) {
		header("location: ../../frontend/html/index.php?error=wronglogin");
		exit();
	}
	mysqli_stmt_close($stmt);
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
	header("location: ../../frontend/html/index.php?error=none");
	exit();
}
else {
	header("location: ../../frontend/html/index.php?error=submit");
	exit();
}