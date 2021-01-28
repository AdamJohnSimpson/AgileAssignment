<?php include "Includes/db.inc.php";?>
<?php

	session_start();

	if(!ISSET($_GET['qid'])){
		header('Location:../Includes/error.inc.php');
		exit();
  }
	
	$qID = $_GET['qid'];
	
	$query = "SELECT * FROM questionnaires WHERE questionnaireID = '$qID'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	if($row){
		$qName = $row['questionnaireName'];
	}else{
		header('Location:../Includes/error.inc.php');
		exit();
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(ISSET($_SESSION['TakePart']) && $_SESSION['TakePart'] == true){
      header('Location: ThankYou.php');
      exit();
    }else{
      $_SESSION['TakePart'] = false;
    }

		$responseID = uniqid($prefix="", $more_entropy=false);
		
		$query = "SELECT * FROM questions WHERE questionnaireID = '$qID'";
    $result = mysqli_query($conn, $query);
    $count = 0;
    while($row = mysqli_fetch_array($result)){
		  if(ISSET($_POST[$count]) && !empty($_POST[$count])){
        $questionID = $row['questionID'];

        $response = $_POST[$count];
        
        $newQuery = $conn->prepare("INSERT INTO results (response, questionID, responseID) VALUES (?, '$questionID', '$responseID')");
        $newQuery->bind_param('s', $response);
        $newQuery->execute();
		  }
      $count++;
    }

    $_SESSION['TakePart'] = false;
    header('Location: ThankYou.php');
    exit();
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
</head>

<body>
  <header>
    <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px">
  </header>

  <div class="jumbotron text-center">
    <h1 class="text-center"><?php echo $qName; ?></h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
      <form action="Questionnaire.php?qid=<?php echo $qID; ?>" method=POST>
        <?php
          	$query = "SELECT * FROM questions WHERE questionnaireID = '$qID'";
            $result = mysqli_query($conn, $query);
            $count = 0;
            while($row = mysqli_fetch_array($result)){
              echo '<div class="form-group">';
              echo '<label for="'.$count.'">'. $row['questionText'] . '</label>';
              echo '<input type = "text" name="'. $count . '" ><br><br>';
              echo '</div>';

              $count++;
            }
        ?>
        <div class="form-group">
          <input type="submit" value="Template button">
        </div>
      </form>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>