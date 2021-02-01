<?php include 'includes/header.php'?>
<?php
//ensures user is logged in
  // if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
  //   header("location: login.php");
  //   exit;
  // }
  // if(isset($_SESSION["experimentID"])){
  //   $experimentID = $_SESSION["experimentID"];
  // } else {
  //   //If an experiment hasn't been selected redirect to relevant page
  //   header("location: experimentList.php");
  //   exit;
  // }

  include "Includes/db.inc.php";
  $questionnaireID = $_SESSION['questionnaireID'];

  if(isset($_POST['addQ'])){
      $questiontext = $_POST['questionText'];
    if (empty($questiontext)) {
      echo "The question must have text!";
    }
    else {
    //send to db sql here
      $questionID = uniqid($prefix="", $more_entropy=false);
      // echo "<p> Question: ".$questionID."<br> Question Text: ".$questiontext."<br> QuestionnaireID: ".$questionnaireID."</p>";

      $questionType = 1;

      $sql = "INSERT INTO questions(questionID, questionText, questionnaireID, questionType) VALUES ('$questionID', '$questiontext', '$questionnaireID', $questionType)";
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        //header("location: addQuestions.php");
      }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }

  if(isset($_POST['logout'])) {
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['USER_role']);

    $_SESSION["loggedin"] = false;
    header("location: login.php");
  }

  if(isset($_POST['quit'])) {
    header("location: questionnaireList.php");
    exit;
  }

  if(isset($_POST['cancel'])) {
    $sql = "DELETE FROM questions WHERE questionnaireID = '$questionnaireID'";
    if ($conn->query($sql) === TRUE) {
      echo "Questions deleted successfully";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql = "DELETE FROM questionnaires WHERE questionnaireID = '$questionnaireID'";
    if ($conn->query($sql) === TRUE) {
      echo "Questionnaire deleted successfully";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // header("location: questionnaireList.php");
    // exit;
  }
  ?>


  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Add a Question</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
      <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="style.css">
    </head>

    <body>
      <header style="height:150px;">
        <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left">
        <form method="POST">
          <input type="submit" value="Log Out" name="logout" style="float: right; margin:20px">
        </form>
      </header>

        <div class="jumbotron text-center">
          <h1 class="text-center">Add a Question</h1>
        </div>
      <div class="container-fluid" style="padding:0">
        <div class="jumbotron" style="margin-bottom:1px;">
          <h2 class="text-center">You are creating a question for questionnaire:
          <?php echo $_SESSION['questionnaireName']; ?></h2>
            <form method="POST">
              <div class="form-group">
                <label>Please enter the question: </label>
                <input type="text" name="questionText"><br><br>
                <input type="submit" value="Add question" name="addQ" class='btn btn-outline-success'>
                <input type="submit" value="Save and quit" name="quit" class='btn btn-outline-success'>
                <input type="submit" value="Cancel questionnaire" name="cancel" class='btn btn-outline-success'>
            </form>
            <br></br>
          </div>
        </div>
      <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
      </footer>
    </body>
  </html>
