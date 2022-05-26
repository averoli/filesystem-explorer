<?php
$content = "";
if (isset($_GET['view']) && !empty($_GET['view'])) {
    $fileName = $_GET['view'];
    $fullFilePath = $_SESSION['path'] . '/' . $fileName;

    if (file_exists($fullFilePath)) {
        $myfile = fopen($fullFilePath, "r") or die("Unable to open file!");

        while (!feof($myfile)) {
            $content .= fgets($myfile) . "<br>";
        }
        fclose($myfile);
    } else {
        $_SESSION['messages'] = "File already exists.";
        $messageShow = true;
    }
}

if ($_FILES) {
    $path_whereToUpload =  $urlPath . "/" . basename($_FILES["new_file"]["name"]);
    $path_whichToUpload = $_FILES["new_file"]["tmp_name"];
    move_uploaded_file($path_whichToUpload, $path_whereToUpload);
}
