<?php

session_start();

if (isset($_POST["submit"])) {
	$pwd = $_POST["pwd"];
	$pwdr = $_POST["pwdr"];
	
	require_once 'dbh.h.php';
	
	
	# Check input formatting
	if (empty($pwd) || empty($pwdr)) {
		header("location: ../../frontend/html/newPassword.html?error=empty");
		exit();
	}
	if ($pwd !== $pwdr) {
		header("location: ../../frontend/html/newPassword.html?error=pwdr");
		exit();
	}
	
	# Get the user from the current login session
	if (!isset($_SESSION["id"])) {
		header("location: ../../frontend/html/newPassword.html?error=session");
		exit();
	}
	$id = $_SESSION["id"];
	
	# Change the password
	$pwdHash = password_hash($pwd, PASSWORD_DEFAULT);
	$isTemp = 0;
	echo "TempPwd=" . $tempPwd . ", tempHash=" . $tempHash . "\n";
	
	$sql = "UPDATE user SET password_hash = ? WHERE user.user_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/newPassword.html?error=tempstmt1");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "si", $pwdHash, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	$sql = "UPDATE user SET tmp_password = ? WHERE user.user_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/newPassword.html?error=tempstmt2");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ii", $isTemp, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	$_SESSION["tmp"] = 0;
	header("location: ../../frontend/html/newPassword.html?error=none");
	exit();
}
else {
	header("location: ../../frontend/html/newPassword.html?error=submit");
	exit();
}