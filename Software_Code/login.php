<!-- code adapted from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php  -->
<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    //header("location: welcome.php");
    //exit();
}

// Include database file
require_once "Includes/db.inc.php";

// Define variables and initialize with empty values
$username = $password = "";
// $username_err = $password_err = "";

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

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT * FROM User WHERE UserName = '$username'";
        $result = mysqli_query($conn, $sql);
        $count = 0;
        while($row = mysqli_fetch_array($result)){
            $count=1;
            $id = $row["UserID"];
            $username = $row["UserName"];
            $hashed_password = $row["Password"];

            if($password == $hashed_password){
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["USER_role"] = $row["Role"];
                // Redirect user to welcome page
                header("location: welcome.php");
            }else{
                // Display an error message if password is not valid
                $password_err = "The password you entered was not valid.";
            }
        }

        if($count!=1){
            // Display an error message if username doesn't exist
            $username_err = "No account found with that username.";
        }      
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
		<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .wrapper{ margin-left: 35%; margin-right:35%; width: 30%; }
        </style>
    </head>
    <body>

        <header>
		    <img class="img-fluid" src="../University-of-Dundee-logo.png" width="300px" style="padding:20px">
	    </header>

        <div class="jumbotron text-center">
		    <h1 class="text-center">Login</h1>
	    </div>

	    <div class="container-fluid" style="padding:0">
		    <div class="jumbotron" style="margin-bottom:1px;">
                <div class="wrapper">

                    <p>Please fill in your credentials to login.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">

                            <!-- username form to recieve input -->
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block" style="color:red"><?php if(ISSET($username_err)) {echo $username_err;} ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                            <!-- password form to recieve input -->
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="help-block" style="color:red"><?php if(isset($password_err))echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer>
		    <img class="img-fluid mx-auto d-block" src="../University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
	    </footer>
    </body>
</html>
