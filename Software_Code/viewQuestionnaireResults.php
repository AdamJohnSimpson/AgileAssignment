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
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet/less" type="text/css" href="chartStyles.less" />
  <script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
</head>

<body>
  <header style="height:150px;">
    <a href="Includes/redirect.inc.php"><img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left"></a>
    <button onclick="location.href='Includes/logout.inc.php';" type='button' class='btn btn-secondary' style="float: right; margin:20px">Logout</button>
  </header>

  <div class="jumbotron text-center">
    <h1 class="text-center">Results - test</h1>
  </div>
  <div class="container-fluid" style="padding:0">

    <div class="jumbotron" style="margin-bottom:1px;">

      <?php
      if (count($listOfQuestionID) > 0) {
          for ($x=0; $x < count($listOfQuestionID); $x++) {

            echo "<br><h2><u><strong>{$X} - {$listOfQuestionText[$x]}</strong></u></h2>";
            echo "<h4><u>ID: {$listOfQuestionID[$x]}</u></h4>";

            if ($listOfQuestionType[$x] == 1)
            {
              for ($y=0; $y < count($allResults[$x]); $y++)
              {
                echo "<h3> - {$allResults[$x][$y]} </h3>";
              }
            }
            else if ($listOfQuestionType[$x] == 2 || $listOfQuestionType[$x] == 3)
            {
              $noOfResponses = 0;
              $countOfValues = array_count_values($allResults[$x]);

              $values = array_keys($countOfValues);

              echo '<div class="chart-wrap vertical">
              <div class="grid">';

              for ($a=0; $a < count($values); $a++) {
                $noOfResponses += $countOfValues[$values[$a]];
              }

              for ($z=0; $z < count($values); $z++)
              {
                $percentage = round(($countOfValues[$values[$z]] / $noOfResponses) * 100);
                echo '<div class="bar" style="--bar-value:' . $percentage . '%;" data-name="'. $values[$z] . '" title="' . $values[$z] . ': ' . $countOfValues[$values[$z]] . '"></div>';
              }
              echo '</div>
            </div>';
            }
            else {
              $tempID = $listOfQuestionID[$x];
              $subQuestionQuery = "SELECT uqID, uqText FROM usabilityquestions WHERE questionID = '$tempID'";
              $subQuestionResults = mysqli_query($conn, $subQuestionQuery);

              $subQuestionID = array();
              $subQuestionText = array();
              $subQuestionResponses = array();
              $allSubResults = array();

              if (mysqli_num_rows($subQuestionResults) > 0) {
                  while ($row = mysqli_fetch_array($subQuestionResults)) {
                    array_push($subQuestionID, $row['uqID']);
                    array_push($subQuestionText, $row['uqText']);
                  }
              }

              for ($i=0; $i < count($subQuestionID); $i++) {
                $tempID = $subQuestionID[$i];
                $subQuestionResultsQuery = "SELECT response FROM usabilityresults WHERE uqID = '$tempID'";
                $subQuestionResultsResults = mysqli_query($conn, $subQuestionResultsQuery);



                if (mysqli_num_rows($subQuestionResultsResults) > 0) {
                    while ($row = mysqli_fetch_array($subQuestionResultsResults)) {
                      array_push($subQuestionResponses, $row['response']);
                    }
                }

                array_push($allSubResults, $subQuestionResponses);

              }
              print_r($allSubResults);

              for ($p=0; $p < count($subQuestionText); $p++) {
                $noOfSubResponses = 0;
                $countOfSubValues = array();

                $countOfSubValues = array_count_values($allSubResults[$p]);

                print_r($countOfSubValues);

                $subValues = array_keys($countOfSubValues);
                echo "<h3>" . $subQuestionText[$p] . "</h3> <br>";
                echo '<div class="chart-wrap vertical">
                <div class="grid">';

                for ($b=0; $b < count($subValues); $b++) {
                  $noOfSubResponses += $countOfSubValues[$subValues[$b]];
                  echo $noOfSubResponses;
                }

                for ($c=0; $c < count($subValues); $c++)
                {
                  echo "banana" . $countOfSubValues[$subValues[$c]];
                  $percentage = round(($countOfSubValues[$subValues[$c]] / $noOfSubResponses) * 100);
                  echo "dragon fruit" . $percentage;
                  echo '<div class="bar" style="--bar-value:' . $percentage . '%;" data-name="'. $subValues[$c] . '" title="' . $subValues[$c] . ': ' . $countOfSubValues[$subValues[$c]] . '"></div>';
                }
                echo '</div>
              </div>';

              }



            }
          }
        }
        else
        {
          echo "<h2> No results yet... </h2>";
        }

       ?>

    </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
