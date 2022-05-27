<?php
$content = "";
echo $_GET['view'];
if (isset($_GET['view']) && !empty($_GET['view'])) {
    $fileName = $_GET['view'];
    $fullFilePath = $_SESSION['path'] . '/' . $fileName;
    echo $fullFilePath;

    if (file_exists($fullFilePath)) {
        echo  $myfile = fopen($fullFilePath, "r");

        //     while (!feof($myfile)) {
        //        echo $content .= fgets($myfile) . "<br>";
        //     }
        //     fclose($myfile);
        // } else {
        //     $_SESSION['messages'] = "File already exists.";
        //     $messageShow = true;
    }
}

if ($_FILES) {
    $path_whereToUpload =  $urlPath . "/" . basename($_FILES["new_file"]["name"]);
    $path_whichToUpload = $_FILES["new_file"]["tmp_name"];
    move_uploaded_file($path_whichToUpload, $path_whereToUpload);
}
