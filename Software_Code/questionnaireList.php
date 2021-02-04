<?php include 'includes/header.php'?>
<?php
//checks if user logged in, if not returns to login page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//   header("location: login.php");
//   exit;
// }
$tempURL = "https://team4agileassignment.azurewebsites.net/Questionnaire.php?qid=";
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>List of questionnaires for </title>
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
        <?php echo "<h1 class='text-center'>List of questionnaires for ".$_SESSION['experimentName']."</h1>"; ?>
      </div>
    <div class="container-fluid" style="padding:0">
      <div class="jumbotron" style="margin-bottom:1px;">
        <?php
        if (isset($_GET['c'])) {
            echo "<div class='alert alert-success' role='alert'>
              Experiment successfully created.
              </div>";
        }

        include "Includes/db.inc.php";
        echo "<div class='row'>
                <div class='card-body'>
                  <a href='makeQuestionnaires.php'> <button class='btn btn-outline-success' type='button'>Create new questionnaire</button> </a>
                </div>
              </div>";

        //displays an error if user cannot connect to database
         if (!$conn) {
          die('Could not connect: ' . mysqli_error());
        }

        //retrieve all experiments tied to the user
        // $sql = "SELECT * FROM experiments WHERE primaryresearcher = ".$_SESSION['id'];
        $experimentid = $_SESSION['experimentID'];
        $sql = "SELECT * FROM questionnaires WHERE experimentID = '$experimentid' ORDER BY questionnaireID DESC";
        $result = mysqli_query($conn, $sql);

        //displays all experiments fetched along with an option to create a questionnaire
        while($row = mysqli_fetch_array($result)){

          $questionnaireID = $row['questionnaireID'];
          $questionnaireName = $row['questionnaireName'];
           echo "<div class='row'>
             <div class='card-body'>";
             $questionnaireURL = $tempURL.$questionnaireID;
             echo "<h5 class='card-text mt-2'>".$questionnaireName." <button class='btn btn-success' onclick='myFunction(\"".$tempURL.$questionnaireID."\")'>Copy Link</button></h5>

              <br>
              <a href='https://team4agileassignment.azurewebsites.net/viewQuestionnaireResults.php?qid={$questionnaireID}'> <button class='btn btn-outline-success' type='button'>View Results</button> </a>
              <a href='https://team4agileassignment.azurewebsites.net/downloadResults.php?qid={$questionnaireID}'> <button class='btn btn-outline-success' type='button'>Dowload Results</button> </a>
              <a href='https://team4agileassignment.azurewebsites.net/responseList.php?qid={$questionnaireID}'><button class='btn btn-outline-success' type='button'>Individual Results</button></a>
             </div>
           </div>";
        }
        echo "<div class='row'>
                <div class='card-body'>
                  <a href='experimentInformation.php'> <button class='btn btn-outline-success' type='button'>Back to Experiment Information</button> </a>
                </div>
              </div>";
        // if(isset($_GET['i']) && isset($_GET['n']) && isset($_GET['r']))
        // {
        //     func($_GET['i'], $_GET['n'], $_GET['r']);
        // }
        // function func($experimentid, $experimentname, $reason)
        // {
        //   $_SESSION['experimentID'] = $experimentid;
        //   $_SESSION['experimentName'] = $experimentname;
        //   if ($reason == "info") {
        //     header("Location:experimentInformation.php");
        //   }
        //   else if ($reason === "quest") {
        //     header("Location:makeQuestionnaires.php");
        //   }
        //   else if ($reason === "video") {
        //     header("Location:uploadVideo.php");
        //   }
        //   exit();
        // }
        //closes the connection to the database
        mysqli_close($conn);

        ?>


        </div>
      </div>

      <script>
        function myFunction(str) {
          // https://www.30secondsofcode.org/blog/s/copy-text-to-clipboard-with-javascript
          const el = document.createElement('textarea');
          el.value = str;
          document.body.appendChild(el);
          el.select();
          document.execCommand('copy');
          document.body.removeChild(el);
        }
      </script>
      <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
      </footer>
  </body>
</html>
