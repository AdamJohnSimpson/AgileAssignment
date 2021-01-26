<?php include "../Includes/db.inc.php";?>
<?php 

	$userID = $_GET['id']; 
	
	if(ISSET($_GET['id'])){
		$query = "UPDATE User SET Password = 'default' WHERE UserID = $userID";
		$result = mysqli_query($conn, $query);
    }
	header("location: ../UserManagement/ManageUser.php?id=$userID");
	exit();

?>