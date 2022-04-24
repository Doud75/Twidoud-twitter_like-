<?php

// si on est en method post
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // chemin vers le repertoir
    $target_dir = __DIR__ . "/../public/img_profil/";
    $full_name = $_FILES["pictureToUpload"]["name"];
    $name_exploded = explode(".",$full_name);
    require __DIR__ . "/function/uuid.php";
    // changement du nom par uuid
    $file_name = guidv4($full_name);
    $extension = $name_exploded[1];
    $full_name = $file_name . "." . $extension;
    $target_file = $target_dir . basename($full_name);
    // conteur upload ou pas
    $uploadOk = 1;
    // extension du fichier en minuscule
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // si $_POST  a récuperer les infos du formulaire
    if(isset($_POST["pictureToUpload"])) {
        // si c'est une image
        $check = getimagesize($_FILES["pictureToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "Ce n'est pas une image";
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/baniere.php";
            $uploadOk = 0;
        }
    }

    // si l'image existe déjà (impossible avec le uuid)
    if (file_exists($target_file)) {
        $message = "l'image existe déjà";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/baniere.php";
        $uploadOk = 0;
    }


    // si l'image n'est pas trop grande
    if ($_FILES["pictureToUpload"]["size"] > 500000) {
        $message = "Image trop volumineuse";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/baniere.php";
        $uploadOk = 0;
    }

    // verifie l'extansion de l'image
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $message = "Seulement jpg, png, jpeg et gif";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/baniere.php";
        $uploadOk = 0;
    }

    // si $uploadOk === 0 alors il y a une erreur quelque part
    if ($uploadOk === 0) {
        $message = "Une erreur est survenue";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/baniere.php";
    } else { // sinon
        // si ça fonctionne,
        if (move_uploaded_file($_FILES["pictureToUpload"]["tmp_name"], $target_file)) {
            // j'ajoute la photo à la base de donnée
            require "../database/pdo.php";
            $user_id = $_SESSION["user"]["user_id"];
            $maRequete = $pdo->prepare(
                "UPDATE `user` 
                SET `profil_picture` = :profil_picture
                WHERE `user_id` = :user_id");
                $maRequete->execute([
                    ":profil_picture" => $full_name,
                    ":user_id" => $user_id
                ]);
            $maRequete = $pdo->prepare(
                "UPDATE `tweet` 
                SET `profil_picture` = :profil_picture
                WHERE `user_id` = :user_id");
                $maRequete->execute([
                    ":profil_picture" => $full_name,
                    ":user_id" => $user_id
                ]);
            // j'ajoute la photo de profil à la session utilisateur    
            $_SESSION["user"]["profil_picture"] = $full_name;
            // je redirige vers /profil
            header("Location: /profil");
            exit();
        } else {
            $message = "Une erreur est survenue";
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/baniere.php";
        }
    }
}
?>