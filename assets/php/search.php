<?php

session_start();
$_SESSION['path'] = $_SESSION['root'];

if (isset($_POST['keyword'])) {
  $keyword = $_POST['keyword'];
}

$path = explode("/data", $_SESSION['path']);
// $dir = '../data' . $path[1];
$dir = new DirectoryIterator('../data' . $path[1]);

//REMOVE . AND ..
// $fileListing = array_diff(scandir($dir), array('..', '.'));


$_SESSION['folders'] = array();
$_SESSION['files'] = array();


// needs a recursive function
foreach ($dir as $file) {
  // $content = file_get_contents($file->getPathname());
  echo '<pre>';
  echo $file->getPathname();
  $content = file_get_contents($file);
  // echo $content;
  // if (str_contains($file, $keyword)) {
  //   if (is_dir($fileInfo)) {
  //     $_SESSION['folders'] = $file;
  //     echo '<pre>';
  //     print_r($_SESSION['folders']);
  //   } else {
  //     $_SESSION['files'] = $file;
  //     echo '<pre>';
  //     print_r($_SESSION['files']);
  //   }
  // }
}
