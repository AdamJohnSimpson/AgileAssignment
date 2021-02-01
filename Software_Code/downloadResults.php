<?php
session_start();

// Database Connection
include "Includes/db.inc.php";
$questionnaireID = $_GET['qid'];

$questionQuery = "SELECT questionID, questionText FROM questions WHERE questionnaireID = '$questionnaireID'";

$questionResult = mysqli_query($conn, $questionQuery);

$listOfQuestions = array();
$listOfResponses = array();
$bigBoiList = array(array());

if (mysqli_num_rows($questionResult) > 0) {
    while ($row = mysqli_fetch_array($questionResult)) {
        $listOfQuestions[] = $row;
    }
}

// echo "<br><br>";
// print_r($listOfQuestions);
// echo "<br><br>";

for ($x=0; $x < count($listOfQuestions) ; $x++) {
  $listOfResponses = array();
  $tempqid = $listOfQuestions[$x][0];
  // echo $tempqid;
  $responseQuery = "SELECT response, resultID FROM results WHERE questionID='$tempqid'";
  // echo $responseQuery;

  $responseResults = mysqli_query($conn, $responseQuery);

  if (mysqli_num_rows($responseResults) > 0) {
      while ($row = mysqli_fetch_array($responseResults)) {
        array_push($listOfResponses, $row['response']);
          // $listOfResponses = $row['response'];
      }
  }

  echo "<br><br>";
  print_r($listOfResponses);
  echo "<br><br>";

  $bigBoiList[$x][0] = $questionText[$x];
  array_push($bigBoiList[$x][1], $listOfResponses);

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
