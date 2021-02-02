<?php include 'includes/header.php';
      include "Includes/db.inc.php";
      ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Template</title> <!-- Bootstrap CSS -->
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
    <h1 class="text-center">Video Upload</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
      <?php
      //===========================================================================================================================================
      // Code to upload and store a file adapted from the following page:
      // https://forums.phpfreaks.com/topic/282415-need-clarification-on-why-no-error-message/
      //===========================================================================================================================================
      $experimentid = $_SESSION['experimentID'];

      // define allowed file types in an array
      $allowedTypes = array(
          'video/mp4'
      );

      // define allowed file extensions in array
      $allowedExt = array("mp4");

      // define max file size to be uploaded (this needs to be in bytes)
      $maxFileSize = 131072000;  // 125MB Max

      // check that form has been submitted
      if(isset($_POST['submit']) && is_array($_FILES))
      {
          // get the file type--
          $fileType = $_FILES['file']['type'];

          // get the file extension using pathinfo function
          $fileExt  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

          // get fileSize
          $fileSize = $_FILES['file']['size'];

          // check that
          // - fileType is in allowTypes array,
          // - fileExt is in allowedExt array and
          // - fileSize is not bigger than maxFileSize
          if(in_array($fileType, $allowedTypes) && in_array($fileExt, $allowedExt) && ($fileSize < $maxFileSize))
          {
              if($_FILES['file']['error'] > 0)
              {
                  echo "<h3>Error" . $_FILES["file"]["error"] . "</h3>";
              }
              else
              {
                  move_uploaded_file(($_FILES["file"]["tmp_name"]),"videos/". $experimentid . "/" . $_FILES['file']['name']);
                  echo "<br><br><h3>Your upload was successful.</h3>";
                  $sql = "INSERT INTO videos(videoDescription, experimentID) VALUES ('Default video description', '$experimentid')";
                  if ($conn->query($sql) === TRUE) {
                    echo "Successfully added to database";
                  }
                  else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
              }
          }
          else
          {
              echo '<br><br><h3>There was an error uploading your file...</h3>';
          }
      }

      if(isset($_POST['logout'])) {
        unset($_SESSION['loggedin']);
        header("location: login.php");
      }
      ?>
      <br><br>
      <a href="experimentList.php"> <button class='btn btn-outline-success' type='button'>Return to experiments</button> </a>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
