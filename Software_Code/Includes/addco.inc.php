<?php include "db.inc.php";?>
<?php 

	session_start();

	if(!ISSET($_SESSION["USER_role"]) || $_SESSION["USER_role"] != "Principal Researcher"){
		 header('Location: redirect.inc.php');
		 exit();
	}

	// If no experiment ID was present, redirect the user
	if(!ISSET($_GET['eid'])){
		header('Location:error.inc.php');
		exit();
	}
		
	$eID = $_GET['eid'];

	// If no user ID was present, redirect the user
	if(!ISSET($_GET['aid'])){
		header('Location:error.inc.php');
		exit();
	}

	$userID = $_GET['aid'];

	$query = "INSERT INTO coexperiments(UserID,experimentid) VALUES ($userID, $eID)";
	$result = mysqli_query($conn, $query);
	
	header("location: ../ManageCoResearchers.php?eid=".$eID);
	exit();
?>