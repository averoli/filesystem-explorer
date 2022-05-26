<?php
session_start();
$path = explode("/data",$_SESSION['path']);
$target_dir = '../data'.$path[1];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        echo "<p>El fichero es válido y se subió con éxito.</p>";
    } else {
        echo "<p>¡Posible ataque de subida de ficheros!</p>";
    }
}
header('Location: ../../index.php');