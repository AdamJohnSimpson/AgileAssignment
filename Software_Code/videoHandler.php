<?php
//===========================================================================================================================================
// Code to upload and store a file adapted from the following stack overflow page:
// https://stackoverflow.com/questions/18217964/upload-video-files-via-php-and-save-them-in-appropriate-folder-and-have-a-databa/18219669
//===========================================================================================================================================
$allowedExts = array("mp4", "mov", "wmv", "avi");
//

$extension = end(explode(".", $_FILES["file"]["name"]));

$test = $_POST['experiments'];
echo "experiment name: " . $test;

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "video/mov")
|| ($_FILES["file"]["type"] == "video/wmv")
|| ($_FILES["file"]["type"] == "video/avi"))
// Limiting video upload to 50 MB
&& ($_FILES["file"]["size"] < 131072000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>
