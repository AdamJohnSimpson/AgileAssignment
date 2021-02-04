<?php
include "Includes/db.inc.php";
include 'Includes/header.php';

$videoPath = $_GET['id'];
$newTrans = $_POST['transcript'];

  //checks if button has been submitted
  if(isset($_POST['editTrans']) && $_POST['editTrans'] = "Update Transcript")
    {

      echo "Transcript: ".$newTrans."<br>";
      if (empty($newTrans)) {
        echo "The video must have a transcript!";
      }
      else {
        //send to db sql here
        //echo "Transcript: ".$newTrans."<br>";
        //echo "Address: ".$videoPath."<br>";
        $sql = "UPDATE videos SET transcript='{$newTrans}' WHERE videoAddress='{$videoPath}'";
        if ($conn->query($sql) === TRUE) {
          echo "New transcript added successfully!";
        }
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
   }


if(isset($_POST['editDesc'])){

  $newInfo = $_POST['descinfo'];
  if (empty($newInfo)) {
    echo "The video must have a description!";
  } else {
  //send to db sql here
  $sql = "UPDATE videos SET videoDescription='{$newInfo}' WHERE videoAddress='{$videoPath}'";
  if ($conn->query($sql) === TRUE) {
    echo "New description added successfully!";
  }
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Video Editor</title> <!-- Bootstrap CSS -->
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
    <h1 class="text-center">Edit Video</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
      <form>
      <label>Please enter the description below.</label>
      </form>
      <form method="POST">
          <input type="text" name="descinfo">
          <input type="submit" class='btn btn-outline-success' value="Update Description" name="editDesc">
      </form>
      <div class="form-group">
        <form method="POST">
          <div class="form-group">
            <form>
              <label>Please enter the transcript below.</label>
            </form>
            <br></br>
            <textarea name="transcript" cols="40" rows="5"></textarea>
            <br>
            <input type="submit" value="Update Transcript" name="editTrans" class='btn btn-outline-success'>
          </form>
        </div>
        <?php
        $address = "individualVideo.php?p={$videoPath}";
        echo "<br><br> <a href='{$address}'> <button class='btn btn-outline-success' type='button'>Return to video</button> </a>"
        ?>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
