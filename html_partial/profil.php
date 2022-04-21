<div id="nav">
    <!-- Formulaire de deconnection -->
    <form id="deco_form" method="post" action="/deconnection">
        <button class="nav_deco" id="deconnection" type="submit"><img id="logout_img" src="img/logout.png" alt=""></button>
        <input type="hidden" name="deco">
    </form>
    <button id="profil_btn"><a href="/profil"><img id="profil_img" src="img/profile.png" alt=""></a></button>
</div>

<div id="profil_picture">
    <!-- Photo de profil -->
    <img id="img_modify_picture" src="img_profil/<?= $profil_picture?>" alt="">
    <?php if($profil_id === $_SESSION["user"]["user_id"]) { ?>
        <button id="open_change_profil">Modifier photo</button>
        <!-- Formulaire changement photo de profil si la page est celle de l'utilisateur-->
        <form action="/change_profil" id="change_profil" method="post" enctype="multipart/form-data">
            <div id="depose_profil">Déposez vos images ou cliquez pour choisir</div>
            <input type="file" name="pictureToUpload" id="pictureToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
            <div class="bloc_profil" id="preview_profil"></div>
            <button type="submit" id="valider_picture">Valider</button>
        </form>
    <?php } ?>
    
</div>
<div id="profil_pseudo_div">
    <!-- Pseudo -->
    <span id="profil_pseudo"><?=$pseudo?></span>
    <?php if($profil_id === $_SESSION["user"]["user_id"]) { ?>
        <button id="open_change_pseudo">Modifier pseudo</button>
        <!-- Formulaire changement pseudo si la page est celle de l'utilisateur-->
        <form action="/change_pseudo" method="post" id="change_pseudo_form">
            <input type="text" name="change_pseudo" id="change_pseudo" value="<?=$pseudo?>">
            <button type="submit" id="valider_pseudo">Valider</button>
        </form>
    <?php } ?>
</div>
<section id="section_Tweet">
    <!-- Affiche les tweets du profil consulté-->
    <?php foreach($tweets as $tweet): 
        if($tweet["image"]) {
            $tweet_class = "with_image";
        } else {
            $tweet_class = "Tweet";
        }?>
        <div class="<?= $tweet_class?>" >
            <img id="profil_picture_tweet" src="img_profil/<?=$tweet["profil_picture"]?>" alt="">
            <form action="/profil" method="post">
                <button type="submit" id="name" ><?= $tweet["pseudo"]?></button>
                <input type="hidden" name="user_id" value="<?= $tweet["user_id"] ?>">
            </form>
            <span id="date" ><?=$tweet["date"] ?></span>
            <div id="data" ><?=$tweet["data"] ?></div>
            <?php if($tweet["image"]) {?>
            <img src="imgs/<?=$tweet["image"]?>" id="image_tweet" >
            <?php } ?>

            <?php if($tweet["user_id"] === $_SESSION["user"]["user_id"]) { ?>

                <form id="delete_tweet" method="post" action="/delete">
                    <button class="delete" type="submit"><img id="dash"src="img/Frame 13.png" alt="BIN" ></button>
                    <input type="hidden" name="delete_id" value="<?= $tweet["tweet_id"] ?>">
                    <input type="hidden" name="user_id" value="<?= $tweet["user_id"] ?>">
                </form>

                <img id="pen" class="modifyTweetBtn" src="img/Frame 12.png" alt="BIN" >
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

<script src="script/profil_script.js?<?php echo time(); ?>"></script>