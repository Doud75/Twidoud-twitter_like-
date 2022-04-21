<?php
//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "sign up";

// si on est en method POST, on reçoit les donnée du formulaire
// permet de créer un utilisateur
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = filter_input(INPUT_POST, "mail"); //récupère le mail du formulaire
    //récupère le mdp du formulaire
    $mdp = hash("sha512", filter_input(INPUT_POST, "mdp"));
    // récupère le pseudo du formulaire
    $pseudo = filter_input(INPUT_POST, "pseudo");
    require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO
    //requete sql pour trouver dans la database l'utilisateur voulu
    $maRequete = $pdo->prepare("SELECT `mail` FROM `user` WHERE `mail` = :mail;");
    $maRequete->execute([
        ":mail" => $mail
    ]);

    //récupère le résultat de la requète
    $user = $maRequete->fetch();
    if($user == false) { //si aucun résultat
        $maRequete = $pdo->prepare("SELECT `pseudo` FROM `user` WHERE `pseudo` = :pseudo;");
        $maRequete->execute([
            ":pseudo" => $pseudo
        ]);
        $pseudo_user = $maRequete->fetch();
        if($pseudo_user == false) {
            //j'ajoute le résultat du formulaire dans la database
            $maRequete = $pdo->prepare("INSERT INTO `user` (`mail`, `mdp`, `pseudo`) VALUES(:mail, :mdp, :pseudo)");
            $maRequete->execute([
                ":mail" => $mail,
                ":mdp" => $mdp,
                ":pseudo" => $pseudo
            ]);

            $maRequete = $pdo->prepare("SELECT `user_id`, `mail`, `mdp`, `pseudo`, `profil_picture` FROM `user` WHERE `mail` = :mail;");
            $maRequete->execute([
                ":mail" => $mail
            ]);
            $user = $maRequete->fetch();
            $_SESSION["user"] = $user;
            header("Location: /tweet"); //je vais à la page projet
            exit();
        } else {
            $message = "le pseudo existe déjà";
            //indique que le serveur refuse d'autoriser la requête 
            http_response_code(403);
            //j'appelle ma bannière html pour afficher un message d'erreur
            require_once __DIR__ . "/../html_partial/alert/baniere.php";
        }
    } else { //sinon
        $message = "l'utilisateur existe déjà";
        //indique que le serveur refuse d'autoriser la requête 
        http_response_code(403);
        //j'appelle ma bannière html pour afficher un message d'erreur
        require_once __DIR__ . "/../html_partial/alert/baniere.php";

    }
}
//j'appelle l'html de cette page
require_once __DIR__ . '/../html_partial/sign_up.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable