<!-- 
    Will contain:
    - Get All Book requests for a given semester (generate list of all book requests)
        - Generate the list for the upcoming semester for submission (Submit appears only for this)
    - Make/Delete new admin accounts (will generate new temp password on creation)
    - Schedule email for book request due date. Global broadcast.
        - Form will ask for due date, date to send email, time to send email
        - Decision to be made on how to handle to send instant global broadcasts. 
    - Broadcast email for a Book request from an individual professor
    Notes: 
        The plan is to make this an admin hub page where everything can be done on the same page.
        Think like how the opening page of my.ucf.edu shows up in a block format or like the Xbox homescreen
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Book Request - Staff</title>
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <script>
        function confirmButton(){
            var selection = confirm("Are you sure you'd like to delete this request?");
            if (selection == true){
                var field = document.getElementById("individualEmailError");

                field.innerHTML = "Success.";
                field.className = "row justify-content-center alert alert-success";
            }
        }
    </script>
	<?php include 'logoutHeader.php'?>
    <div class="staffViewContainer container">
        <h1 class="row justify-content-center text-center">Staff Hub</h1>
        <div class="getAll row">
            <input class="btn btn-primary m-2" type="button" value="Get All Book Requests">
            <p id="viewResults">Fill me with innerHTML</p>
            <input class="btn btn-primary m-2" type="button" value="Submit Requests For Upcoming Semester"><br>
            <span class="getAllError"></span>
        </div>
		<div class="row">
			<div class="scheduleEmail col text-center border border-secondary rounded m-2">
            <h4 class="justify-content-center text-center">Global Announcement</h4>
            <form onsubmit="">
                <input class="form-control" type="text" placeholder="Due Date"><br>
                <h6 class="text-center justify-content-center mb-2">An email notification will be immediately sent to all professors.<br/>
				Additionally, you can set a date and time below for a reminder email to be sent.
                </h6><br>
                <input class="form-control" type="text" placeholder="Reminder Date"><br>
                <input class="form-control" type="text" placeholder="Time"><br>
                <input class="btn btn-primary m-2" type="submit" value="Send Global Announcement">
            </form>
            <span class="scheduleEmailError"></span>
            </div>
			<div class="makeOrDeleteAdmin col border border-secondary rounded m-2">
				<h4 class="justify-content-center text-center">Add Staff Accounts</h4>
				<form class="editStaffForm" action="../../backend/php/createStaff.a.php" method="post">
					<input class="form-control mb-1" type="text" name="uid" placeholder="Username">
					<input class="form-control mb-1" type="text" name="email" placeholder="Email">
					<input class="form-control mb-1" type="text" name="fn" placeholder="First Name">
					<input class="form-control mb-1" type="text" name="ln" placeholder="Last Name">
					<input class="btn btn-primary m-2 col" type="submit" name="submit" value="Create Staff Account">
				</form>
				<span class="makeOrDeleteAdminError"></span>
			</div>
		</div>
		
        <div class="row">
            <div class="individualEmail col text-center border border-secondary rounded m-2">
            <h4 class="justify-content-center text-center">Individual Notification</h4>
            <form class="col" onsubmit="">
                <input class="form-control" type="text" placeholder="Email Individual"><br>
                <input class="btn btn-primary m-2" type="submit" value="Send Individual Notification">
            </form>
			</div>
			<div class="makeOrDeleteAdmin col border border-secondary rounded m-2">
            <h4 class="justify-content-center text-center">Delete User Account</h4>
			<form class="editStaffForm" action="../../backend/php/deleteUser.a.php" method="post">
				<input class="form-control mb-1" type="text" name="uid" placeholder="Username">
				<input class="btn btn-primary m-2 col" type="submit" name="submit" value="DELETE USER">
			</form>
            <span class="makeOrDeleteAdminError"></span>
        </div>
        </div>
        <span id="individualEmailError" class="row justify-content-center"></span>
		<div class="row">
            <a class="btn btn-primary m-2" href="newPassword.php">Change Password</a>
        </div>
    </div>
</body>
</html>