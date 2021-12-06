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


# Determine if the staff is being created or destroyed
$mode = 0;
if (isset($_POST["create"])) {
	$mode = 1;
}
else if (isset($_POST["delete"])) {
	$mode = 2;
}

# common setup
if ($mode === 1 || $mode === 2) {
	$uid = $_POST["uid"];
	$email = $_POST["email"];
	$fn = $_POST["fn"];
	$ln = $_POST["ln"];
	
	require_once 'dbh.h.php';

	# Check input formatting
	if (empty($email) || empty($uid)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=empty");
		exit();
	}
	if (!preg_match("/^[a-zA-Z0-9]*/", $uid)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=uid");
		exit();
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=email");
		exit();
	}
}

# Create a new staff
if ($mode === 1) {
	
	# Check if username is taken
	$sql = "SELECT * FROM user WHERE username = ? OR email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=stmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_assoc($res)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=uidtaken");
		exit();
	}
	mysqli_stmt_close($stmt);
	
	
	# Create a new user
	$sql = "INSERT INTO user (username, password_hash, tmp_password, email, first_name, last_name, admin_level) VALUES (?, ?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=createstmt");
		exit();
	}
	$tempPwd = random_str(5);
	$tempHash = password_hash($tempPwd, PASSWORD_DEFAULT);
	$isTemp = 1;
	$lvl = 2;
	mysqli_stmt_bind_param($stmt, "ssisssi", $uid, $tempHash, $isTemp, $email, $fn, $ln, $lvl);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	# Get the table row for the user that was just created
	$sql = "SELECT * FROM user WHERE username = ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=stmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $uid);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($res);
	$id = $row["user_id"];
	mysqli_stmt_close($stmt);
	
	# Make the new user a staff
	$sql = "INSERT INTO staff (user_id, username, superadmin) VALUES (?, ?, 0);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../frontend/html/staffView.html?errorStaff=stmt");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "is", $id, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	# Send the new user an invitational email
	$to = $email;
	$subject = "Bookstore Invitation";
	
	$message = "You have been given a staff acount with the username " . $row["username"] . " and the temporary password " . $tempPwd . "\n";
	$message .= "Please sign in here: http://localhost/COP4710-FP/frontend/html/";
	
	$header = "From:rn109@yahoo.com \r\n";
	
	$retval = mail ($to,$subject,$message,$header);
	
	if( $retval !== true ) {
		header("location: ../../frontend/html/staffView.html?error=sendmail");
		exit();
    }
	header("location: ../../frontend/html/staffView.html?error=none");
	exit();
}
else {
	header("location: ../../frontend/html/staffView.html?errorStaff=submit");
	exit();
}