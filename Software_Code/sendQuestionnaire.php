<?php
include "Includes/header.php";
include "Includes/db.inc.php";





$questionnaireURL = "https://agile-assignment-group-4.azurewebsites.net/Questionnaire.php?qid=";
$questionnaireURL = $questionnaireURL.$questionnaireID;



      mail($participantsEmail, $subject, $message);
      echo "email sent.";
  }



if(isset($_POST['quit'])) {
  header("location: experimentList.php");
  exit();
}

if(isset($_POST['logout'])) {
  unset($_SESSION['loggedin']);
  header("location: login.php");
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Sending Questionnaire</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
     <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
   </head>

   <header>
     <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px">
     <form method="POST">
       <input type="submit" value="Log Out" name="logout" style="float: left; padding:20px">
     </form>
   </header>

   <body>
     <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px">
       <div class="jumbotron text-center">
         <h1 class="text-center">Questionnaire Link</h1>
       </div>
     <div class="container-fluid" style="padding:0">
       <div class="jumbotron" style="margin-bottom:1px;">

           <form method="POST">
             <div class="form-group">
               <h4>The url for your questionnaire is:
                <?php echo $questionnaireURL; ?> </h4>
               <input type="submit" value="Copy Link" name="copyLink">
               <input type="submit" value="quit" name="quit">
           </form>
           <br></br>
         </div>
       </div>
   </body>
 </html>
