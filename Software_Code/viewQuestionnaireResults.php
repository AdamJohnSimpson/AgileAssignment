<?php
session_start();

// Database Connection
include "Includes/db.inc.php";
$questionnaireID = $_GET['qid'];

$questionQuery = "SELECT questionID, questionText, questionType FROM questions WHERE questionnaireID = '$questionnaireID'";

$questionResult = mysqli_query($conn, $questionQuery);

$listOfQuestionText = array();
$listOfQuestionID = array();
$listOfQuestionType = array();
$allResults = array();
$allResultID = array();

if (mysqli_num_rows($questionResult) > 0) {
    while ($row = mysqli_fetch_array($questionResult)) {
      array_push($listOfQuestionText, $row['questionText']);
      array_push($listOfQuestionID, $row['questionID']);
      array_push($listOfQuestionType, $row['questionType']);
    }
}

for ($x=0; $x < count($listOfQuestionText) ; $x++) {
  $listOfResponses = array();
  $listOfResultID = array();
  $tempqid = $listOfQuestionID[$x];
  $responseQuery = "SELECT response, resultID FROM results WHERE questionID='$tempqid'";

  $responseResults = mysqli_query($conn, $responseQuery);

  if (mysqli_num_rows($responseResults) > 0) {
      while ($row = mysqli_fetch_array($responseResults)) {
        array_push($listOfResponses, $row['response']);
        array_push($listOfResultID, $row['resultID']);
      }
  }

  array_push($allResults, $listOfResponses);
  array_push($allResultID, $listOfResultID);

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Results</title> <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet/less" type="text/css" href="styles.less" />
  <script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
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
    <h1 class="text-center">Results</h1>
  </div>
  <div class="container-fluid" style="padding:0">

    <div class="jumbotron" style="margin-bottom:1px;">

      <?php
      if (count($listOfQuestionID) > 0) {
          for ($x=0; $x < count($listOfQuestionID); $x++) {
            echo "<br><h2><u><strong>{$listOfQuestionText[$x]}</strong></u></h2>";
            echo "<h4><u>ID: {$listOfQuestionID[$x]}</u></h4>";
            if ($listOfQuestionType[$x] == 1) {
              for ($y=0; $y < count($allResults[$x]); $y++) {
                echo "<h3> - {$allResults[$x][$y]} </h3>";
              }
            } else {
              echo "<h3>{$listOfQuestionType[$x]}</h3>";

              <div class="chart-wrap vertical">
              <h2 class="title">Test Title</h2>

              <div class="grid">
                  <div class="bar" style="--bar-value:85%;" data-name="Your Blog" title="Your Blog 85%"></div>
                  <div class="bar" style="--bar-value:23%;" data-name="Medium" title="Medium 23%"></div>
                  <div class="bar" style="--bar-value:7%;" data-name="Tumblr" title="Tumblr 7%"></div>
                  <div class="bar" style="--bar-value:38%;" data-name="Facebook" title="Facebook 38%"></div>
                  <div class="bar" style="--bar-value:35%;" data-name="YouTube" title="YouTube 35%"></div>
                  <div class="bar" style="--bar-value:30%;" data-name="LinkedIn" title="LinkedIn 30%"></div>
                  <div class="bar" style="--bar-value:5%;" data-name="Twitter" title="Twitter 5%"></div>
                  <div class="bar" style="--bar-value:20%;" data-name="Other" title="Other 20%"></div>
              </div>
            </div>
            }
          }
        } else {
          echo "<h2> No results yet... </h2>";
        }

       ?>

    </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
