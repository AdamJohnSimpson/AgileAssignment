<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Videos</title <!-- Bootstrap CSS -->
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
    <h1 class="text-center">Experiment [X] Videos</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron text-center" style="margin-bottom:1px;">

      <?php
        // $experiment = $_SESSION['experimentid'];
        $experiment = "1";
        $allVideos = scandir("videos/" . $experiment . "/");

        if (($key = array_search('.', $allVideos)) !== false) {
          unset($allVideos[$key]);
        }
        if (($key = array_search('..', $allVideos)) !== false) {
          unset($allVideos[$key]);
        }

        echo getcwd();

        for ($x=0; $x < count($allVideos); $x++) {
          $path = "videos/" . $experiment . "/" . $allVideos[$x];
          echo $path;
            echo "
            <br>
            <video src='" . $path . "' width='320' height='240' type='video/mp4' controls autoplay>
              Your browser does not support the video tag.
            </video>
            <br><br>";
        }

       ?>
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
