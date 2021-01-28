<?php
include "Includes/header.php";
include "Includes/db.inc.php";

$subject = "Questionnaire";
$message = "test: www.google.com";
$headers = "From: https://agile-assignment-group-4.azurewebsites.net/" . phpversion();


//researcher requires to send link of the questionnaire page to someone
//get the qestinoaire ID
//if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST['sendQ'])){
    $participantsEmail = trim($_POST['participantsEmail']);

  if(empty(trim($_POST["participantsEmail"]))){
      echo "You must enter a participants email.";
  } else{

      mail($participantsEmail, $subject, $message);
  }



  // if (empty($participantsEmail)) {
  //     echo "You must enter a participants email.";
  //   }
  //   else{
  //        echo "<p> Participants email: ".$participantsEmail."</p>";
         //add code that sends the link to the persons email
    }


if(isset($_POST['quit'])) {
  header("location: experimentList.php");
  exit();
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

   <body>
     <img class="img-fluid" src="University-of-Dundee-logo.png" width="300px">
       <div class="jumbotron text-center">
         <h1 class="text-center">Send Questionnaires</h1>
       </div>
     <div class="container-fluid" style="padding:0">
       <div class="jumbotron" style="margin-bottom:1px;">
         <h2 class="text-center">You are sending the following questionnaire:
         <?php echo $_SESSION['questionnaireID']; ?></h2>

           <form method="POST">
             <div class="form-group">
               <label>Add an email of the person you would like to recieve this questionnaire. </label>
               <input type="text" name="participantsEmail"><br><br>
               <input type="submit" value="Send Questionnaire" name="sendQ">
               <input type="submit" value="quit" name="quit">
           </form>
           <br></br>
         </div>
       </div>
   </body>
 </html>
