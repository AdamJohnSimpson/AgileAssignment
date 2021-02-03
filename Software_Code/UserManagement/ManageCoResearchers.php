<?php include "../Includes/db.inc.php";?>
<?php

	session_start();

	if(!ISSET($_SESSION["USER_role"]) || $_SESSION["USER_role"] != "Principal Researcher"){
		 header('Location:../Includes/redirect.inc.php');
		 exit();
	}

	// If no experiment ID was present, redirect the user
	if(!ISSET($_GET['eid'])){
		header('Location:../Includes/error.inc.php');
		exit();
	}
	
	$eID = $_GET['eid'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

	<head>
		<title>Manage Co-Researchers</title>
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
			<img class="img-fluid" src="../University-of-Dundee-logo.png" width="300px" style="padding:20px">
		</header>

		<div class="jumbotron text-center">
			<h1 class="text-center">Manage Co-Researchers</h1>
		</div>
		<div class="container-fluid" style="padding:0">
			<div class="jumbotron" style="margin-bottom:1px;">

				<div style="margin-bottom:1%">
					<h2>Current Co-Researchers</h2>
				</div>

				<table class="table">
					<tr>
						<th scope="col">Username</th>
						<th scope="col">First name</th>
						<th scope="col">Surname</th>
					</tr>
					<?php

						$query = "SELECT UserName, Firstname, Surname, UserID FROM User WHERE Role = 'Co-Researcher' AND UserID IN (SELECT UserID FROM coexperiments WHERE experimentid = $eID)";
						$result = mysqli_query($conn, $query);

						while($row = mysqli_fetch_array($result)){

							echo "<tr>";

							echo "<td>" . $row['UserName'] . "</td>";
							echo "<td>" . $row['Firstname'] . "</td>";
							echo "<td>" . $row['Surname'] . "</td>";
							echo '<td> <button onclick="location.href=\'../Includes/remco.inc.php?eid=' .$eID .'&rid='.$row['UserID'].'\';" type="button" class="btn btn-danger">Remove</button> </td>';
							echo '<td> <button onclick="TestMe()" type="button" class="btn btn-danger">Test</button> </td>';

							echo "</tr>";

						}

					?>
				</table>

				<div style="margin-bottom:1%">
					<h2>Other Users</h2>
				</div>

				<table class="table">
					<tr>
						<th scope="col">Username</th>
						<th scope="col">First name</th>
						<th scope="col">Surname</th>
					</tr>
					<?php

						$query = "SELECT UserName, Firstname, Surname, UserID FROM User WHERE Role = 'Co-Researcher' AND UserID NOT IN (SELECT UserID FROM coexperiments WHERE experimentid = $eID)";
						$result = mysqli_query($conn, $query);

						while($row = mysqli_fetch_array($result)){

							echo "<tr>";

							echo "<td>" . $row['UserName'] . "</td>";
							echo "<td>" . $row['Firstname'] . "</td>";
							echo "<td>" . $row['Surname'] . "</td>";
							echo '<td> <button onclick="location.href=\'../Includes/addco.inc.php?eid=' .$eID .'&aid='.$row['UserID'].'\'" type="button" class="btn btn-secondary">Add</button> </td>';

							echo "</tr>";

						}

					?>
				</table>
			</div>
		</div>

		<footer>
			<img class="img-fluid mx-auto d-block" src="../University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
		</footer>

		<script>
			function TestMe(){
				alert('ahhhhhhhh');
				location.reload();
			}
		</script>

	</body>

</html>
