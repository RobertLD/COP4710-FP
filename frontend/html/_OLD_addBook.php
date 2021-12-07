<!-- 
    Will contain:
    - Select semester drop down input
    - Form contains: (1) book title, (2) author names, (3) edition, (4) publisher, (5) ISBN.
    - Submit form button.
        - Warning will appear first saying it will overide a previous request if it exists for the given semester
        - Upon confirmation it will process the POST/PUT on the database for the professor for the given semester
    Notes: 
        All the CRUD pages should be able to navigate back to this hub
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Book Request - Add to a Request</title>
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- JS imports-->
</head>

<body>
    <div class="bookRequest container text-center">
        <?php
			session_start();
			if(!isset($_SESSION["semester"])) {
				header("location: ../../frontend/html/editRequestForm.php?addBook=semester");
				exit();
			}
			echo '<h1 class="row justify-content-center">Add a Book to ' . $_SESSION["semester"] . '</h1>';
		?>
		<form class="bookRequestForm col"  action="../../backend/php/addBook.a.php" method="post">
			<div class="row justify-content-center">
                <input class="form-control" type="text" name="title" placeholder="Book Title"></br>
                <input class="form-control" type="text" name="author" placeholder="Author Name"></input></br>
                <input class="form-control" type="text" name="ed" placeholder="Edition"></input></br>
                <input class="form-control" type="text" name="publish" placeholder="Publisher"></input></br>
                <input class="form-control" type="text" name="isbn" placeholder="ISBN"></input></br>
                <input class="btn btn-primary m-2" type="submit" name="submit" value="Add Book to Request"></input>
			</div>
		</form>
        <a class="row justify-content-center m-2" href="index.php">Home</a><br/>
        <span class="bookRequestError row justify-content-center"></span>
    </div>
</body>

</html>