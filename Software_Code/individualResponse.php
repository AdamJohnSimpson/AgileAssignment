<?php
//ensure logged in code go here

// include 'Includes/header.php';
require_once "Includes/db.inc.php";
//$questionnaireID = $_SESSION['questionnaireID']; //get questionnaire id
$questionnaireID = "601811e5978fd"; //hard coded until page is finished and can be linked
$responseID = "60181209f21d8"; //hard coded until page is finished and can be linked
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Individual Responses</title>
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
    <h1 class="text-center">Individual Responses</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
      <?php
      $stmt = "SELECT * FROM questions WHERE questionnaireID = '{$questionnaireID}'"; //gets all questions from that questionnaire
      $resultQuestion = mysqli_query($conn, $stmt);
      //display questions
      while($row = mysqli_fetch_array($resultQuestion)){
        $questionTxt = $row['questionText'];
        $questionID = $row['questionID'];
         echo "<div class='row'>
           <div class='card-body'>
            <h5 class='card-text mt-2'>".$questionTxt."</h5>";
            $stmt = "SELECT * FROM results WHERE questionID = '{$questionID}' AND responseID = '{$responseID}'"; //get the response for the question it is on
            $resultResponse = mysqli_query($conn, $stmt);
            while($row = mysqli_fetch_array($resultResponse)){

            }




        echo "</div>
         </div>";
      }
      ?>






    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
