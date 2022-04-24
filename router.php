<?php
// La partie à partir du premier / dans l'url
$uri = $_SERVER["REQUEST_URI"];

//permet de ne pas se balader dans le site sans session user
// si $uri == /entrer.php
if ($uri == "/entrer.php") {
    //si pas de session user
    if (!isset($_SESSION["user"])) {
        //je vais à login
        header("Location: /login");
        exit;
    } else { //sinon je vais à tweet
        header("Location: /tweet");
        exit;
    }
// sinon si $uri différent de login ou sign_in
} else if ($uri != "/login" && $uri != "/sign_up") {
    //si pas de session user
    if (!isset($_SESSION["user"])) {
        //je vais à login
        header("Location: /login");
        exit;
    }
}


//si $uri = ...
switch ($uri) {
    case "/login":
        require_once __DIR__ . "/php_partial/login.php";
        break;
    case "/sign_up":
        require_once __DIR__ . "/php_partial/sign_up.php";
        break;
    case "/tweet":
        require_once __DIR__ . "/php_partial/tweet.php";
        break;
    case "/deconnection":
        require_once __DIR__ . "/php_partial/deconnection.php";
        break;
    case "/modify":
        require_once __DIR__ . "/php_partial/modify_tweet.php";
        break;
    case "/delete":
        require_once __DIR__ . "/php_partial/delete_tweet.php";
        break;
    case "/upload":
        require_once __DIR__ . "/php_partial/upload.php";
        break;
    case "/profil":
        require_once __DIR__ . "/php_partial/profil.php";
        break;
    case "/change_profil":
        require_once __DIR__ . "/php_partial/change_profil.php";
        break;
    case "/change_pseudo":
        require_once __DIR__ . "/php_partial/change_pseudo.php";
        break;
    case "/likeTweet":
        require_once __DIR__ . "/php_partial/likeTweet.php";
        break;
    default:
        http_response_code(404);
        $content = file_get_contents(__DIR__ . "/html_partial/alert/404.php");
}
//j'appelle la base html qui affichera $content (voir dans les fichiers dans php_partial)
require_once __DIR__ . "/html_partial/base_html.php";
?>
