<?php

session_start();
require_once 'dbh.h.php';


# Get mode and book_id from POST key\
$mode = "FAIL";
$postKeys = array_keys($_POST);
foreach ($postKeys as $key) {
	if(str_contains($key,"UpdateBook")) {
		$mode = "Update";
		$bid = intval(substr($key, strlen("UpdateBook")));
		break;
	}
	if(str_contains($key,"DeleteBook")) {
		$mode = "Delete";
		$bid = intval(substr($key, strlen("DeleteBook")));
		break;
	}
}



if ($mode === "Update") {
	
	
	$title = $_POST["title"];
	$author = $_POST["author"];
	$ed = $_POST["ed"];
	$publish = $_POST["publish"];
	$isbn = $_POST["isbn"];
	
	if (empty($title) || empty($author) || empty($ed) || empty($publish) || empty($isbn)) {
		header("location: ../../frontend/html/professorView.php?editReq=empty");
		exit();
	}
	if (!isset($_SESSION["id"]) || !isset($_SESSION["semester"])) {
		header("location: ../../frontend/html/professorView.php?editReq=session");
		exit();
	}
	$id = $_SESSION["id"];
	$semester = $_SESSION["semester"];
	
	# Find the request for the current user and semester
	$row = sql_query("SELECT * FROM request WHERE user_id = ? AND semester = ?", "is", $id, $semester);
	if(!$row) {
		header("location: ../../frontend/html/professorView.php?editReq=request");
		exit();
	}
	$rid = $row["request_id"];
	
	sql_query("UPDATE book SET title = ? WHERE book_id = ?;", "si", $title, $bid);
	sql_query("UPDATE book SET author = ? WHERE book_id = ?;", "si", $author, $bid);
	sql_query("UPDATE book SET edition = ? WHERE book_id = ?;", "si", $ed, $bid);
	sql_query("UPDATE book SET publisher = ? WHERE book_id = ?;", "si", $publish, $bid);
	sql_query("UPDATE book SET ISBN = ? WHERE book_id = ?;", "si", $isbn, $bid);
	
	header("location: ../../frontend/html/professorView.php?editBook=updateSuccess");
	exit();
}
else if($mode === "Delete") {
	
	sql_query("DELETE FROM book WHERE book_id = ?", "i", $bid);
	
	header("location: ../../frontend/html/professorView.php?editBook=deleteSuccess");
	exit();
}
else {
	header("location: ../../frontend/html/professorView.php?editBook=submit");
	exit();
}