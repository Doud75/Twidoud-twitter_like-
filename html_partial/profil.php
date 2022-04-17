<div id="nav">
    <form id="deco_form" method="post" action="/deconnection">
        <button class="nav_deco" id="deconnection" type="submit"><img id="logout_img" src="img/logout.png" alt=""></button>
        <input type="hidden" name="deco">
    </form>
    <button id="profil_btn"><a href="/profil"><img id="profil_img" src="img/profile.png" alt=""></a></button>
</div>

<div id="profil_picture">
    <img src="img_profil/<?= $profil_picture?>" alt="">
    <button id="open_change_profil">Modifier photo</button>
    <form action="/change_profil" id="change_profil" method="post" enctype="multipart/form-data">
        <input type="file" name="pictureToUpload" id="pictureToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
        <div class="bloc" id="preview"></div>
        <button type="submit" id="valider_picture">Valider</button>
    </form>
</div>
<div id="profil_pseudo">
    <span><?=$pseudo?></span>
    <button id="open_change_pseudo">Modifier pseudo</button>
    <form action="/change_pseudo" method="post" id="change_pseudo_form">
        <input type="text" name="change_pseudo" id="change_pseudo">
        <button type="submit" id="valider_pseudo">Valider</button>
    </form>
</div>


<script src="script/profil_script.js?<?php echo time(); ?>"></script>