<?php

if (isset($_POST["submit"])) {
	$fn = $_POST["fn"];
	$ln = $_POST["ln"];
	$email = $_POST["email"];
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdr = $_POST["pwdr"];
	
	require_once 'dbh.h.php';
	
	
	# Check input formatting
	if (empty($fn) || empty($ln) || empty($email) || empty($uid) || empty($pwd) || empty($pwdr)) {
		header("location: ../../frontend/html/register.html?error=empty");
		exit();
	}
	if (!preg_match("/^[a-zA-Z0-9]*/", $uid)) {
		header("location: ../../frontend/html/register.html?error=uid");
		exit();
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("location: ../../frontend/html/register.html?error=email");
		exit();
	}
	if ($pwd !== $pwdr) {
		header("location: ../../frontend/html/register.html?error=pwdr");
		exit();
	}
	
	# Check if username is taken
	$sql = "SELECT * FROM user WHERE username = ? OR email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/register.html?error=uidstmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_assoc($res)) {
		header("location: ../../frontend/html/register.html?error=uidtaken");
		exit();
	}
	mysqli_stmt_close($stmt);
	
	# Create a new user
	$sql = "INSERT INTO user (username, password_hash, tmp_password, email, first_name, last_name, admin_level) VALUES (?, ?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/register.html?error=createstmt");
		exit();
	}
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	$isTemp = 0;
	$lvl = 1;
	mysqli_stmt_bind_param($stmt, "ssisssi", $uid, $hashedPwd, $isTemp, $email, $fn, $ln, $lvl);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	# Get the table row for the user that was just created
	$sql = "SELECT * FROM user WHERE username = ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/register.html?error=stmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $uid);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($res);
	$id = $row["user_id"];
	mysqli_stmt_close($stmt);
	
	# Make the new user a professor
	$sql = "INSERT INTO professor (user_id, username) VALUES (?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/register.html?error=stmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "is", $id, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	header("location: ../../frontend/html/index.php?error=none");
	exit();
}
else {
	header("location: ../../frontend/html/register.html?error=submit");
	exit();
}