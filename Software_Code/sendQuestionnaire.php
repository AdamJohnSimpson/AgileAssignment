<<?php

include "Includes/db.inc.php";




//researcher requires to send link of the questionnaire page to someone
//get the qestinoaire ID

if(isset($_POST['addParticipant'])){
  $questiontext = $_POST['participantsEmail'];
if (empty($questiontext)) {
    echo "You must enter a participants email.";
}

if(isset($_POST['quit'])) {
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
         <h1 class="text-center">Add a Participants email</h1>
       </div>
     <div class="container-fluid" style="padding:0">
       <div class="jumbotron" style="margin-bottom:1px;">

           <form method="POST">
             <div class="form-group">
               <label>Add an email of the person you would like to recieve this questionnaire. </label>
               <input type="text" name="participantsEmail"><br><br>
               <input type="submit" value="Adding participants email" name="addParticipant">
               <input type="submit" value="quit" name="quit">
           </form>
           <br></br>
         </div>
       </div>
   </body>
 </html>
