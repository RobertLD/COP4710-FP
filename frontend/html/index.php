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
</head>

<body>
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
        <span class="loginError"></span>
    </div>
</body>

</html>