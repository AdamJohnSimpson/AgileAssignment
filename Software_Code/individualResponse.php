<?php
//ensure logged in code go here

include 'Includes/header.php';
require_once "Includes/db.inc.php";
$questionnaireID = $_GET['qid']; //get questionnaireID
//$questionnaireID = "601811e5978fd"; //hard coded until page is finished and can be linked
$responseID = $_GET['rid']; //get responseID
//$responseID = "60181209f21d8"; //hard coded until page is finished and can be linked
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
    <a href="Includes/redirect.inc.php"><img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left"></a>
    <button onclick="location.href='Includes/logout.inc.php';" type='button' class='btn btn-secondary' style="float: right; margin:20px">Logout</button>
  </header>

  <div class="jumbotron text-center">
    <h1 class="text-center">Individual Responses</h1>
    <?php
    $stmt = "SELECT * FROM questionnaires WHERE questionnaireID = '{$questionnaireID}'";
    $resultQuestionnaire = mysqli_query($conn, $stmt);
    while($row = mysqli_fetch_array($resultQuestionnaire)){
      $questionnaireName = $row['questionnaireName'];
    }
    echo "<h3 class='text-center'>".$questionnaireName."</h3>";
    ?>
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
        $questionType = $row['questionType'];
        /*
        Question type
        1 - text-based
        2 - single choice
        3 - checkbox/multi choice
        4 - scale
        */
         echo "<div class='row'>
           <div class='card-body'>";
            if($questionType!="4"){ //if the question is text based or multiple choice or single choice
              echo "<h5 class='card-text mt-2'>".$questionTxt."</h5>";
              $stmt = "SELECT * FROM results WHERE questionID = '{$questionID}' AND responseID = '{$responseID}'"; //get the response for the question it is on
              $resultResponse = mysqli_query($conn, $stmt);
              if($questionType==3){ //if the question is a checkbox question
                echo "<p><strong>Participent Response(s): </strong></p>";
                while($row = mysqli_fetch_array($resultResponse)){//display the answers from the response
                  $response = $row['response'];
                  echo "<p> - ".$response."</p>";
                }//close while
              }//close nested if
                else{ // if the question is textbased or single choice
                  while($row = mysqli_fetch_array($resultResponse)){
                    $response = $row['response'];
                    echo "<p><strong>Participent Response: </strong>".$response."</p>"; //display result
                }//close while
              }//close nested else
            } //closes if
              else{ //question to display is a usabiltiy scale question
                echo"yay i got here";
                echo $responseID;

                echo "<h5 class='card-text mt-2'>"."Title: ".$questionTxt."</h5>"; //this echos the 'title question' which is stupid

                $stmt = "SELECT * FROM usabilityquestions WHERE uqText = $questionID"; //gets the question id to get all sub questions for the usability scale which is stupid
                $subQuestionsQuery = mysqli_query($conn, $stmt);
                while($row = mysqli_fetch_array($subQuestionsQuery)){
                  echo "yay i got here too";
                  $subQuestionText = $row['uqText'];
                  $subQuestionID = $row['uqID'];
                  echo "<h5 class='card-text mt-2'>"."Sub Question: ".$subQuestionText."</h5>"; //displays the sub question which is stupid
                  $stmt = "SELECT * FROM usabilityresults WHERE uqID = $subQuestionID AND responseID = $resposneID"; //gets the response for this sub question which is stupid
                  $subQuestionResponseQuery = mysqli_query($conn, $stmt);
                  while($row = mysqli_fetch_array($subQuestionsQuery)){
                    $subQuestionResponse = $row['response'];
                    echo "<p>Response: "."$subQuestionResponse"."</p>";
                  }//close while
                }//close while
              }//close else
        echo "</div>
         </div>";
      } //close first while
      echo "<a href='https://team4agileassignment.azurewebsites.net/responseList.php?qid={$questionnaireID}'><button class='btn btn-outline-success' type='button'>Back To Individual Results</button></a>";
      ?>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
