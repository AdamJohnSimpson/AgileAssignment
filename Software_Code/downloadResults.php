<?php
session_start();

// Database Connection
include "Includes/db.inc.php";
$questionnaireID = $_GET['qid'];

$questionQuery = "SELECT questionID, questionText, questionType FROM questions WHERE questionnaireID = '$questionnaireID'";

$questionResult = mysqli_query($conn, $questionQuery);

$listOfQuestionText = array();
$listOfQuestionID = array();
$allResults = array();
$allResultID = array();

$listOfUsabilityText = array();
$listOfUsabilityID = array();

if (mysqli_num_rows($questionResult) > 0) {
    while ($row = mysqli_fetch_array($questionResult)) {
      if($row['questionType'] != 4){
        array_push($listOfQuestionText, $row['questionText']);
        array_push($listOfQuestionID, $row['questionID']);
      }else{
        $questionID = $row['questionID'];
        $newQuery = "SELECT * FROM usabilityquestions WHERE questionid = '$questionID'";
        $newResult = mysqli_query($conn, $newQuery);

        while ($row = mysqli_fetch_array($newResult)) {
          array_push($listOfUsabilityText, $row['uqText']);
          array_push($listOfUsabilityID, $row['uqID']);
        }
      }
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

for ($x=0; $x < count($listOfUsabilityText) ; $x++) {
  $listOfResponses = array();
  $listOfResultID = array();
  $tempqid = $listOfUsabilityID[$x];
  $responseQuery = "SELECT * FROM usabilityresults WHERE uqID='$tempqid'";

  $responseResults = mysqli_query($conn, $responseQuery);

  if (mysqli_num_rows($responseResults) > 0) {
      while ($row = mysqli_fetch_array($responseResults)) {
        array_push($listOfResponses, $row['response']);
        array_push($listOfResultID, $row['urID']);
      }
  }

  array_push($listOfQuestionText, $listOfUsabilityText[$x]);
  array_push($listOfQuestionText, $listOfUsabilityID[$x]);
  array_push($allResults, $listOfResponses);
  array_push($allResultID, $listOfResultID);

}


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.$questionnaireID.'_Results.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('questionID', 'questionText', 'responseID', 'response'));

if (count($listOfQuestionID) > 0) {
    for ($x=0; $x < count($listOfQuestionID); $x++) {
      for ($y=0; $y < count($allResults[$x]); $y++) {
        fputcsv($output, array($listOfQuestionID[$x], $listOfQuestionText[$x], $allResultID[$x][$y], $allResults[$x][$y]));
      }
    }
}

?>
