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
	if(!ISSET($_GET['rid'])){
		header('Location:error.inc.php');
		exit();
	}

	$userID = $_GET['rid'];

	$query = "DELETE FROM coexperiments WHERE UserID = $userID AND experimentid = $eID";
	$result = mysqli_query($conn, $query);
	
	header("location: ../UserManagement/ManageCoResearchers.php?eid=".$eID);
	exit();
?>