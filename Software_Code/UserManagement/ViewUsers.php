<?php include "../Includes/db.inc.php";?>
<html>
	<title>User Management</title>
	<body>
		<h1> Manage Users </h1>
		
		<div>
			<button onclick="location.href='CreateUser.php';" type="button">Create Account</button>
			
			<table>
				<tr>
					<th>User</th>
				</tr>
				<tr>
					<td>Bob</td>
					<td><button onclick="location.href='ManageUser.php';" type="button">Manage</button></td>
				</tr>
			</table>
		</div>
	</body>

</html>
