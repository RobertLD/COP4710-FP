<!-- 
    Will contain:
    - User/password field
    - Submit button
    - Create account link (this will only create Professor accounts!)
    - Forgot password link
    - onLoad checks if the user is already logged in or not by checking cookies. If they are, auto-route accordingly.
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
    <title>UCF Book Request - Login</title>
    <!-- JS imports-->
    <script src="index.js" type="text/javascript"></script>
</head>

<body onload="errorParse()" onhashchange="errorParse()">

    <script type="text/javascript">
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

            var fields = document.getElementById("loginError");
            var str = "";

            // error=empty
            if (value == "empty"){
                str = "Please enter username and password.";
            }
            // error=uid
            if (value == "uid"){
                str = "Invalid Username.";
            }
            // error=uidstmt
            if (value == "uidstmt"){
                str = "Error preparing sql statement.";
            }
            // error=wronglogin
            if (value == "wronglogin"){
                str = "Invalid username or password.";
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
            fields.innerHTML = str;
            fields.className = "row justify-content-center alert alert-danger";
        }
    </script>

    <div class="login">
        <div class="loginDiv">
            <form class="loginForm" action="../../backend/php/login.a.php" method="post">
                <input type="text" name="uid" placeholder="Username"></input></br>
                <input type="text" name="pwd" placeholder="Password"></input></br>
                <input type="submit" name="submit" value="Login"></input></br>
            </form>
        </div>
        <div class="routeDiv">
            <a class="createAccountLink" href="register.html">Create New Account</a><br/>
            <a class="forgotPasswordLink" href="forgotPassword.html">Forgot Password?</a>
        </div>
        <span id="loginError"></span>
    </div>
</body>

</html>