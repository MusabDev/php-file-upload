<?php

/*
 * File Name: send.php
 * Description: This file is used to send the file to server.
 */

// Configurations
set_time_limit(0); // Set the time limit to 0 to avoid time out error
define("UPLOAD_DIR", "uploads/"); // Change this to your file uploading directory

// Checking if the form is submitted
if (isset($_POST) || isset($_FILES)) {
  // If user pasted url
  if (!empty($_POST["link"])) {
    // Remote uploading
    $remoteUpload = remoteUpload($_POST["link"]);
    // Show remote upload result (it can be the file size or false)
    echo $remoteUpload;
  } else {
    // Normal uploading
    // Getting form inputs
    $file = $_FILES["file"];
    // Uploading file throw a function that will return the uploaded file name
    loadUpload($file);
  }
} else {
  // Showing index.html file if $_POST or $_FILES are not set
  include './index.html';
  exit;
}


// Local uploading function
function loadUpload($file)
{
  $fileName = $file["name"]; // File name
  $fileTmp = $file["tmp_name"]; // Temporary file name
  // Adding current time stamps to the filename (So this should be unique and this way this will not replace any old file which has the same name)
  $newFileName = time() . "_" . $fileName;

  // Uploading file to the path
  move_uploaded_file($fileTmp, UPLOAD_DIR . $newFileName);
  return true;
}


// Remote uploading function to upload file from url
function remoteUpload($url)
{
  // Use basename() function to return the base name of file
  $fileName = time() . '_' . basename($url);

  // Use file_get_contents() function to get the file
  // from url and use file_put_contents() function to
  // save the file by using base name
  $downloadFile = file_put_contents(UPLOAD_DIR . $fileName, file_get_contents($url));
  if ($downloadFile) {
    // If file is downloaded successfully, then return the file size
    return filesize(UPLOAD_DIR . $fileName);
  } else {
    return false; // If file is not downloaded
  }
}
