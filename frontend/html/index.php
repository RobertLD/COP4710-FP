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
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- JS imports-->
</head>

<body>
    <div class="login text-center contaner" >
        <div class="row m-2"><h1>Please login below</h1></div>
        <div class="loginDiv row m-2 justify-content-md-center">
            <form class="loginForm col-md-auto" action="../../backend/php/login.a.php" method="post">
                <input type="text" class="form-control" name="uid" placeholder="Username"></input></br>
                <input type="text" class="form-control" name="pwd" placeholder="Password"></input></br>
                <input type="submit" class="btn btn-primary m-2" name="submit" value="Login"></input></br>
            </form>
        </div>
        <div class="routeDiv row m-2">
            <a class="createAccountLink" href="register.html">Create New Account</a><br/>
            <a class="forgotPasswordLink" href="forgotPassword.html">Forgot Password?</a>
        </div>
        <span class="loginError row m-2"></span>
    </div>
</body>

</html>