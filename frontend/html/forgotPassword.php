<!-- 
    Will contain:
    - message with instructions of the process
    - input field for an email
    - submit button
        - Text will change to sent to the email if an account exists.
        - Email will contain a link to the login page with the generated temp password
-->
<?php
	# If the user is already logged in, this redirects them to the correct view
	include_once '../../backend/php/redirect.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Book Request - Forgot Password</title>
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body onload="errorParse()">
    <script>
        function errorParse(){
            var url = window.location.href;

            var errorVar = url.split("?");
            console.log(errorVar);

            if (errorVar.length == 1){
                return;
            }

            var error = errorVar[1].split("=");
            console.log(error);

            var value = error[1];

            var fields = document.getElementById("forgotPasswordError");
            var str = "";

            // error=empty
            if (value == "empty"){
                str = "Please enter an email.";
            }
            // error=email
            if (value == "email"){
                str = "Please enter a valid email address.";
            }
            // error=emailstmt
            if (value == "emailstmt"){
                str = "Error preparing email search sql statement.";
            }
            // error=wrongemail
            if (value == "wrongemail"){
                str = "Email not found.";
            }
            // error=tempstmt1
            if (value == "tempstmt1"){
                str = "Error preparing password hash update sql statement.";
            }
            // error=tempstmt2
            if (value == "tempstmt2"){
                str = "Error preparing temp password update sql statement.";
            }
            // error=sendmail
            if (value == "sendmail"){
                str = "Error sending email.";
            }
            // error=none
            if (value == "none"){
                str = "";
            }
            // error=submit
            if (value == "submit"){
                str = "Error processing HTTP request.";
            }

            console.log(str);
            if (str != ""){
                fields.innerHTML = str;
                fields.className = "row justify-content-center alert alert-danger";
            }

            else{
                fields.innerHTML = "Success! Check your email."
                fields.className = "row justify-content-center alert alert-success";
            }

        }
    </script>
    <div class="forgotPasswordDiv container text-center">
        <h1 class="row justify-content-md-center">Please enter your email for a link to change your password</h1></br>
		<form class="loginForm row" action="../../backend/php/forgotpwd.a.php" method="post">
			<input class="form-control" type="text" name="email" placeholder="Email"><br>
			<input class="btn btn-primary m-2" type="submit" name="submit" value="Send Email"></input></br>
		</form>
        <a class="row justify-content-center" href="index.php">Home</a><br/>
        <span class="forgotPasswordError row justify-content-center"></span>
    </div>
    <span id="forgotPasswordError" class="row justify-content-center"></span>
</body>
</html>