
<div id="nav">
    <!-- Formulaire de deconnection -->
    <form id="deco_form" method="post" action="/deconnection">
        <button class="nav_deco" id="deconnection" type="submit"><img id="logout_img" src="img/logout.png" alt=""></button>
        <input type="hidden" name="deco">
    </form>
    <button id="profil_btn"><a href="/profil"><img id="profil_img" src="img/profile.png" alt=""></a></button>
</div>
<section id="section_Tweet">
    <div class="newTweet">
        <!-- Bouton ouvrir formulaire nouveau tweet -->
        <button class="newTweetBtn" id="open_tweet_window" type="button">
            <span>Nouveau Tweet</span>
        </button>
        <!-- Formulaire nouveau tweet-->
        <form id="newTweetForm" method="post" enctype="multipart/form-data">
            <label id="tweet_label" for="tweet_input">Ecrivez votre message</label><br>
            <textarea id="tweet_input" name="tweet_input" type="text"></textarea>
            <div id="depose">Déposez vos images ou cliquez pour choisir</div>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
            <div class="bloc" id="preview"></div>
            <button type="submit" id="valider" >Envoyer</button>
        </form>
    </div>

    <!-- Affiche tous les tweets -->
    <?php foreach($tweets as $tweet): 
        if($tweet["image"]) {
            $tweet_class = "with_image";
        } else {
            $tweet_class = "Tweet";
        }
        // Affiche les likes de l'utilisateur
        foreach($user_likes as $user_like) {
            if($user_like["tweet_id"] === $tweet["tweet_id"]) {
                $tweet_like_src = "img/like.png";
            } else {
                $tweet_like_src = "img/unlike.png";
            }
        } ?>
        <!-- Affiche le contenu du tweet -->
        <div class="<?= $tweet_class?>" >
            <img id="profil_picture_tweet" src="img_profil/<?=$tweet["profil_picture"]?>" alt="">
            <!-- Formulaire pour rediriger vers la page profil du redacteur du tweet  -->
            <form action="/profil" method="post">
                <button type="submit" id="name" ><?= $tweet["pseudo"]?></button>
                <input type="hidden" name="user_id" value="<?= $tweet["user_id"] ?>">
            </form>
            <span id="date" ><?=$tweet["date"] ?></span>
            <div id="data" ><?=$tweet["data"] ?></div>
            <?php if($tweet["image"]) {?>
            <img src="imgs/<?=$tweet["image"]?>" id="image_tweet" >
            <?php } ?>
            <form action="/likeTweet" method="post" id="tweet_like">
                <button id="like" type="submit"><img id="like_img"src="<?= $tweet_like_src ?>" alt="like"><?=$tweet["like"]?></button>
                <input type="hidden" name="like_tweet_id" value="<?= $tweet["tweet_id"] ?>">
            </form>

            <?php if($tweet["user_id"] === $_SESSION["user"]["user_id"]) { ?>
                <!-- Formulaire supprimer le tweet si l'utilisateur est le redacteur du tweet -->
                <form id="delete_tweet" method="post" action="/delete">
                    <button class="delete" type="submit"><img id="dash"src="img/Frame 13.png" alt="BIN" ></button>
                    <input type="hidden" name="delete_id" value="<?= $tweet["tweet_id"] ?>">
                    <input type="hidden" name="user_id" value="<?= $tweet["user_id"] ?>">
                </form>

                <img id="pen" class="modifyTweetBtn" src="img/Frame 12.png" alt="BIN" >
                <!-- Formulaire modifier le tweet si l'utilisateur est le redacteur du tweet -->
                <form id="form_modify" class="modify_tweet" method="post" action="/modify">
                    <button class="modify" type="submit">Valider</button>
                    <label id="label_modify" for="modify_input">Ecrivez votre message</label>
                    <textarea id="modify_input" type="text" name="modify_tweet" value=""><?= $tweet["data"] ?></textarea>
                    <input type="hidden" name="user_id" value="<?= $tweet["user_id"] ?>">
                    <input type="hidden" name="tweet_id" value="<?= $tweet["tweet_id"] ?>">
                </form>
            <?php } ?>
        </div>
    <?php endforeach; ?>
</section>
<script src="script/tweet_script.js?<?php echo time(); ?>"></script>
<script>
    console.log("<?=$_SESSION["user"]["profil_picture"]?>")
</script>