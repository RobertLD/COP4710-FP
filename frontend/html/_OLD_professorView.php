<!-- 
    Will contain:
    - If they are signed in, the link in the book request email will auto-login to here.
    - Simply is a menu to navigate to the CRUD functions of a book request
    Notes: 
        All the CRUD pages should be able to navigate back to this hub
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Book Request - Professor</title>
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <form class="logoutForm col justify-content-start" action="../../backend/php/logout.a.php" method="post">
			    <input class="btn btn-secondary" type="submit" name="submit" value="Logout"></input></br>
		    </form>  
        </div>
        <h1 class="row justify-content-center mb-5">Please pick from your permissions below</h1>
        <div class="row justify-content-center">
            <a class="row justify-content-center btn btn-primary m-2 text-center" href="createRequestForm.php">Create Book Request</a>
        </div>
        <div class="row justify-content-center">
            <a class="row justify-content-center btn btn-primary m-2 text-center" href="editRequestForm.php">View/Update/Delete Book Request</a>
        </div>
        <div class="row justify-content-center">
            <a class="row justify-content-center btn btn-primary m-2 text-center" href="newPassword.php">Change Password</a>
        </div>
    </div>
</body>

</html>