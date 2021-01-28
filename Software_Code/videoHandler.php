<?php
//===========================================================================================================================================
// Code to upload and store a file adapted from the following page:
// https://forums.phpfreaks.com/topic/282415-need-clarification-on-why-no-error-message/
//===========================================================================================================================================

$experimentid = $_SESSION['experimentID'];
echo "<br><br>experiment id: " . $experimentid;

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
$maxFileSize = 131072000;  // 125MB Max

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
            move_uploaded_file(($_FILES["file"]["tmp_name"]),"videos/". $experimentid . "/" . $_FILES['file']['name']);
            echo "<br><br>Your upload was successful";
        }
    }
    else
    {
        echo '<br><br>There was an error uploading your file...';
    }
}

?>
