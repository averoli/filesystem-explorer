<?php
session_start();
$_SESSION['path'] = $_SESSION['root'];
$keyword = $_GET['keyword'];

$path = explode("/data", $_SESSION['path']);
$dir = '../data' . $path[1];

//REMOVE . AND ..
// echo $dir.'<br/>';
$fileListing = array_diff(scandir($dir), array('..', '.'));
// print_r($fileListing).'<br/>';

$folders = array();
$files = array();


// needs a recursive function
foreach ($fileListing as $file) {
    $fileInfo = $dir . "/" . $file;
    if (is_dir($fileInfo)) {
        echo '<pre>';
        echo $fileInfo;
      $folders[] = $file;
    } else {
      $files[] = $file;
    }
  }