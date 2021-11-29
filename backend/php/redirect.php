<?php

session_start();

if(isset($_SESSION["tmp"]) && $_SESSION["tmp"]===1) {
	header("location: ../../frontend/html/newPassword.html");
	exit();
}

if(isset($_SESSION["lvl"])) {
	if($_SESSION["lvl"]===1) {
		header("location: ../../frontend/html/professorView.html");
		exit();
	}
	if($_SESSION["lvl"]===2 || $_SESSION["lvl"]===3) {
		header("location: ../../frontend/html/staffView.html");
		exit();
	}
}