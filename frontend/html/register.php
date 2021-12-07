<!-- 
    Will contain:
    - Credentials form for a new professor account
    - password, confirm password verification
    - Submit form performs POST request for a new professor
    - Confirmation message with a link to reroute to login upon POST
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
    <title>UCF Book Request - Register</title>
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- JS imports-->
</head>

<body onload="errorParse()">
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

            var fields = document.getElementById("registerError");
            var str = "";

            // error=empty
            if (value == "empty"){
                str = "Please fill all fields.";
            }
            // error=email
            if (value == "email"){
                str = "Please enter a valid email address.";
            }
            // error=pwdr
            if (value == "pwdr"){
                str = "Passwords must match.";
            }
            // error=uid
            if (value == "uidtaken"){
                str = "Username or email already in use.";
            }
            // error=uidstmt
            if (value == "uidstmt"){
                str = "Error preparing username search sql statement.";
            }
            // error=createstmt
            if (value == "createstmt"){
                str = "Error preparing insert sql statement.";
            }
            // error=stmt
            if (value == "stmt"){
                str = "Error preparing username search sql statement.";
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
    <div class="register container text-center">
        <div class="registerDiv row">

            <form class="registerForm" action="../../backend/php/signup.a.php" method="post">
                <label><h1>Register Below</h1></label></br></br>
                <input class="form-control" type="text" name="email" placeholder="Email"></input></br>
                <input class="form-control" type="text" name="uid" placeholder="Username"></input></br>
                <input class="form-control" type="text" name="pwd" placeholder="Password"></input></br>
                <input class="form-control" type="text" name="pwdr" placeholder="Confirm Password"></input></br>
                <input class="form-control" type="text" name="fn" placeholder="First Name"></input></br>
                <input class="form-control" type="text" name="ln" placeholder="Last Name"></input></br>
                <input class="justify-content-center btn btn-primary m-2" type="submit" name="submit" value="Register"></input></br>
            </form>
        </div>
        <a class="row justify-content-center" href="index.php">Home</a><br/>
        <span id="registerError" class="row justify-content-center"></span>
    </div>
</body>
</html>