<?php include "../Includes/db.inc.php";?>
<?php

	session_start();

	if(!ISSET($_SESSION["USER_role"]) || $_SESSION["USER_role"] != "Lab Manager"){
		 header('Location:../Includes/redirect.inc.php');
		 exit();
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

	<head>
		<title>Manage Users</title>
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
		</header>

		<div class="jumbotron text-center">
			<h1 class="text-center">Manage Users</h1>
		</div>
		<div class="container-fluid" style="padding:0">
			<div class="jumbotron" style="margin-bottom:1px;">

				<div style="margin-bottom:1%">
				<button onclick="location.href='CreateUser.php';" type="button" class="btn btn-primary">Create Account</button>
				</div>


				<table class="table">
					<tr>
						<th scope="col">Username</th>
						<th scope="col">First name</th>
						<th scope="col">Surname</th>
					</tr>
					<?php

						$query = "SELECT UserName, Firstname, Surname, UserID FROM User";
						$result = mysqli_query($conn, $query);

						while($row = mysqli_fetch_array($result)){

							echo "<tr>";

							echo "<td>" . $row['UserName'] . "</td>";
							echo "<td>" . $row['Firstname'] . "</td>";
							echo "<td>" . $row['Surname'] . "</td>";
							echo '<td> <button onclick="location.href=\'ManageUser.php?id=' .$row['UserID'] .'\';" type="button" class="btn btn-secondary">Manage</button> </td>';

							echo "</tr>";

						}

					?>
				</table>
			</div>
		</div>

		<footer>
			<img class="img-fluid mx-auto d-block" src="../University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
		</footer>

	</body>

</html>
