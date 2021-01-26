<?php
//checks if user logged in, if not returns to login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>List of experiments</title
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px">
      <div class="jumbotron text-center">
        <h1 class="text-center">List of experiments</h1>
      </div>
    <div class="container-fluid" style="padding:0">
      <div class="jumbotron" style="margin-bottom:1px;">

        <?php
        include "Includes/db.inc.php";

        //displays an error if user cannot connect to database
         if (!$conn) {
          die('Could not connect: ' . mysql_error());
        }

        //retrieve all experiments tied to the user
        // $sql = "SELECT * FROM experiments WHERE primaryresearcher = ".$_SESSION['id'];
        $sql = "SELECT * FROM experiments WHERE primaryresearcher = 1";
        $result = mysqli_query($conn, $sql);

        //displays all experiments fetched along with an option to create a questionnaire
        while($row = mysqli_fetch_array($result)){

           echo "<div class='row'>
             <div class='card-body'>
               <h5 class='card-text mt-2'>".$row['experimentname']."</h6>
                 <button name='create_questionnaire' type='submit' class='btn btn-outline-success'>Create questionnaire</button>
             </div>
           </div>";

        }

        /*stores session information and directs user to the 'create questionnaire'
        page when they click the "Create Questionnaire" button*/
        if(isset($_POST["create_questionnaire"]))
           {
                   $_SESSION["experimentID"] = $row['experimentid'];
                   $_SESSION["experimentName"] = $row['experimentname'];
                   header("location:createQuestionnaires.php");
           }

        //closes the connection to the database
        mysqli_close($conn);

?>
        </div>
      </div>
  </body>
</html>
