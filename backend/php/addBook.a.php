<?php

	
if (isset($_POST["AddBook"])) {
	
	session_start();
	require_once 'dbh.h.php';
	
	if (!isset($_SESSION["id"]) || !isset($_SESSION["semester"])) {
		header("location: ../../frontend/html/professorView.php?addBook=session");
		exit();
	}
	$id = $_SESSION["id"];
	$semester = $_SESSION["semester"];
	
	# If there is already a request for this user and semester, use it
	$row = sql_query("SELECT * FROM request WHERE user_id = ? AND semester = ?", "is", $id, $semester);
	if($row) {
		$rid = $row["request_id"];
	}
	# Otherwise, create a new request for the given user and semester
	else {
		sql_query("INSERT INTO request (user_id, semester) VALUES (?, ?);",
			"is", $id, $semester);
		$row = sql_query("SELECT * FROM request ORDER BY request_id DESC LIMIT 1", "");
		$rid = $row["request_id"];
	}
	
	# Create a new book and add it to the current request
	sql_query("INSERT INTO book (request_id, title, author, edition, publisher, ISBN) VALUES (?, 'Book Title', 'Author', 'Edition', 'Publisher', 'ISBN');",
		"i", $rid);
	
	header("location: ../../frontend/html/professorView.php?addBook=success");
	exit();
	
}
else {
	header("location: ../../frontend/html/professorView.php?addBook=submit");
	exit();
}