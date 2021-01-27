<<?php

include 'Includes/header.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
  header("location: login.php");
  exit;
}

//

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Create Experiment</title <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<!-- -->
<body>
  <header>
    <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px">
  </header>

  <div class="jumbotron text-center">
    <h1 class="text-center">Create Experiment</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
      <form>
        <div class="form-group">
          <label>Enter Name of Experiment</label>
          <input type="text" name="Name of Experiment"><br><br>
          <!--check if the experiment name already exists and display error message to user?-->
          <!--store input from user in session variable and compare it to result from SQL query to the database-->
      </form>
      <br></br>
      <form>
        <div class="form-group">
          <label>Enter Description of experiment</label>
          <input type="text" name="Description of Experiment"><br><br>
      </form>
      <br></br>
      <form>
        <input type="submit" value="Submit For Approval">
        <!--include php here that sends -->
      </form>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
