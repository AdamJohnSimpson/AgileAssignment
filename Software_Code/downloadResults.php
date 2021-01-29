<?php
session_start();

// Database Connection
require_once "Includes/db.inc.php";

// get Users
$query = "SELECT * FROM results";
if (!$result = mysqli_query($conn, $query)) {
    exit(mysqli_error($conn));
}

$listOfResults = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $listOfResults[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=questionnaireResults.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('resultID', 'response', 'questionID', 'responseID'));

if (count($listOfResults) > 0) {
    foreach ($listOfResults as $row) {
        fputcsv($output, $row);
    }
}

?>
