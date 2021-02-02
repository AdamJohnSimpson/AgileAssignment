<?php include "Includes/db.inc.php";?>
<?php

	session_start();

  // If no questionnaire ID was present, redirect the user
	if(!ISSET($_GET['qid'])){
		header('Location:../Includes/error.inc.php');
		exit();
  }

  $qID = $_GET['qid'];
  
  // Redirect the user if they haven't agreed to the ethics form
  if(!ISSET($_SESSION['ethicsCheck'])){
		header('Location: ethicsForm.php?qid=' . $qID);
		exit();
	}

  // Find the questionnaire in the database
	$query = "SELECT * FROM questionnaires WHERE questionnaireID = '$qID'";
	$result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);

  // If the questionnaire exists, store its name. If it doesn't, redirect the user
	if($row){
		$qName = $row['questionnaireName'];
	}else{
		header('Location:../Includes/error.inc.php');
		exit();
  }

  // If the user has already taken part and isn't logged in, redirect them
  if(ISSET($_SESSION['TakePart']) && $_SESSION['TakePart'] == true && !ISSET($_SESSION['USER_role'])){
    header('Location: ThankYou.php');
    exit();
  }else{
    $_SESSION['TakePart'] = false;
  }

	if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Generate an ID to uniquely identify the person that sent in these answers
		$responseID = uniqid($prefix="", $more_entropy=false);

    // Find all the questions in this questionnaire
		$query = "SELECT * FROM questions WHERE questionnaireID = '$qID'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){

      $questionID = $row['questionID'];

      // If the question uses check boxes
      if($row['questionType'] == 3){
        // Find all the options for the check box queston
        $newQuery = "SELECT * FROM questionOptions WHERE questionID = '$questionID'";
        $newResult = mysqli_query($conn, $newQuery);
        while($newRow = mysqli_fetch_array($newResult)){
          // If the user ticked this box, store the value in the results table
          if(ISSET($_POST[$newRow['optionID']]) && !empty($_POST[$newRow['optionID']])){
            $response = $_POST[$newRow['optionID']];

            $newQuery = $conn->prepare("INSERT INTO results (response, questionID, responseID, questionnaireID) VALUES (?, '$questionID', '$responseID', '$qID')");
            $newQuery->bind_param('s', $response);
            $newQuery->execute();
          }
        }
      }else if($row['questionType'] == 4){
        // Find all the sub questions for the usability scale question
        $newQuery = "SELECT * FROM usabilityQuestions WHERE questionID = '$questionID'";
        $newResult = mysqli_query($conn, $newQuery);
        while($newRow = mysqli_fetch_array($newResult)){
          // If the user answered this sub question, store their answer
          if(ISSET($_POST[$newRow['uqID']]) && !empty($_POST[$newRow['uqID']])){
            $response = $_POST[$newRow['uqID']];

            $uqID = $newRow['uqID'];

            // Store the value in the usabilityResults table
            $newQuery = $conn->prepare("INSERT INTO usabilityResults (response, uqID, responseID) VALUES (?, '$uqID', '$responseID')");
            $newQuery->bind_param('s', $response);
            $newQuery->execute();
          }
        }
      }
      // If the question doesn't use check boxes and has been answered
      else if(ISSET($_POST[$questionID]) && !empty($_POST[$questionID])){

        $response = $_POST[$questionID];

        // Store the value in the results table
        $newQuery = $conn->prepare("INSERT INTO results (response, questionID, responseID, questionnaireID) VALUES (?, '$questionID', '$responseID', '$qID')");
        $newQuery->bind_param('s', $response);
        $newQuery->execute();
		  }
    }

    $_SESSION['TakePart'] = true;
    header('Location: ThankYou.php');
    exit();
	}

	if(isset($_POST['logout'])) {
	  unset($_SESSION['loggedin']);
	  header("location: login.php");
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title><?php echo $qName; ?> </title> <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="https://www.dundee.ac.uk/themes/custom/uod/assets/favicons/favicon.ico"/>
</head>

<body>
	<header style="height:150px;">
    <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left">
  </header>

  <div class="jumbotron text-center">
    <h1 class="text-center"><?php echo $qName; ?></h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
      <form action="Questionnaire.php?qid=<?php echo $qID; ?>" method=POST>
        <?php

            // Find all the questions in this questionnaire
          	$query = "SELECT * FROM questions WHERE questionnaireID = '$qID'";
            $result = mysqli_query($conn, $query);
            $count = 1;
            // Loop through every question
            while($row = mysqli_fetch_array($result)){
              echo '<div class="form-group">';

              $questionID = $row['questionID'];
              $qType = $row['questionType'];

              // If the question is text based, show a text input box
              if($row['questionType'] == 1){
                echo '<label for="'.$questionID.'"><b>'. $count . ') ' . $row['questionText'] . '</b></label>';
                echo '<textarea class="form-control" name="'. $row['questionID'] . '" ></textarea>';
              }
              // If the question uses multiple choice or check boxes
              else if($qType == 2 || $qType == 3){
                if($qType == 2){
                  $inType = 'radio';
                }else if($qType == 3){
                  $inType = 'checkbox';
                }
                echo '<p><b>'. $count . ') ' . $row['questionText'] . '</b></p>';

                // Find all the options for the question
                $newQuery = "SELECT * FROM questionOptions WHERE questionID = '$questionID'";
                $newResult = mysqli_query($conn, $newQuery);
                // Loop through each option
                while($newRow = mysqli_fetch_array($newResult)){

                  if($qType == 2){
                    $nameTag = $questionID;
                  }else if($qType == 3){
                    $nameTag = $newRow['optionID'];
                  }

                  // Display the correct input button with appropriate values
                  echo '<div class="form-check">';
                  echo '<input class="form-check-input" type="'.$inType.'" id="'.$newRow['optionID'].'" name="'.$nameTag.'" value="'.$newRow['optionText'].'">';
                  echo '<label class="form-check-label" for="'.$newRow['optionID'].'">'.$newRow['optionText'].'</label><br>';
                  echo '</div>';
                }
              }else if($qType == 4){
                echo '<p><b>'. $count . ') ' . $row['questionText'] . '</b></p>';

                // Find all the options for the question
                $newQuery = "SELECT * FROM questionOptions WHERE questionID = '$questionID'";
                $newResult = mysqli_query($conn, $newQuery);

                // Store all the options inside an array
                $valueArray = array();
                while ($newRow = mysqli_fetch_array($newResult)) {
                  $valueArray[] = $newRow['optionText'];
                }

                // Find all the sub questions inside this usability question
                $newQuery = "SELECT * FROM UsabilityQuestions WHERE questionID = '$questionID'";
                $newResult = mysqli_query($conn, $newQuery);

                // Create a table
                echo '<table class="table">';
                echo '<tr>';
                echo '<th scope="col"></th>';
                // Put the options inside the top row of the table
                foreach ($valueArray as &$value) {
                  echo '<th scope="col" style="text-align:center">' . $value . '</th>';
                }
                echo '</tr>';

                // Loop through each sub question
                while($newRow = mysqli_fetch_array($newResult)){
                  echo '<tr>';
                  // Put the sub question at the start of a new row
                  echo '<td>' . $newRow['uqText'] . '</td>';

                  // Add radio buttons for each option
                  foreach ($valueArray as &$value) {
                    echo '<td style="text-align:center"><input class="form-check-input" type="radio" id="'.$value.'" name="'.$newRow['uqID'].'" value="'.$value.'"></td>';
                  }

                  echo '</tr>';
                }

                echo '</table>';

              }

              echo '</div>';
              echo '<br>';
              echo '<br>';

              $count++;
            }
        ?>
        <div class="form-group">
          <input type="submit" value="Submit" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
