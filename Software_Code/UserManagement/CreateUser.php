<!-- code adapted from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php  -->

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

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){

      //checks to see if user already exists
      $sql = "SELECT * FROM User WHERE UserName = '$username'";
      $result = mysqli_query($conn, $sql);
      if ($result){
        if ($result['username'] === $username){
          echo "Username already exists";
        }

      }
}
    //if both passwords are not the same
    if ($password != $confirm_password){
      echo "Passwords entered do not match";
    }

    //if both passwords are the same and username is not used
    if($password == $confirm_password && $result['username'] != $username){
      // Prepare an insert statement
       $sql = "INSERT INTO Users (FirstName, Surname, EmailAddress, Role, UserName,  Password) VALUES ($firstname, $surname, $email, $role, $username, $password)";
       $result = mysqli_query($conn, $sql);
       echo "Successfully added user.";
    }
  }

?>

  <!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <h2>Create Users</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

              <!-- form to recieve first name from user -->
              <div class="form-group">
                  <label>First Name</label>
                  <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
              </div>

              <!-- form to recieve surname from user -->
              <div class="form-group">
                  <label>Surname</label>
                  <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>">
              </div>

              <!-- form to recieve email address from user -->
              <div class="form-group">
                  <label>Email Address</label>
                  <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
              </div>

              <!-- form to recieve role from user -->
              <div class="form-group">
                  <label>Role</label>
                  <input type="text" name="role" class="form-control" value="<?php echo $role; ?>">
              </div>

              <!-- form to recieve username from user -->
                <div class="form-group ">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php if(isset($username_err))echo $username_err; ?></span>
                </div>

                <!-- form to recieve password from user -->
                <div class="form-group ">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php if(isset($password_err))echo $password_err; ?></span>
                </div>

                <!-- form to confirm password from user -->
                <div class="form-group ">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php if(isset($password_err))echo $password_err; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    
                </div>
      </body>
    </html>
