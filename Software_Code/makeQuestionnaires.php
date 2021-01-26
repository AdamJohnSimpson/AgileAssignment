<?php
//ensures user is logged in
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login.php");
    exit;
  }
  if(isset($_SESSION["experiment"])){
    $experimentID = $_SESSION["experiment"];
  } else {
    //If an experiment hasn't been selected redirect to relevant page
    header("location: experimentList.php");
    exit;
  }

  //gets db connection
  require_once "Includes/db.inc.php";
  //when clicked the submit button while post the question value

  //check it table exsits for questionnaie, if not create the mysql_list_table
  $exists = mysql_query("SELECT 1 from {$experimentID}");
  if ($exists !== FALSE) {
    //table exsists
  } else {
    try{
    //table does not exsist, create table
    $query = "CREATE TABLE  mysql_real_escape_string($_SESSION['experimentName']) (
                UserID int,
                Question VARCHAR(255),
    )";
    $mysql->exec($query);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  }


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Add Question']);{
      $question = $_POST['question'];
  if (empty($question)) {
      echo "A question can't be empty!";
      //refresh page or whatever
  } else {
    //send to db sql here
    $stmt = $mysql->prepare("INSERT INTO {$experimentID} (UserID, Question) VALUE (:UserID, :Question)");

    $stmt->bindParam(":UserID", $userID);
    $stmt->bindParam(":Question", $tableQuestion);

    $userID =  $_SESSION["id"];
    $tableQuestion = $question;
    $stmt->execute();
}
}
  //if the exit button is clicked then ends experiment choice session and returns to expereiment list
  if(isset($_POST['quit']) {
    unset($_SESSION['experimentName'])
    unset($_SESSION['experimentID'])
    header("location: experimentList.php");
    exit;
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
    <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px">
      <div class="jumbotron text-center">
        <h1 class="text-center">Make a Questionnaire</h1>
      </div>
    <div class="container-fluid" style="padding:0">
      <div class="jumbotron" style="margin-bottom:1px;">
          <form>
            <div class="form-group">
              <label>You are currently creating a questionnaire for experiment : <?php echo $_SESSION["experimentName"] ?></label>
              <input type="text" name="question"><br><br>
              <input type="submit" value="Add Question" name="Add Question">
          </form>
          <br></br>
          <form>
            <input type="submit" value="Save and Quit" name="quit">
          </form>
        </div>
      </div>
  </body>
</html>
