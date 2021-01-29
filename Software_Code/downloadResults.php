<?php
session_start();

// Database Connection
require_once "Includes/db.inc.php";
$questionnaireID = $_GET['qid'];

echo $questionnaireID;

$questionQuery = "SELECT questionID, questionText FROM questions WHERE questionnaireID = {$questionnaireID}";
$questionResult = mysqli_query($conn, $questionQuery);
// if (!$questionResult = mysqli_query($conn, $query)) {
//     exit(mysqli_error($conn));
// }

$listOfQuestions = array();
$listOfResponses = array();
$bigBoiList = array();

if (mysqli_num_rows($questionResult) > 0) {
    while ($row = mysqli_fetch_assoc($questionResult)) {
        $listOfQuestions[] = $row;
        echo $row;
    }
}

print_r($listOfQuestions);

// $listOfQuestions = [questionID, questionText], [questionID, questionText], [questionID, questionText]
// [response1, response2, response3], [response1, response2, response3]



for ($x=0; $x < count($listOfQuestions) ; $i++) {
  $responseQuery = "SELECT response, resultID FROM results WHERE questionID={$listOfQuestions[$x][0]} GROUP BY questionID";

  if (!$responseQuery = mysqli_query($conn, $responseQuery)) {
      exit(mysqli_error($conn));
  }

  if (mysqli_num_rows($resultQuery) > 0) {
      while ($row = mysqli_fetch_assoc($responseQuery)) {
          $listOfResponses[] = $row;
      }
  }

  $bigBoiList[] = $listOfResponses;

}

print_r($bigBoiList);


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
