<?php
session_start();
echo $_SESSION['path'] .'<br/>';
$path = explode("/data", $_SESSION['path']);
$target_dir = '../data' . $path[1];
echo $target_dir  .'<br/>';
$target_file = $target_dir .'/'. basename($_FILES["fileToUpload"]["name"]);
$filename = $_FILES["fileToUpload"]["name"];
$filetype = $_FILES["fileToUpload"]["type"];
$filesize = $_FILES["fileToUpload"]["size"];
echo $target_file .'<br/>';
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        echo "<p>El fichero es válido y se subió con éxito.</p>";
    } else {
        echo "<p>¡Posible ataque de subida de ficheros!</p>";
    }
}
// header('Location: ../../index.php');
// header('Location: '. '?path='.$urlPath . '&message='.$messageShow);exit;
