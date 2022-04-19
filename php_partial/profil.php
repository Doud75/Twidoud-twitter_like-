<?php
//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "profil";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["user_id"])) {
        require_once "../database/pdo.php";
        $profil_id = filter_input(INPUT_POST, "user_id");
    }
} else {
    require_once "../database/pdo.php";
    $profil_id = $_SESSION["user"]["user_id"];
}

$maRequete = $pdo->prepare("SELECT * FROM `user` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $profil_id
    ]);
    $profil = $maRequete->fetch();

    $pseudo = $profil["pseudo"];
    $profil_picture = $profil["profil_picture"];

$maRequete = $pdo->prepare("SELECT * FROM `tweet` WHERE `user_id` = :userId ORDER BY `date` DESC");
    $maRequete->execute([
        ":userId" => $profil_id
    ]);
    $tweets = $maRequete->fetchAll(PDO::FETCH_ASSOC);


require_once __DIR__ . "/../html_partial/profil.php"; 

$content = ob_get_clean(); //je stock le tampon dans cette variable

?>