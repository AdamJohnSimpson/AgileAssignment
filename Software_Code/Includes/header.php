<?php
session_start();

if(isset($_POST['logout'])) {
  session_destroy();
  header("location: login.php");
}
echo '<link rel="shortcut icon" href="https://www.dundee.ac.uk/themes/custom/uod/assets/favicons/favicon.ico"/>';
?>
