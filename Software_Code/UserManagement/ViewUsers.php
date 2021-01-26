<?php include "../Includes/db.inc.php";?>
<html>
	<title>User Management</title>
	<body>
		<h1> Manage Users </h1>
		
		<div>
			<button onclick="location.href='CreateUser.php';" type="button">Create Account</button>
			
			<table>
				<tr>
					<th>Username</th>
					<th>First name</th>
					<th>Surname</th>
				</tr>
				<?php
					
					$query = "SELECT UserName, Firstname, Surname, UserID FROM User";
					$result = mysqli_query($conn, $query);
					
					while($row = mysqli_fetch_array($result)){
						
						echo "<tr>";

						echo "<td>" . $row['UserName'] . "</td>";
						echo "<td>" . $row['Firstname'] . "</td>";
						echo "<td>" . $row['Surname'] . "</td>";
						echo '<td> <button onclick="location.href=\'ManageUser.php?id=' .$row['UserID'] .'\';" type="button">Manage</button> </td>';

						echo "</tr>";
						
					}
					
				?>
				</tr>
			</table>
		</div>
	</body>

</html>
