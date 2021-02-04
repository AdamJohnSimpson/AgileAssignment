<?php
include 'Includes/header.php';
include "Includes/db.inc.php";
$experimentID = $_SESSION['experimentID'];
$experimentName = $_SESSION['experimentName'];

$videoPath = $_GET['p'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Video Info</title> <!-- Bootstrap CSS -->
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
    <h1 class='text-center'>Video</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron text-center" style="margin-bottom:1px;">

      <?php
        //get information from experiment list page to display the selected experiment
        $query = "SELECT * FROM videos WHERE videoAddress= '$videoPath'";
        $result = mysqli_query($conn, $query);
        // foreach( $result as $row ) {
        while($row = mysqli_fetch_array($result)){
          $vidID = $row['videoID'];
          $vidDesc = $row['videoDescription'];
          $vidTrans = $row['transcript'];
          $transcript = nl2br($vidTrans);
          echo "<br> I am in the while loop <br>";
        }
        echo "<video id='".$vidID."' src='".$videoPath."' width='750' height='500' type='video/mp4' controls>
              Your browser does not support the video tag.
              </video> <br>
              <p> <b>Video Description: </b> </p> <br>".$vidDesc."<br><br>
              <p> <b>Video Transription: </b> </p> <br>".$transcript." <br> <br>";
              $address = "videoEdit.php?id={$videoPath}";
              echo "<br><br> <a href='{$address}'> <button class='btn btn-outline-success' type='button'>Edit Video Details</button> </a> <br>";


       echo "<div class='jumbotron text-center'>
         <h2 class='text-centre'>Timestamps</h2>
         <p>This is the description for timestamp 1</p>";
          $addressTime = "timestamps.php?id={$videoPath}";
          echo "<br><br> <a href='{$addressTime}'>  <button class='btn btn-outline-success' type='button'>Add Timestamps</button> </a> <br>
       </div>"
       ?>
       <!--
       <form>
         <input type="button" class="btn btn-primary" onclick="timestamp()" value="Go to Timestamp 1" name="Timestamp1" id="btn">
         <script>
         var video = document.getElementById('vid');
         var btn = document.getElementById('btn');
         //might need to put this script in the php stuff to work?
         //as well as the html associated with this?
         function timestamp() {
           //go to 3 seconds in the video -> this would probably need to be in the php
           video.pause(); //pause the video
         }
         </script>
       </form>
     -->
       <br></br>
    </div>
  </div>

  <form action="https://agile-assignment-group-4.azurewebsites.net/experimentInformation.php">
      <input type="submit" value="Return to Experiments Information" />
  </form>
  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
