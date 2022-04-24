<?php

// si on est en method post
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // chemin vers le repertoir
    $target_dir = __DIR__ . "/../public/imgs/";
    $full_name = $_FILES["fileToUpload"]["name"];
    $name_exploded = explode(".",$full_name);
    require __DIR__ . "/function/uuid.php";
    $file_name = guidv4($full_name);
    $extension = $name_exploded[1];
    $full_name = $file_name . "." . $extension;
    $target_file = $target_dir . basename($full_name);
    // conteur upload ou pas
    $uploadOk = 1;
    // extension du fichier en minuscule
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // si $_POST  a récuperer les infos du formulaire
    if(isset($_POST["fileToUpload"])) {
        // si c'est une image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "ce n'est pas une image";
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/baniere.php";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        $message = "l'image existe déjà";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/baniere.php";
        $uploadOk = 0;
    }


    // si l'image est inferieur à 
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $message = "image trop volumineuse";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/baniere.php";
        $uploadOk = 0;
    }


    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $message = "seulement jpg, png, jpeg et gif";
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
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $maRequete = $pdo->prepare(
                // j'ajoute les valeurs au tweet avec l'image
                "INSERT INTO `tweet` (`pseudo`, `user_id`, `data`, `image`, `profil_picture`)
                VALUES(:pseudo, :userId, :oneData, :image, :profil_picture)");
                $maRequete->execute([
                    ":pseudo" => $pseudo,
                    ":userId" => $user_id,
                    ":oneData" => $texte,
                    ":image" => $full_name,
                    ":profil_picture" => $profil_picture
                ]);
            // je reviens à la page tweet
            header("Location: /tweet");
            exit();
        } else {
            $message = "Une erreur est survenue";
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/baniere.php";
        }
    }
}
?>