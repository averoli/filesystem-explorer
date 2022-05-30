<?php
session_start();
$path = explode("/data", $_SESSION['path']);
$target_dir = '../data' . $path[1];
if (!is_dir($target_dir . "/" . $_POST["folderName"])) {
    mkdir($target_dir . "/" . $_POST["folderName"], 0777);
    chmod($target_dir . "/" . $_POST["folderName"], 0777);
}
header('Location: ../../index.php' . '?path='. $_SESSION['path']);
