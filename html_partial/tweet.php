
<div id="nav">
    <form id="deco_form" method="post" action="/deconnection">
        <button class="nav_deco" id="deconnection" type="submit">
            <span>Déconnection</span>
        </button>
        <input type="hidden" name="deco">
    </form>
</div>
<section id="section_Tweet">
    <div class="newTweet">
        <button class="newTweetBtn" id="open_tweet_window" type="button">
            <span>Nouveau Tweet</span>
        </button>
        <form id="newTweetForm" method="post" enctype="multipart/form-data">
            <label for="tweet_input">Ecrivez votre message</label>
            <input id="tweet_input" name="tweet_input" type="text">
            <div id="depose">Déposez vos images ou cliquez pour choisir</div>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
            <div class="bloc" id="preview"></div>
            <button type="submit" id="valider" >Envoyer</button>
        </form>
    </div>

    <?php foreach($tweets as $tweet): ?>
        <div class="Tweet">
            <span id="name" ><?= $tweet["pseudo"]?></span>
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
                    <input id="modify_input" type="text" name="modify_tweet" value="<?= $tweet["data"] ?>">
                    <input type="hidden" name="user_id" value="<?= $tweet["user_id"] ?>">
                    <input type="hidden" name="tweet_id" value="<?= $tweet["tweet_id"] ?>">
                </form>

            <?php } ?>
        </div>
    <?php endforeach; ?>
</section>
<script src="script/script.js?<?php echo time(); ?>"></script>