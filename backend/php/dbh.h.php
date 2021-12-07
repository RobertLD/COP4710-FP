<?php

# ----------------------------------------
# Setup the connection to the sql database
# ----------------------------------------

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "COP4710_FP";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if(!$conn) {
	die("Database connection failed: " . mysqli_connect_error());
}



# ----------------
# Custom Functions
# ----------------

# Generate a random alphanumeric string (used for temporary passwords)
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

# Clean and efficient way to execute sql commands from a single function
# sql_run returns the entire result
function sql_run($sql, $params, mixed &...$vars) {
	
	#Execute the sql statement with the given params and variables
	$stmt = mysqli_stmt_init($GLOBALS['conn']);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "SQL QUERY ERROR: Statment could not run!\n";
		echo $sql;
		exit();
	}
	if (!empty($params)) {
		mysqli_stmt_bind_param($stmt, $params, ...$vars);
	}
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return $res;
}
# sql_query returns the first row of the result, for convenience
function sql_query($sql, $params, mixed &...$vars) {
	$res = sql_run($sql, $params, ...$vars);
	# If the statement was a command, just return the boolean result
	if($res===False || $res===True) {
		return $res;
	}
	# If the statment was a query, return the result of the query
	return mysqli_fetch_assoc($res);
}

# Sends an email, returns true/false if it succeded/failed
function send_email($to, $subject, $message) {
	$header = "From:rn109@yahoo.com \r\n";
	return mail ($to,$subject,$message,$header);
}

# Checks the specified input type, sends the user to the given url if th input is not valid
function check_empty($var, $url) {
	if (empty($var)) {
		header($url);
		exit();
	}
}
function check_uid($uid, $url) {
	if (empty($uid) || !preg_match("/^[a-zA-Z0-9]*/", $uid)) {
		header($url);
		exit();
	}
}
function check_email($email, $url) {
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header($url);
		exit();
	}
}