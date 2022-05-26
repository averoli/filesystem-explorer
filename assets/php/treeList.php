<?php

session_start();

function getPath(){
    return $_SESSION['path'];
}

// function treeList()
// {
//     $path = $_SESSION['path'];
//     $dir = scandir($path);
//     foreach ($dir as $key => $value) {
//         if($key >1)
//         echo "<li id='folderList'><a id='treeItem'><i class='fa fa-folder'></i> $value </a></li>";
//     }
// }

// function treeList($newPath, $isNew)
// {
//   $dir = scandir($_SESSION['path']);
//   foreach ($dir as $key => $value) {
//     if ($key > 1) {
//       $path = $_SESSION['path'] . "/$value";
//       echo "<li id='folderList'><a id='treeItem'><i class='fa fa-folder'></i> $value </a></li>";
//     }
//   }
// }
// treeList($_SESSION['path'], False);


// if ($_SERVER["REQUEST_METHOD"] === "POST"){
//     echo "Pepe";
// }