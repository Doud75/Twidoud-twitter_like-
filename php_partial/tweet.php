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
        
        if($_FILES) {
            require_once __DIR__ . "/upload.php";
        } else {
            $maRequete = $pdo->prepare(
                "INSERT INTO `tweet` (`pseudo`, `user_id`, `data`)
                VALUES(:pseudo, :userId, :oneData)");
                $maRequete->execute([
                    ":pseudo" => $pseudo,
                    ":userId" => $user_id,
                    ":oneData" => $texte
                ]);
            http_response_code(302);
            header('Location: /tweet');
            exit();
        }
    } 
}

require_once __DIR__ . '/../html_partial/tweet.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable