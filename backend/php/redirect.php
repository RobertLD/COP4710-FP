<?php

# Whenever the website is loaded, check for deadlines
include "updateDeadline.php";

session_start();

if(isset($_SESSION["tmp"]) && $_SESSION["tmp"]===1) {
	header("location: ../../frontend/html/newPassword.php");
	exit();
}

if(isset($_SESSION["lvl"])) {
	if($_SESSION["lvl"]===1) {
		header("location: ../../frontend/html/professorView.php");
		exit();
	}
	if($_SESSION["lvl"]===2 || $_SESSION["lvl"]===3) {
		header("location: ../../frontend/html/staffView.php");
		exit();
	}
}