<?php
//===========================================================================================================================================
// Code to upload and store a file adapted from the following stack overflow page:
// https://stackoverflow.com/questions/18217964/upload-video-files-via-php-and-save-them-in-appropriate-folder-and-have-a-databa/18219669
//===========================================================================================================================================

if(isset($_POST['submit'])){
  $test = $_POST['experiments'];
} else {
  echo "no worky";
}

echo "<br><br>experiment name: " . $test;

// define allowed file types in an array
$allowedTypes = array(
    'image/png',
    'image/jpeg',
    'image/jpg',
    'image/gif',
    'video/mp4'
);

// define allowed file extensions in array
$allowedExt = array("png", "jpeg", "jpg", "gif", "mp4");

// define max file size to be uploaded (this needs to be in bytes)
$maxFileSize = 131072000;  // 100KB max file size (100 * 1024) theres 1024 bytes in 1KB

// check that form has been submitted
if(isset($_POST['submit']) && is_array($_FILES))
{
    // get the file type
    $fileType = $_FILES['file']['type'];

    // get the file extension using pathinfo function
    $fileExt  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    // get fileSize
    $fileSize = $_FILES['file']['size'];

    // check that
    // - fileType is in allowTypes array,
    // - fileExt is in allowedExt array and
    // - fileSize is not bigger than maxFileSize
    if(in_array($fileType, $allowedTypes) && in_array($fileExt, $allowedExt) && ($fileSize < $maxFileSize))
    {
        if($_FILES['file']['error'] > 0)
        {
            echo "Error" . $_FILES["file"]["error"];
        }
        else
        {
            move_uploaded_file(($_FILES["file"]["tmp_name"]),"upload/".$_FILES['file']['name']);
            echo "Your upload was successful";
        }
    }
    else
    {
        echo 'problem';
    }
}
























//
//
// $allowedExts = array("mp4", "mov", "wmv", "avi", "jpg");
// //
//
// $extension = end(explode(".", $_FILES["file"]["name"]));
//
// if ($_FILES["file"]["error"] === 0) {
//   echo "filed upload...";
// }
//
// if(isset($_POST['submit'])){
//   $test = $_POST['experiments'];
// } else {
//   echo "no worky";
// }
// // $test = $_POST['experiments'];
//
//
// echo "<br><br>experiment name: " . $test;
//
//
// if ((($_FILES["file"]["type"] == "video/mp4")
// || ($_FILES["file"]["type"] == "image/jpeg")
// || ($_FILES["file"]["type"] == "video/mov")
// || ($_FILES["file"]["type"] == "video/wmv")
// || ($_FILES["file"]["type"] == "video/avi"))
// // Limiting video upload to 50 MB
// && ($_FILES["file"]["size"] < 131072000)
// && in_array($extension, $allowedExts))
//   {
//   if ($_FILES["file"]["error"] > 0)
//     {
//     echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
//     }
//   else
//     {
//     echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//     echo "Type: " . $_FILES["file"]["type"] . "<br />";
//     echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//     echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
//
//     if (file_exists("upload/" . $_FILES["file"]["name"]))
//       {
//       echo $_FILES["file"]["name"] . " already exists. ";
//       }
//     else
//       {
//       move_uploaded_file($_FILES["file"]["tmp_name"],
//       "upload/" . $_FILES["file"]["name"]);
//       echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
//       }
//     }
//   }
// else
//   {
//   echo "<br><br>Invalid file";
//   }
?>
