<!-- 
    Will contain:
    - email will be autopopulated
    - new password field
    - confirm password
    - submit
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Book Request - New Password</title>
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- JS imports-->
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

            var fields = document.getElementById("newPasswordError");
            var str = "";

            // error=empty
            if (value == "empty"){
                str = "Please enter all fields.";
            }
            // error=pwdr
            if (value == "pwdr"){
                str = "Both passwords must match.";
            }
            // error=session
            if (value == "session"){
                str = "Error processing login session.";
            }
            // error=tempstmt1
            if (value == "tempstmt1"){
                str = "Error preparing password hash update sql statement.";
            }
            // error=tempstmt2
            if (value == "tempstmt2"){
                str = "Error preparing temp password update sql statement.";
            }
            // error=none
            if (value == "none"){
                str = "Password successfully updated!";
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
                fields.innerHTML = str;
                fields.className = "row justify-content-center alert alert-success";
            }
        }
    </script>
	<?php include 'logoutHeader.php'?>
    <div class="container text-center">
        <h1 class="row justify-content-center mb-4">Update Password</h1>
        <div class="newPasswordDiv row">
            <form class="registerForm" action="../../backend/php/changepwd.a.php" method="post">
                <input type="text" class="form-control" name="pwd" placeholder="New Password"></input></br>
                <input type="text" class="form-control" name="pwdr" placeholder="Confirm New Password"></input></br>
                <input type="submit" class="btn btn-primary m-2" name="submit" value="Update Password"></br>
            </form>
        </div>
        <a class="row justify-content-center" href="index.php">Return to Home</a><br/>
        <span id="newPasswordError" class="row justify-content-center"></span>
    </div>
</body>

</html>