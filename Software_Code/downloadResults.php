<?php
session_start();

// Database Connection
include "Includes/db.inc.php";
$questionnaireID = $_GET['qid'];

$questionQuery = "SELECT questionID, questionText FROM questions WHERE questionnaireID = '$questionnaireID'";

$questionResult = mysqli_query($conn, $questionQuery);

$listOfQuestionText = array();
$listOfQuestionID = array();
// $bigBoiList = array(array());
$allResults = array();

if (mysqli_num_rows($questionResult) > 0) {
    while ($row = mysqli_fetch_array($questionResult)) {
      array_push($listOfQuestionText, $row['questionText']);
      array_push($listOfQuestionID, $row['questionID']);
    }
}

echo "<br><br>";
print_r($listOfQuestionText);
echo "<br><br>";
print_r($listOfQuestionID);
echo "<br><br>";

for ($x=0; $x < count($listOfQuestionText) ; $x++) {
  $listOfResponses = array();
  $listOfResultID = array();
  $tempqid = $listOfQuestionID[$x];
  // echo $tempqid;
  $responseQuery = "SELECT response, resultID FROM results WHERE questionID='$tempqid'";
  // echo $responseQuery;

  $responseResults = mysqli_query($conn, $responseQuery);

  if (mysqli_num_rows($responseResults) > 0) {
      while ($row = mysqli_fetch_array($responseResults)) {
        array_push($listOfResponses, $row['response']);
        array_push($listOfResultID, $row['resultID']);
      }
  }

  echo "<br><br>";
  print_r($listOfResponses);
  echo "<br><br>";
  print_r($listOfResultID);
  echo "<br><br>";

  // array_push($bigBoiList[$x][0], $listOfQuestionText[$x]);
  // array_push($bigBoiList[$x][1], $listOfResponses);

  array_push($allResults, $listOfResults);



}

for ($x=0; $x < count($listOfQuestionText); $x++) {
  echo "=========================================================";
  echo "Question: {$listOfQuestionText} <br><br>";
  echo "Results: ";
  print_r($allResults);
  echo "=========================================================";

}

// header('Content-Type: text/csv; charset=utf-8');
// header('Content-Disposition: attachment; filename=questionnaireResults.csv');
// $output = fopen('php://output', 'w');
// fputcsv($output, array('resultID', 'response', 'questionID', 'responseID'));
//
// if (count($listOfResults) > 0) {
//     foreach ($listOfResults as $row) {
//         fputcsv($output, $row);
//     }
// }

?>
