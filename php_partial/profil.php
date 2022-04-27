<?php
//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "profil";

// si je suis en Post
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["user_id"])) {
        require_once "../database/pdo.php";
        // je récupère le user_id à afficher dans la page profil
        $profil_id = filter_input(INPUT_POST, "user_id");
        $_SESSION["profil_watching"] = $profil_id;
    }
} else {
    $direction = explode("/",$_SERVER["HTTP_REFERER"]);
    var_dump($direction);
    // sinon j'affiche le profil de l'utilisateur
    require_once "../database/pdo.php";
    $profil_id = $_SESSION["profil_watching"];
}

// je récupère les informations du profil
$maRequete = $pdo->prepare("SELECT * FROM `user` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $profil_id
    ]);
    $profil = $maRequete->fetch();

    $pseudo = $profil["pseudo"];
    $profil_picture = $profil["profil_picture"];

// je récupère les tweets du profil
$maRequete = $pdo->prepare("SELECT * FROM `tweet` WHERE `user_id` = :userId ORDER BY `date` DESC");
    $maRequete->execute([
        ":userId" => $profil_id
    ]);
    $tweets = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// je récupère les likes de l'utilisateur pour les afficher
$user_id = $_SESSION["user"]["user_id"];
$maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    $tweet_like_src = "img/unlike.png";


require_once __DIR__ . "/../html_partial/profil.php"; 

$content = ob_get_clean(); //je stock le tampon dans cette variable

?>