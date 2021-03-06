<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["modify_tweet"])) {
        require "../database/pdo.php";
        // je récupère les informations du formulaire
        $user_id = $_SESSION["user"]["user_id"];
        $data = filter_input(INPUT_POST, "modify_tweet");
        $tweet_user = filter_input(INPUT_POST, "user_id");
        $tweet_id = filter_input(INPUT_POST, "tweet_id");
        if($tweet_user === $user_id) {
            // je mets à jour le tweet
            $maRequete = $pdo->prepare("UPDATE `tweet` SET `data`= :oneData, `date` = CURRENT_TIMESTAMP WHERE `tweet_id` = :tweet_id");
            $maRequete->execute([
                ":oneData" => $data,
                "tweet_id" => $tweet_id
            ]);
            http_response_code(302);
            // je récupère la page précédente
            $direction = explode("/",$_SERVER["HTTP_REFERER"]);
                // je redirige vers la page précédente
                if($direction[3] === "profil") {
                    header('Location: /profil');
                } else {
                    header('Location: /tweet');
                }
            exit();
        } else {
            $message = "ce tweet n'est pas de vous"; 
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/baniere.php";
        }
    }
}
?>