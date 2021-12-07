<!-- 
    Will contain:
    - Select semester drop down input. This will change the data in the form
    - Form contains: (1) book title, (2) author names, (3) edition, (4) publisher, (5) ISBN.
    - Info will autopopulate with the results of the GET request for that Professor and Semester
    - Update button
        - confirmation of the update will be shown upon completion of PUT request
    - Delete button
        - Warning that you are about to delete
        - Confirmation of deletion after (form should be empty)
    Notes: 
        All the CRUD pages should be able to navigate back to this hub
-->

<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	require_once '../../backend/php/dbh.h.php';
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Book Request - View all Requests</title>
    <!--Boostrap Imports-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- JS imports-->
</head>

<body>
	<script type="text/javascript">
        function replaceFormDiv() {
            document.getElementById("formDiv").innerHTML += `
                <form action="">
                    <input class="form-control" id="BookTitle" placeholder="Book Title"></input></br>
                    <input class="form-control" id="AuthorName" placeholder="Author Name:"></input></br>
                    <input class="form-control" id="Edition" placeholder="Edition"></input></br>
                    <input class="form-control" id="Publisher" placeholder="Publisher"></input></br>
                    <input class="form-control" id="ISBN" placeholder="ISBN"></input>
                </form>
            `
            document.getElementById("updateButton").innerHTML = `
                <input class="col btn btn-primary m-2" type="button" value="Click to View Book Request" onclick="goToViewDiv()">
            `
        }
        function goToViewDiv() {
            document.getElementById("formDiv").innerHTML = `
                <div class='border border-secondary rounded p-2 m-3'>
                    <h1>View Of Selected Semester</h1>
                    <p id="BookTitle">Book Title:</p></br>
                    <p id="AuthorName">Author Name:</p></br>
                    <p id="Edition">Edition:</p></br>
                    <p id="Publisher">Publisher:</p></br>
                    <p id="ISBN">ISBN:</p>
                </div> 
            `
            document.getElementById("updateButton").innerHTML = `
                <input class="col btn btn-primary m-2" type="button" value="Update Request" onclick="replaceFormDiv()">
            `
        }
        function confirmButton(){
            var selection = confirm("Are you sure you'd like to delete this request?");
            if (selection == true){
                var field = document.getElementById("bookRequestError");

                field.innerHTML = "Success.";
                field.className = "row justify-content-center alert alert-success";
            }
        }
    </script>
	<div class="container">
		<div class="d-flex justify-content-sm-start">
			<a class="btn btn-primary m-2" href="index.php">Home</a>
		</div>
	</div>
	<div class="bookRequest container text-center">
        <h1 class="mt-3">View All Book Requests</h1>
		<h6>You can print this page with Ctrl+P</h6><br>
        <div class="row justify-content-center mt-5">
			<form class="bookRequestForm row" method="post">
				<h4 class="col justify-content-center">Select Semester:</h4>
				<select name="semester" class="col form-select form-select-lg mb-2" onchange="this.form.submit()">
					<?php
						$semesters = array("Fall 2021","Spring 2022","Summer 2022","Fall 2022");
						
						$select = "none";
						if(isset($_POST["semester"])) {
							$_SESSION["semester"] = $_POST["semester"];
						}
						if(isset($_SESSION["semester"])) {
							$select = $_SESSION["semester"];
						}
						else {
							echo '<option selected disabled hidden>Select Semester</option>';
						}
						foreach ($semesters as $sem) {
							$tag = "";
							if($sem === $select) {
								$tag .= " selected";
							}
							echo '<option' . $tag . '>' . $sem . '</option>';
						}
					?>
				</select>
			</form>
        </div>
        </br>
		<?php
			echo '<div id="formDiv" class="row justify-content-start">';
			echo '<div class="border border-secondary rounded p-2 m-3">';
			
			if(!isset($_SESSION["id"])) {
				echo '<h1>INVALID SESSION</h1>';
			}
			else if(!isset($_SESSION["semester"])) {
				echo '<h1>No Semester Selected</h1>';
			}
			else {
				# This is a valid session with a semester selected, find all requests for this semester
				$semester = $_SESSION["semester"];
				$res_req = sql_run("SELECT * FROM request WHERE semester = ?", "s", $semester);
				if(mysqli_num_rows($res_req)<=0) {
					echo '<h1>No Books for ' . $semester . '</h1>';
				}
				else {
					echo '<h1>View Of ' . $semester . '</h1>';
					echo '<div class="row">';
					echo '<p class="col m-2"><u>Book Title</u></p>';
					echo '<p class="col m-2"><u>Author</u></p>';
					echo '<p class="col m-2"><u>Edition</u></p>';
					echo '<p class="col m-2"><u>Publisher</u></p>';
					echo '<p class="col m-2"><u>ISBN</u></p>';
					echo '</div>';
					# For each request in this semester
					while($req = mysqli_fetch_assoc($res_req)) {
						# Find all books in the request
						$rid = $req["request_id"];
						$res_book = sql_run("SELECT * FROM book WHERE request_id = ? ORDER BY ISBN ASC", "i", $rid);
						# If there are none, skip this request
						if (mysqli_num_rows($res_book)<=0) {
							continue;
						}
						# Otherwise display the books
						while($book = mysqli_fetch_assoc($res_book)) {
							echo '<hr class="border-3 border-top border-dark">';
							echo '<form action="../../backend/php/editReq.a.php" method="post" class="row">';
							echo '<p class="col m-2">' . $book["title"] . '</p>';
							echo '<p class="col m-2">' . $book["author"] . '</p>';
							echo '<p class="col m-2">' . $book["edition"] . '</p>';
							echo '<p class="col m-2">' . $book["publisher"] . '</p>';
							echo '<p class="col m-2">' . $book["ISBN"] . '</p>';
							echo '</form>';
						}
					}
				}
			}
		
			echo '</div>';
			echo '</div>';
		?>
        <span id="bookRequestError" class="row justify-content-center"></span>
    </div>
</body>

</html>