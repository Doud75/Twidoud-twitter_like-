<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["delete_id"])) {
        require "../database/pdo.php";
        $id = filter_input(INPUT_POST, "delete_id");
        $tweet_user = filter_input(INPUT_POST, "user_id");
        $user_id = $_SESSION["user"]["user_id"];
        if($tweet_user === $user_id) {
            if($id) {
                $maRequete = $pdo->prepare("DELETE FROM `tweet` WHERE `tweet_id` = :id");
                $maRequete->execute([
                    ":id" => $id
                ]);
                http_response_code(302);
                $direction = explode("/",$_SERVER["HTTP_REFERER"]);
                if($direction[3] === "profil") {
                    header('Location: /profil');
                } else {
                    header('Location: /tweet');
                }
                exit();
            }
        } else {
            $message = "ce tweet n'est pas de vous"; 
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/baniere.php";
        }
    }
}
?>