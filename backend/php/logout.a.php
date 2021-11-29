<?php

# Delete all session data, so the user is no longer logged in
session_start();
$_SESSION = array();

# Go back to the login page
header("location: ../../frontend/html/index.php");