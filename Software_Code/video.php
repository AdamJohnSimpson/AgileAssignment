<!DOCTYPE html>
<html>
  <head>
    <title>Video Upload Test</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px">
    <div class="jumbotron text-center">
      <h1 class="text-center">Video Upload Test Page 1</h1>
    </div>

    <div class="container-fluid" style="padding:0">
      <div class="jumbotron" style="margin-bottom:1px;">

        <form action="videoHandler.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="131072000" />
        <label for="file"><span>Filename:</span></label>
        <input type="file" name="file"/>

          <?php
          include "Includes/db.inc.php";
          $query = "SELECT experimentid, experimentname FROM experiments";
          $result = mysqli_query($conn, $query);
          echo "</br>";
          echo "<label for='experiments'> Which experiment is this video part of?    </label>";
          echo "<select id='experiments' name='experiments'>";
          while($row = mysqli_fetch_array($result)){
            echo "<option value='" . $row['experimentname'] . "'> " . $row['experimentname'] . " (ID: " . $row['experimentid'] . ")</option>";
          }
          echo "</select>";
          ?>

        </select>
        <br>
        <input type="submit" name="submit" value="Submit" />
        </form>
      </div>
    </div>
  </body>

</html>
