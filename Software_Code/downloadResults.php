<?php
session_start();

// Database Connection
include "Includes/db.inc.php";
$questionnaireID = $_GET['qid'];

$questionQuery = "SELECT questionID, questionText FROM questions WHERE questionnaireID = '$questionnaireID'";

$questionResult = mysqli_query($conn, $questionQuery);

$listOfQuestionText = array();
$listOfQuestionID = array();
$allResults = array();

if (mysqli_num_rows($questionResult) > 0) {
    while ($row = mysqli_fetch_array($questionResult)) {
      array_push($listOfQuestionText, $row['questionText']);
      array_push($listOfQuestionID, $row['questionID']);
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

}

for ($x=0; $x < count($listOfQuestionText); $x++) {
  echo "<br><br>=========================================================";
  echo "<br><br>Question: {$listOfQuestionText[$x]}";
  echo "<br><br>Results: ";
  print_r($allResults[$x]);

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
