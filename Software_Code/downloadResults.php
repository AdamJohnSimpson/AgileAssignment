<?php
session_start();

// Database Connection
include "Includes/db.inc.php";
$questionnaireID = $_GET['qid'];

$questionQuery = "SELECT questionID, questionText FROM questions WHERE questionnaireID = '$questionnaireID'";

$questionResult = mysqli_query($conn, $questionQuery);

$listOfQuestions = array();
$listOfResponses = array();
$bigBoiList = array();

if (mysqli_num_rows($questionResult) > 0) {
    while ($row = mysqli_fetch_array($questionResult)) {
        $listOfQuestions[] = $row;
    }
}

echo "<br><br>";
print_r($listOfQuestions);
echo "<br><br>";

for ($x=0; $x < count($listOfQuestions) ; $i++) {
  $tempqid = $listOfQuestions[$x][0];
  $responseQuery = "SELECT response, resultID FROM results WHERE questionID='$tempqid' GROUP BY questionID";

  $responseResults = mysqli_query($conn, $responseQuery);

  if (mysqli_num_rows($responseResults) > 0) {
      while ($row = mysqli_fetch_assoc($responseResults)) {
          $listOfResponses[] = $row;
      }
  }

  $bigBoiList[] = $listOfResponses;

}

echo "<br><br>";
print_r($bigBoiList);
echo "<br><br>";

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
