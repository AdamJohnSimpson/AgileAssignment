
<?php include 'includes/header.php'?>
<?php
ensures user is logged in
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login.php");
    exit;
  }
  if(isset($_SESSION["experimentID"])){
    $experimentID = $_SESSION["experimentID"];
  } else {
    //If an experiment hasn't been selected redirect to relevant page
    header("location: experimentList.php");
    exit;
  }

  //gets db connection
  include "Includes/db.inc.php";
  //when clicked the submit button while post the question value


//  check it table exsits for questionnaie, if not create the mysql_list_table

  if(isset($_POST['addname'])){
    $questionnaireName = $_POST['questionnaireName'];
    $_SESSION['questionnaireName'] = $questionnaireName;
  if (empty($questionnaireName)) {
      echo "The questionnaire must have a name!";

  } else {
    //send to db sql here
    $questionnaireID = uniqid($prefix="", $more_entropy=false);
    $_SESSION['questionnaireID'] = $questionnaireID;
    $experimentID = $_SESSION['experimentID'];
    $userID= $_SESSION['userID'];
    $sql = "INSERT INTO questionnaires(questionnaireID, questionnaireName, userID, experimentID) VALUES ('$questionnaireID', '$questionnaireName', '$userID', '$experimentID')";
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header("location: addQuestions.php");
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }}
  }
  //if the exit button is clicked then ends experiment choice session and returns to expereiment list
  if(isset($_POST['quit'])) {
    unset($_SESSION['experimentName']);
    unset($_SESSION['experimentID']);
    header("location: experimentList.php");
    exit;
  }

  if(isset($_POST['logout'])) {
    unset($_SESSION['loggedin']);
    header("location: login.php");
  }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Make a Questionnaire</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <header>
      <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px">
      <form method="POST">
        <input type="submit" value="Log Out" name="logout" style="float: left; padding:20px">
      </form>
    </header>

      <div class="jumbotron text-center">
        <h1 class="text-center">Make a Questionnaire</h1>
      </div>
    <div class="container-fluid" style="padding:0">
      <div class="jumbotron" style="margin-bottom:1px;">
        <h2 class="text-center">You are creating a questionnaire for experiment:
        <?php echo $_SESSION['experimentName']; ?></h2>
          <form method="POST">
            <div class="form-group">
              <label>Please enter the name of the questionnaire you are creating : </label>
              <input type="text" name="questionnaireName"><br><br>
              <input type="submit" value="Add questionnaire name" name="addname">
              <input type="submit" value="quit" name="quit">
          </form>
          <br></br>
        </div>
      </div>
      <footer>
            <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
      </footer>
  </body>
</html>
