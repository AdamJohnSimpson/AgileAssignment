<?php include "../Includes/db.inc.php";?>
<?php 

	session_start();

	if(!ISSET($_SESSION["USER_role"]) || $_SESSION["USER_role"] != "Lab Manager"){
		 header('Location: redirect.inc.php');
		 exit();
	}

	$userID = $_GET['id']; 
	
	if(ISSET($_GET['id'])){
		$query = "UPDATE User SET Password = 'default' WHERE UserID = $userID";
		$result = mysqli_query($conn, $query);
    }
	header("location: ../UserManagement/ViewUsers.php");
	exit();

?>