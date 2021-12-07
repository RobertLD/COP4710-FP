<?php

require_once 'dbh.h.php';

# Get the current date
$date = date('Y-m-d',time());
	
# Loop through all deadlines
$res_dl = sql_run("SELECT * FROM deadline","");
if(mysqli_num_rows($res_dl)>0) {
	while($row_dl = mysqli_fetch_assoc($res_dl)) {
		$dlid = $row_dl["deadline_id"];
		# Only send emails for deadlines that are active and pending
		if($row_dl["send_email"]===1) {
			# Check if it is time to send the reminder email
			$rm = $row_dl["reminder"];
			if(strtotime($date)>strtotime($rm)) {
				# Record that the reminder was sent
				sql_query("UPDATE deadline SET send_email = 2 WHERE deadline_id = ?","i",$dlid);
				
				# Send reminder email to all users for the current deadline
				$res_user = sql_run("SELECT * FROM user","");
				if(mysqli_num_rows($res_user)>0) {
					while($row_user = mysqli_fetch_assoc($res_user)) {
						$email = $row_user["email"];
						$message = "Automated Reminder: The deadline for semester " . $row_dl["semester"] . " is " . $row_dl["due"] . ".\n";
						$message .= "Make sure to have all of your book requests in before then!\n";
						$message .= "(Sign in here: http://localhost/COP4710-FP/frontend/html/ )";
						$retval = send_email($email,"Deadline Reminder",$message);
						if( $retval !== true ) {
							# Just ignore the error and move on. (superadmin is guarenteed to fail b/c it has no email)
						}
					}
				}#while user
			}
		}
	}#while deadline
}