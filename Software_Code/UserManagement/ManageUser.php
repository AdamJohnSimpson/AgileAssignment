<?php include "../Includes/db.inc.php";?>
<?php

	session_start();

	if(!ISSET($_SESSION["USER_role"]) || $_SESSION["USER_role"] != "Lab Manager"){
		 header('Location:../Includes/redirect.inc.php');
		 exit();
	}

	$userID = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

	<head>
		<title>Manage User</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
		<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../style.css">
		<link rel="shortcut icon" href="https://www.dundee.ac.uk/themes/custom/uod/assets/favicons/favicon.ico"/>
	</head>



	<body>

		<header>
			<a href="../Includes/redirect.inc.php"><img class="img-fluid" src="../University-of-Dundee-logo.png" width="300px" style="padding:20px"></a>
			<button onclick="location.href='../Includes/logout.inc.php';" type='button' class='btn btn-secondary' style="float: right; margin:20px">Logout</button>
		</header>

		<div class="jumbotron text-center">
			<h1 class="text-center">Manage User</h1>

		<?php

		if(ISSET($_GET['d']) && $_GET['d'] == 'true'){

			echo ' <button onclick="location.href=\'../Includes/deleteUser.inc.php?id=' .$userID .'\';" type="button" class="btn btn-danger">Confirm Delete?</button> ';
		}else{
			echo ' <button onclick="location.href=\'ManageUser.php?id=' .$userID .'&d=true\';" type="button" class="btn btn-danger">Delete Account</button> ';
		}
		?>
		</div>

		<div class="container-fluid" style="padding:0">
			<div class="jumbotron" style="margin-bottom:1px;">
				<?php

					if(ISSET($_GET['id'])){
						$query = "SELECT * FROM User WHERE User.UserID = $userID";
						$result = mysqli_query($conn, $query);

						while($row = mysqli_fetch_array($result)){
							echo "<h4>Username: " . $row['UserName'] . "</h4>";
							echo "<h4>Firstname: " . $row['FirstName'] . "</h4>";
							echo "<h4>Surname: " . $row['Surname'] . "</h4>";
							echo "<h4>Email: " . $row['EmailAddress'] . "</h4>";
							echo "<h4>Role: " . $row['Role'] . "</h4>";
							echo '<h4>Password: ' . $row["Password"] . ' <button onclick="location.href=\'../Includes/reset.inc.php?id=' .$row['UserID'] .'\';" type="button" class="btn btn-danger">Reset</button></h4>';
						}
					}
				?>
			</div>
		</div>

		<footer>
			<img class="img-fluid mx-auto d-block" src="../University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
		</footer>

	</body>

</html>
