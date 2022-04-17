<?php
ob_start();
$title = "Twidoud";


require "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];
$maRequete = $pdo->prepare("SELECT * FROM `tweet` ORDER BY `date` DESC");
$maRequete->execute();
$tweets = $maRequete->fetchAll(PDO::FETCH_ASSOC);


if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["tweet_input"])) {
        require_once "../database/pdo.php";
        $texte = filter_input(INPUT_POST, "tweet_input");
        $pseudo = $_SESSION["user"]["pseudo"];
        $profil_picture = $_SESSION["user"]["profil_picture"];
        
        if($_FILES["fileToUpload"]["name"]) {
            var_dump(isset($_FILES["fileToUpload"]["name"]));
            echo("on est pas censé etre là");
            require_once __DIR__ . "/upload.php";
        } else {
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
            header('Location: /tweet');
            exit();
        }
    } 
}

require_once __DIR__ . '/../html_partial/tweet.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable