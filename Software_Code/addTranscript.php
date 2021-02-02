<?php

 $transcript = $_POST['transcript'];

if($_SERVER["REQUEST_METHOD"] === "POST"){

  if(isset($_POST['addT']))
    {
      echo "Transcript:  '$transcript'/>";
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Transcript</title> <!-- Bootstrap CSS -->
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
    <h1 class="text-center">Add a transcript</h1>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
      <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">> -->
        <div class="form-group">
          <label>Please enter the transcript below.</label>

      <form>
        <textarea name="transcript" cols="40" rows="5"></textarea>
      </form>
      <br></br>

      <form>
          <input type="submit" value="Submit" name="addT" class='btn btn-outline-success'>
      </form>
    <!-- </form> -->
    </div>
  </div>

  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
