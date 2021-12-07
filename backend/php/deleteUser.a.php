<?php

if (isset($_POST["submit"])) {
		
	require_once 'dbh.h.php';
	
	$uid = $_POST["uid"];
	
	
		
	# Find the user with the matching username
	$row = sql_query("SELECT * FROM user WHERE username = ?", "s", $uid);
	if (!$row) {
		header("location: ../../frontend/html/staffView.php?deleteStaff=uidDNE");
		exit();
	}
	$id = $row["user_id"];
	
	#Do NOT delete the superadmin account
	if ($row["admin_level"]===3) {
		header("location: ../../frontend/html/staffView.php?deleteStaff=superadmin");
		exit();
	}
	
	# Delete the account from user, professor, and staff.
	# Also delete their requests (if any) and the books attached to those requests (if any)
	sql_query("DELETE FROM user WHERE user_id = ?", "i", $id);
	sql_query("DELETE FROM professor WHERE user_id = ?", "i", $id);
	sql_query("DELETE FROM staff WHERE user_id = ?", "i", $id);
	$row = sql_query("SELECT * FROM request WHERE user_id = ?", "i", $id);
	sql_query("DELETE FROM request WHERE user_id = ?", "i", $id);
	if($row) {
		$rid = $row["request_id"];
		sql_query("DELETE FROM book WHERE request_id = ?", "i", $rid);
	}
	
	header("location: ../../frontend/html/staffView.php?deleteStaff=success");
	exit();
	
} 
else {
	header("location: ../../frontend/html/staffView.php?deleteStaff=submit");
	exit();
}
