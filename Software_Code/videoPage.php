<?php
include 'Includes/header.php';
$experimentID = $_SESSION['experimentID'];
$experimentName = $_SESSION['experimentName'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Videos</title> <!-- Bootstrap CSS -->
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
    <?php echo "<h1 class='text-center'>{$experimentName} Videos</h1>"; ?>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron text-center" style="margin-bottom:1px;">

      <?php
        $allVideos = scandir("videos/" . $experimentID . "/");

        if (($key = array_search('.', $allVideos)) !== false) {
          array_shift($allVideos);
        }
        if (($key = array_search('..', $allVideos)) !== false) {
          array_shift($allVideos);
        }

        for ($x=0; $x < count($allVideos); $x++) {
          $path = "videos/" . $experimentID . "/" . $allVideos[$x];
          echo "<h3>" . $allVideos[$x] . "</h3>";
            echo "
            <br>
            <video id='".$allVideos[$x]."' src='" . $path . "' width='320' height='240' type='video/mp4' controls>
              Your browser does not support the video tag.
            </video>";
            $address = "individualVideo.php?p={$path}";
            echo "<br><br> <a href='{$address}'> <button class='btn btn-outline-success' type='button'>View video information</button> </a>
            <br><br>";
        }
        /*
        Php which takes user to the Timestamp
        using echo stuff similar to above
        */
       ?>
       <!-- PLAY/PAUSE VIDEOS IN SYNC -->
       <?php
       echo "
       <script>
       var videoArray = ".json_encode($allVideos).";
       var videoCount = videoArray.length;
       function playAll() {
         var i;
         for (i=0; i < videoCount; i++) {
           let vid = document.getElementById(videoArray[i]);
           vid.play();
         }
       }
       function pauseAll(){
         var i;
         for (i=0; i < videoCount; i++) {
           let vid = document.getElementById(videoArray[i]);
           vid.pause();
         }
       }
       </script>";
       ?>
       <button onclick="playAll()" type="button">Play All</button>
       <button onclick="pauseAll()" type="button">Pause All</button><br>

       <div class="jumbotron text-center">
         <h2 class="text-centre">Timestamp 1</h2>
         <p>This is the description for timestamp 1</p>
       </div>
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
       <br><br>
       <form action="experimentInformation.php">
           <input class='btn btn-outline-success' type="submit" value="Return to experiment page" style="float: left; margin:20px"/>
       </form>
    </div>
  </div>


  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
