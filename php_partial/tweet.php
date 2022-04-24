<?php
ob_start();
$title = "Twidoud";


require "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];
// je vais chercher tous les tweets
$maRequete = $pdo->prepare("SELECT * FROM `tweet` ORDER BY `date` DESC");
    $maRequete->execute();
    $tweets = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// je vais chercher tous les like de l'utilisateur
$maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    $tweet_like_src = "img/unlike.png";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["tweet_input"])) {
        require_once "../database/pdo.php";
        // je récupère le resultat du formulaire
        $texte = filter_input(INPUT_POST, "tweet_input");
        $pseudo = $_SESSION["user"]["pseudo"];
        $profil_picture = $_SESSION["user"]["profil_picture"];
        
        if($_FILES["fileToUpload"]["name"]) {
            // si il y a une image j'appelle upload.php
            require_once __DIR__ . "/upload.php";
        } else {
            // sinon j'ajoute le resultat du formulaire a la base de donnée
            $maRequete = $pdo->prepare(
                "INSERT INTO `tweet` (`pseudo`, `user_id`, `data`, `profil_picture`)
                VALUES(:pseudo, :userId, :oneData, :profil_picture)");
                $maRequete->execute([
                    ":pseudo" => $pseudo,
                    ":userId" => $user_id,
                    ":oneData" => $texte,
                    ":profil_picture" => $profil_picture
                ]);
            http_response_code(302);
            // je redirige vers tweet
            header('Location: /tweet');
            exit();
        }
    } 
}

require_once __DIR__ . '/../html_partial/tweet.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable