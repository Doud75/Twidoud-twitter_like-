<?php
// Si on est en post
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Si il y a des informations dans le formulaire
    if(isset($_POST["like_tweet_id"])) {
        // On recupere le informations
        require "../database/pdo.php";
        $tweet_id = filter_input(INPUT_POST, "like_tweet_id");
        $user_id = $_SESSION["user"]["user_id"];

        // On cherche si le tweet à deja ete like par l'utilisateur
        $maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId AND `tweet_id` = :tweetId;");
        $maRequete->execute([
            ":userId" => $user_id,
            ":tweetId" => $tweet_id
        ]);
        $user_like = $maRequete->fetch();
        if($user_like) { // Si le tweet à deja ete like par l'utilisateur
            // On supprime le like
            $maRequete = $pdo->prepare("DELETE FROM `likes` WHERE `like_id` = :likeId");
            $maRequete->execute([
                ":likeId" => $user_like["like_id"]
            ]);
            
            // J'enleve 1 like au tweet
            $maRequete = $pdo->prepare("UPDATE `tweet` SET `like` = `like` -1 WHERE `tweet_id` = :tweetId");
            $maRequete->execute([
                ":tweetId" => $tweet_id
            ]);
            
        } else { // Sinon on ajoute le like
            $maRequete = $pdo->prepare("INSERT INTO `likes` (`tweet_id`, `user_id`) VALUES(:tweetId, :userId)");
            $maRequete->execute([
                ":tweetId" => $tweet_id,
                ":userId" => $user_id
            ]);

            // J'ajoute 1 like au tweet
            $maRequete = $pdo->prepare("UPDATE `tweet` SET `like` = `like` +1 WHERE `tweet_id` = :tweetId");
            $maRequete->execute([
                ":tweetId" => $tweet_id
            ]);
        }
        // On redirige vers la page precedente
        http_response_code(302);
                $direction = explode("/",$_SERVER["HTTP_REFERER"]);
                if($direction[3] === "profil") {
                    header("Location: /profil#$tweet_id");
                } else {
                    header("Location: /tweet#$tweet_id");
                }
                exit();
    }
}
?>