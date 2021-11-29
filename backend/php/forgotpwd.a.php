<?php



function random_str(
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}





if (isset($_POST["submit"])) {
	$email = $_POST["email"];
	
	require_once 'dbh.h.php';
	
	# Check input formatting
	if (empty($email)) {
		header("location: ../../frontend/html/forgotPassword.html?error=empty");
		exit();
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("location: ../../frontend/html/forgotPassword.html?error=email");
		exit();
	}
	
	
	
	# Verify email
	$sql = "SELECT * FROM user WHERE email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/forgotPassword.html?error=emailstmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($res);
	if (!$row) {
		header("location: ../../frontend/html/forgotPassword.html?error=wrongemail");
		exit();
	}
	mysqli_stmt_close($stmt);
	
	# Set the temp password and replace the old password in the database
	$id = $row["user_id"];
	$tempPwd = random_str(5);
	$tempHash = password_hash($tempPwd, PASSWORD_DEFAULT);
	$isTemp = 1;
	
	$sql = "UPDATE user SET password_hash = ? WHERE user.user_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/forgotPassword.html?error=tempstmt1");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "si", $tempHash, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	$sql = "UPDATE user SET tmp_password = ? WHERE user.user_id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/forgotPassword.html?error=tempstmt2");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ii", $isTemp, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	
	
	# Send "forgot password" email
	$to = $email;
	$subject = "Bookstore Password Reset";
	
	$message = "The temp password for your account " . $row["username"] . " is " . $tempPwd . "\n";
	$message .= "Log in using your temp password: http://localhost/COP4710-FP/frontend/html/";
	
	$header = "From:rn109@yahoo.com \r\n";
	
	$retval = mail ($to,$subject,$message,$header);
	
	if( $retval !== true ) {
		header("location: ../../frontend/html/forgotPassword.html?error=sendmail");
		exit();
    }
	echo "The mail was sent to " . $email . " with the temp password " . $tempPwd . " and hash " . $tempHash;
	#header("location: ../../frontend/html/forgotPassword.html?error=none");
	exit();
}
else {
	header("location: ../../frontend/html/forgotPassword.html?error=submit");
	exit();
}