<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["change_pseudo"])) {
        // je récupère les données du formulaire
        require "../database/pdo.php";
        $user_id = $_SESSION["user"]["user_id"];
        $pseudo = filter_input(INPUT_POST, "change_pseudo");
        // je mets à jour la valeur pseudo dans la base de données
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
        // J'ajoute le nouveau pseudo dans la session
        $_SESSION["user"]["pseudo"] = $pseudo;
        // je redirige vers profil
        http_response_code(302);
        header('Location: /profil');
        exit();
    }
}
?>