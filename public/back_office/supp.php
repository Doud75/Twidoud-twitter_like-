<?php
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if($id) {
    require "../../database/pdo.php";
    $maRequete = $pdo->prepare("DELETE FROM `user` WHERE `user_id` = :id");
    $maRequete->execute([
        ":id" => $id
    ]);
    http_response_code(302);
    header("Location: database.php");
    exit();
} else {
    echo "Error";
}
?>