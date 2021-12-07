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
            if (value != "none"){
                fields.innerHTML = str;
                fields.className = "row justify-content-center alert alert-danger";
            }
            else{
                fields.innerHTML = "Success!";
                fields.className = "row justify-content-center alert alert-success";
            }
        }
    </script>

    <div class="login text-center contaner" >
        <div class="row m-2"><h1>Please login below</h1></div>
        <div class="loginDiv row m-2 justify-content-center">
            <form class="loginForm col-md-auto" action="../../backend/php/login.a.php" method="post">
                <input type="text" class="form-control" name="uid" placeholder="Username"></input></br>
                <input type="password" class="form-control" name="pwd" placeholder="Password"></input></br>
                <input type="submit" class="btn btn-primary m-2" name="submit" value="Login"></input></br>
            </form>
        </div>
        <div class="routeDiv row m-2">
            <a class="createAccountLink" href="register.php">Create New Account</a><br/>
            <a class="forgotPasswordLink" href="forgotPassword.php">Forgot Password?</a>
        </div>
        <span id="loginError" class="row m-2 justify-content-center"></span>
    </div>
</body>

</html>