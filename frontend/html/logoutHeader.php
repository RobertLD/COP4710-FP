<?php
# Whenever the website is loaded, check for deadlines
include "../../backend/php/updateDeadline.php";
?>
<div class="container">
    <div class="d-flex justify-content-sm-start">
        <form class="p-2" action="../../backend/php/logout.a.php" method="post">
		    <input class="btn btn-secondary" type="submit" name="submit" value="Logout"></input></br>
	    </form>
		<?php
			if(!isset($_SESSION["id"]))
			{
				session_start();
			}
			if(!isset($_SESSION["fn"]) || !isset($_SESSION["ln"])) {
				echo '<h1>INVALID SESSION</h1>';
				header("location: ../../backend/php/logout.a.php");
				exit();
			}
			else {
				echo '<h4 class="p-2">Welcome Back, ' . $_SESSION["fn"] . ' ' . $_SESSION["ln"] . '</h4>';
			}
		?>
    </div>
</div>