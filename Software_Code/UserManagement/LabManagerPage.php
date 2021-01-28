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
  <meta charset="utf-8">
  <title>Lab Manager</title> <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <header>
    <img class="img-fluid" src="../University-of-Dundee-logo.png" width="300px" style="padding:20px">
  </header>

  <div class="jumbotron text-center">
    <h1 class="text-center">Lab Manager</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
		<button onclick="location.href='ViewUsers.php'" type='button' class='btn btn-primary'>Manage Users</button>
		<button onclick="location.href='../experimentList.php'" type='button' class='btn btn-primary'>View Experiments</button>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="../University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
