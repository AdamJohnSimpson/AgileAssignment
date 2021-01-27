<!-- code adapted from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php  -->
<?php

	session_start();

	if(!ISSET($_SESSION["USER_role"]) || $_SESSION["USER_role"] != "Lab Manager"){
		 header('Location:../Includes/redirect.inc.php');
		 exit();
	}
?>
<?php
include "../Includes/db.inc.php";

// define variables and innitialise
$firstname = "";
$surname = "";
$email = "";
$role = "";
$username = "";
$password = "";
$confirm_password = "";
$userNameResult = TRUE;
$roleEmpty = TRUE;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //checks if firsname is empty
    if(empty(trim($_POST["firstname"]))){
        $fill_err = "Please fill this required field.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    //checks if surname is empty
    if(empty(trim($_POST["surname"]))){
        $fill_err = "Please fill this required field.";
    } else{
        $surname = trim($_POST["surname"]);
    }

    //checks if email is empty
    if(empty(trim($_POST["email"]))){
        $fill_err = "Please fill this required field.";
    } else{
        $email = trim($_POST["email"]);
    }

    //checks if role is empty
    if(empty(trim($_POST["role"]))){
        $fill_err = "Please fill this required field.";
    } else{
        $role = trim($_POST["role"]);
        $roleEmpty = FALSE;
    }

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Check if confirm password is empty
    if(empty(trim($_POST["confirm_password"]))){
        $password_err = "Please enter a password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
    }

    //if there are not username or password errors
    if(empty($username_err) && empty($password_err)){

		//checks to see if user already exists in the databse
		$sql = "SELECT * FROM User WHERE UserName = '$username'";
		$result = mysqli_query($conn, $sql);
		if ($result){
			$row = mysqli_fetch_array($result);
			if($row && $row['UserName'] === $username){
				$username_err = "Username already exists";
				$userNameResult = True;
			} else {
				$userNameResult = FALSE;
			}
		}
	}
    //if both passwords are not the same
    if ($password != $confirm_password){
      $password_err = "Passwords entered do not match";
    }

    //if both passwords are the same and username is not used and role is not empty
    if($password === $confirm_password && $userNameResult == FALSE && $roleEmpty == FALSE) {
      // Prepare an insert statement
       $sql = "INSERT INTO User (FirstName, Surname, EmailAddress, Role, UserName, Password) VALUES ('$firstname', '$surname', '$email', '$role', '$username', '$password')";

       // if query works
       if ($conn->query($sql) === TRUE) {
         echo "New user created successfully.";

         sleep(1);
         header("location: ViewUsers.php");

       }
       //if query doesnt work
       else {
         echo "Error: " . $sql . "<br>" . $conn->error;
       }


  }
}

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>User Management</title <!-- Bootstrap CSS -->
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
        <h1 class="text-center">User Management</h1>
      </div>

      <div class="container-fluid" style="padding:0">
        <div class="jumbotron" style="margin-bottom:1px;">

        <div class="wrapper">
            <h2>Create Users</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

              <!-- form to recieve first name from user -->
              <div class="form-group">
                  <label>First Name</label>
                  <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                  <span class="help-block" style="color:red"><?php if(isset($fill_err))echo $fill_err; ?></span>
              </div>

              <!-- form to recieve surname from user -->
              <div class="form-group">
                  <label>Surname</label>
                  <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>">
                  <span class="help-block" style="color:red"><?php if(isset($fill_err))echo $fill_err; ?></span>
              </div>

              <!-- form to recieve email address from user -->
              <div class="form-group">
                  <label>Email Address</label>
                  <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                  <span class="help-block" style="color:red"><?php if(isset($fill_err))echo $fill_err; ?></span>
              </div>

              <!-- form to recieve role from user -->
              <div class="form-group">
                  <label>Role</label>
				  <select name="role" class="form-control" value="<?php echo $role; ?>">
					<option value="Lab Manager">Lab Manager</option>
					<option value="Principal Researcher">Principal Researcher</option>
					<option value="Co-Researcher">Co-Researcher</option>
				  </select>
              </div>

              <!-- form to recieve username from user -->
                <div class="form-group ">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block" style="color:red"><?php if(isset($username_err))echo $username_err; ?></span>
                </div>

                <!-- form to recieve password from user -->
                <div class="form-group ">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block" style="color:red"><?php if(isset($password_err))echo $password_err; ?></span>
                </div>

                <!-- form to confirm password from user -->
                <div class="form-group ">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block" style="color:red"><?php if(isset($password_err))echo $password_err; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>

                <footer>
                      <img class="img-fluid mx-auto d-block" src="../University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
                </footer>

      </body>

    </html>
