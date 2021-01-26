<?php include "../Includes/db.inc.php";?>
<?php 

	$userID = $_GET['id']; 
	
	if(ISSET($_GET['id'])){
		$query = "DELETE FROM User WHERE UserID = $userID";
		$result = mysqli_query($conn, $query);
    }
	header("location: ../UserManagement/ViewUsers.php");
	exit();

?>