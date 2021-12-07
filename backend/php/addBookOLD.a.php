<?php

	
if (isset($_POST["submit"])) {
	
	session_start();
	require_once 'dbh.h.php';
	
	$semester = $_SESSION["semester"];
	$title = $_POST["title"];
	$author = $_POST["author"];
	$ed = $_POST["ed"];
	$publish = $_POST["publish"];
	$isbn = $_POST["isbn"];
	
	if (empty($semester) || empty($title) || empty($author) || empty($ed) || empty($publish) || empty($isbn)) {
		header("location: ../../frontend/html/addBook.php?addBook=empty");
		exit();
	}
	if (!isset($_SESSION["id"])) {
		header("location: ../../frontend/html/addBook.php?addBook=session");
		exit();
	}
	$id = $_SESSION["id"];
	
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
	sql_query("INSERT INTO book (request_id, title, author, edition, publisher, ISBN) VALUES (?, ?, ?, ?, ?, ?);",
		"isssss", $rid, $title, $author, $ed, $publish, $isbn);
	
	header("location: ../../frontend/html/editRequestForm.php?addBook=success");
	exit();
	
}
else {
	header("location: ../../frontend/html/addBook.php?addBook=submit");
	exit();
}