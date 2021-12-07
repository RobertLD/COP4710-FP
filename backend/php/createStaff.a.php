<?php
	
if (isset($_POST["submit"])) {
	
	require_once 'dbh.h.php';
	
	$uid = $_POST["uid"];
	$email = $_POST["email"];
	$fn = $_POST["fn"];
	$ln = $_POST["ln"];
	
	
	# Check input formatting
	check_uid($uid,"location: ../../frontend/html/staffView.php?editStaff=uid");
	check_email($email,"location: ../../frontend/html/staffView.php?editStaff=email");
	
	
	# Check if username is taken
	$row = sql_query("SELECT * FROM user WHERE username = ? OR email = ?;", "ss", $uid, $email);
	if ($row) {
		header("location: ../../frontend/html/staffView.php?editStaff=uidtaken");
		exit();
	}
	
	# Create a new user
	$tempPwd = random_str(5);
	$tempHash = password_hash($tempPwd, PASSWORD_DEFAULT);
	sql_query("INSERT INTO user (username, password_hash, tmp_password, email, first_name, last_name, admin_level) VALUES (?, ?, 1, ?, ?, ?, 2);",
		"sssss", $uid, $tempHash, $email, $fn, $ln);
	
	# Get the table row for the user that was just created
	$row = sql_query("SELECT * FROM user WHERE username = ?", "s", $uid);
	$id = $row["user_id"];
	
	# Make the new user a staff
	sql_query("INSERT INTO staff (user_id, username, superadmin) VALUES (?, ?, 0);", "is", $id, $uid);
	
	# Send the new user an invitational email
	$message = "You have been given a staff acount with the username '" . $row["username"] . "' and the temporary password '" . $tempPwd . "'\n";
	$message .= "Please sign in here: http://localhost/COP4710-FP/frontend/html/";
	$retval = send_email($email,"Bookstore Invitation",$message);
		
	if( $retval !== true ) {
		header("location: ../../frontend/html/staffView.php?editStaff=sendmail");
		exit();
	}
	echo "sent email to " . $email; 
	exit();
	header("location: ../../frontend/html/staffView.php?editStaff=success");
	exit();
	
	
	# Delete a user
	if ($mode === 2) {
		
		# Find the user with the matching username
		$row = sql_query("SELECT * FROM user WHERE username = ?", "s", $uid);
		if (!$row) {
			header("location: ../../frontend/html/staffView.php?editStaff=uidDNE");
			exit();
		}
		$id = $row["user_id"];
		
		# Delete the
		sql_query("DELETE FROM staff WHERE staff.user_id = ?", "i", $id);
	}
	
}
else {
	header("location: ../../frontend/html/staffView.php?createStaff=submit");
	exit();
}
	