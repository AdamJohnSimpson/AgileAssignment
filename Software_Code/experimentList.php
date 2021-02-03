<?php
  session_start();
  //checks if user logged in, if not returns to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("location: login.php");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>List of experiments</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="https://www.dundee.ac.uk/themes/custom/uod/assets/favicons/favicon.ico"/>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <header style="height:150px;">
      <a href="Includes/redirect.inc.php"><img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left"></a>
      <button onclick="location.href='Includes/logout.inc.php';" type='button' class='btn btn-secondary' style="float: right; margin:20px">Logout</button>

    </header>

      <div class="jumbotron text-center">
        <h1 class="text-center">List of experiments</h1>
      </div>
    <div class="container-fluid" style="padding:0">
      <div class="jumbotron" style="margin-bottom:1px;">

        <?php
        include "Includes/db.inc.php";

        if(ISSET($_SESSION['USER_role']) && $_SESSION['USER_role'] != 'Co-Researcher'){
          echo "<div class='row'>
                  <div class='card-body'>
                    <a href='experimentCreate.php'> <button class='btn btn-outline-success' type='button'>Create new experiment</button> </a>
                  </div>
                </div>";
        }

        if(isset($_GET['i']) && isset($_GET['n']) && isset($_GET['r']))
          {
            func($_GET['i'], $_GET['n'], $_GET['r']);
          }
          //displays an error if user cannot connect to database
          if (!$conn) {
            die('Could not connect: ' . mysqli_error());
          }
          //retrieve all experiments tied to the user
          // $sql = "SELECT * FROM experiments WHERE primaryresearcher = ".$_SESSION['id'];
          $userID = $_SESSION['id'];
          if ($_SESSION['USER_role'] == 'Lab Manager'){
            $sql = "SELECT * FROM experiments ORDER BY experimentid DESC";
            $result = mysqli_query($conn, $sql);
          }
          else if ($_SESSION['USER_role'] == 'Principal Researcher'){
            $sql = "SELECT * FROM experiments WHERE primaryresearcher = {$userID} ORDER BY experimentid DESC";
            $result = mysqli_query($conn, $sql);
          }else{
            $sql = "SELECT * FROM experiments WHERE experimentid IN (SELECT experimentid FROM coexperiments WHERE UserID = {$userID})";
            $result = mysqli_query($conn, $sql);
          }
          //displays all experiments fetched along with an option to create a questionnaire
          while($row = mysqli_fetch_array($result)){
            $experimentid = $row['experimentid'];
            $experimentname = $row['experimentname'];
            echo "<div class='row'>
              <div class='card-body'>
              <h5 class='card-text mt-2'>".$row['experimentname']."</h5>
              <button onClick='location.href=\"".$_SERVER['PHP_SELF']."?i=".$experimentid."&n=".$experimentname."&r=info\"' class='btn btn-outline-success' type='button'>Experiment Information</button>
              <button onClick='location.href=\"".$_SERVER['PHP_SELF']."?i=".$experimentid."&n=".$experimentname."&r=quest\"' class='btn btn-outline-success' type='button'>Create questionnaire</button>
              <button onClick='location.href=\"".$_SERVER['PHP_SELF']."?i=".$experimentid."&n=".$experimentname."&r=video\"' class='btn btn-outline-success' type='button'>Upload video</button>
             </div>
           </div>";
         }
         function func($eid, $ename, $r)
         {
           echo "<h1> Im also in here $eid $ename $r</h1>";
           $_SESSION['experimentID'] = $eid;
           $_SESSION['experimentName'] = $ename;
           if ($r== "info") {
             header("Location:experimentInformation.php");
             exit();
           }
           else if ($r === "quest") {
             header("Location:makeQuestionnaires.php");
             exit();
           }
           else if ($r === "video") {
             header("Location:uploadVideo.php");
             exit();
           }
         }
         //closes the connection to the database
         mysqli_close($conn);
        ?>


        </div>
      </div>
      <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
      </footer>
  </body>
</html>
