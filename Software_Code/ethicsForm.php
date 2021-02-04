<?php
session_start();
//have questionaire.php rediret user if consent = false
//have this be a consent form and when check box is checked then redirect back to questionaire with seesion variable consent set to true


$qID = $_GET['qid'];

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(ISSET($_POST['ethicsBox']) && $_POST['ethicsBox'] = "Yes")
    {
      echo "ticked";
      $_SESSION['ethicsCheck'] = true;
      header('location: Questionnaire.php?qid=' . $qID);
    }
  if (!ISSET($_POST['ethicsBox']))
    {
      echo "not ticked";
      $_SESSION['ethicsCheck'] = false;
      header('location: thanksForTime.php');
    }
  }




?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Ethics Form</title> <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header style="height:150px;">
    <a href="Includes/redirect.inc.php"><img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left"></a>

  </header>


  <div class="jumbotron text-center">
    <h1 class="text-center">Ethics Form</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">

      <form>
        <div class="form-group">
          <label>Please tick to give permission to the use of your answers for research purposes.</label>
      </form>

      <br></br>

      <form method=POST>
        <div class="form-check">
          <input style="width: 50px; height: 50px;" type="checkbox" name="ethicsBox" value="Yes">
        </div>
        <div class="form-check">
          <label>Submit to be redirected to the quiz if you have ticked the checkbox.</label>
          <input type="submit" class="btn btn-primary" value="submit">
        </div>
      </form>
    </div>
  </div>
</div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
