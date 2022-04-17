<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["change_pseudo"])) {
        require "../database/pdo.php";
        $user_id = $_SESSION["user"]["user_id"];
        $pseudo = filter_input(INPUT_POST, "change_pseudo");
        $maRequete = $pdo->prepare(
            "UPDATE `user` 
            SET `pseudo`= :pseudo
            WHERE `user_id` = :user_id");
        $maRequete->execute([
            ":pseudo" => $pseudo,
            "user_id" => $user_id
        ]);
        $maRequete = $pdo->prepare(
            "UPDATE `tweet` 
            SET `pseudo`= :pseudo
            WHERE `user_id` = :user_id");
        $maRequete->execute([
            ":pseudo" => $pseudo,
            "user_id" => $user_id
        ]);
        $_SESSION["user"]["pseudo"] = $pseudo;
        http_response_code(302);
        header('Location: /profil');
        exit();
    }
}
?>