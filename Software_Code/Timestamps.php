<?php
include 'Includes/header.php';
include "Includes/db.inc.php";
$experimentID = $_SESSION['experimentID'];
$experimentName = $_SESSION['experimentName'];

if(isset($_POST['logout'])) {
  unset($_SESSION['loggedin']);
  header("location: login.php");
}
if(isset($_POST['addT'])){
  $timestampT = $_POST['timestampT'];
  $timestampnote = $_POST['note'];
  if (empty($timestampT)) {
    echo "The timestamp must have a time!";
  }
  else {

    //send to db sql here
    $sql = "INSERT INTO timestamps(timestampText, videoID, timestampTime) VALUES ($timestampnote, $vidID, $timestampT)";
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header("location: Timestamps.php");
    }}
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Timestamps</title> <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header style="height:150px;">
    <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left">
    <form method="POST">
      <input type="submit" value="Log Out" name="logout" style="float: right; margin:20px">
    </form>
  </header>

  <div class="jumbotron text-center">
    <h1 class='text-center'>Timestamps</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron text-center" style="margin-bottom:1px;">

      <?php

        $vidID = $_GET['id'];
        $query = "SELECT timestampTime, timestampText FROM timestamps WHERE videoID = {$vidID}";
        $result = mysqli_query($conn, $query);

        // foreach( $result as $row ) {
        while($row = mysqli_fetch_array($result)){
          $timestamptime = $row['timestampTime'];
          $timestamptext = $row['timestampText'];
          echo "<br> Timestamp time:".$timestamptime."<br>notes: ".$timestamptext."<br><br><br>";
        }

       ?>
       <form action="POST">
         <p> enter a time: </p><input type='text' name="timestampT">
         <p> enter a note: </p><input type='text' name="note">
         <input type="submit" value="Add timestamp" name="addT" class='btn btn-outline-success'>
       </form>
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
