<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["deco"])) {
        unset($_SESSION["user"]);
        http_response_code(302);
        header('Location: /login');
        exit();
    }

}

?>