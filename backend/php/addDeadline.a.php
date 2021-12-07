<?php


function check_date($date){
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}


if (isset($_POST["submit"])) {
	
	if (!isset($_POST["semester"])) {
		header("location: ../../frontend/html/staffView.php?addDeadline=semester");
		exit();
	}
	
	$dl = $_POST["deadline"];
	$rd = $_POST["remindDate"];
	$sm = $_POST["semester"];
	
	require_once 'dbh.h.php';
	
	if (!check_date($dl)) {
		header("location: ../../frontend/html/staffView.php?addDeadline=deadline");
		exit();
	}
	# (rd is allowed to be empty)
	if (!empty($rd) && !check_date($rd)) {
		header("location: ../../frontend/html/staffView.php?addDeadline=remindDate");
		exit();
	}
	if (empty($sm) || $sm === "Select Semester") {
		header("location: ../../frontend/html/staffView.php?addDeadline=semester");
		exit();
	}
	
	# Send first broadcast email to all users
	$res = sql_run("SELECT * FROM user","");
	if(mysqli_num_rows($res)<=0) {
		header("location: ../../frontend/html/staffView.php?addDeadline=noUsers");
	}
	while($row = mysqli_fetch_assoc($res)) {
		$email = $row["email"];
		$message = "A new deadline has been created for semester " . $sm . ", get all of your book requests in before " . $dl . "!\n";
		$message .= "Sign in and get started here: http://localhost/COP4710-FP/frontend/html/";
		$retval = send_email($email,"Deadline Notification",$message);
		if( $retval !== true ) {
			# Just ignore the error and move on. (superadmin is guarenteed to fail b/c it has no email)
		}
	}
	
	# Then log the deadline in the database
	$send_email = 0;
	if (!empty($rd)) {
		$send_email = 1;
	}
	sql_query("INSERT INTO deadline (semester, due, reminder, send_email) VALUES (?, ?, ?, ?);", "sssi", $sm, $dl, $rd, $send_email);
	
	
	header("location: ../../frontend/html/staffView.php?addDeadline=success");
	exit();
}
else {
	header("location: ../../frontend/html/staffView.php?addDeadline=submit");
	exit();
}