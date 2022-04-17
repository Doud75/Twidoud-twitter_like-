<?php
//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "profil";

$pseudo = $_SESSION["user"]["pseudo"];
$profil_picture = "profile-default.jpeg";
if ($_SESSION["user"]["profil_picture"]) {
    $profil_picture = $_SESSION["user"]["profil_picture"];
}


require_once __DIR__ . "/../html_partial/profil.php"; 

$content = ob_get_clean(); //je stock le tampon dans cette variable

?>