<body class="bodyLogin">
    <main class="loginMenu">
        <button class= "login" id="">
            <a id="inscrire" href="/login">Login</a>
        </button>
        <div class="block1">
            <div class="formInput">
                <form method="POST">
                    <label for="pseudo">Entrez votre pseudo</label>
                    <input type="text" id="pseudo" name="pseudo">
                    <label for="email">Entrez votre email</label>
                    <input type="email" id="email" name="mail">
                    <label for="password">Entrez votre mot de passe</label>
                    <input type="password" id="password" name="mdp">
                    <button type="submit" id="valider" name="valider" >Valider</button>
                </form>
            </div>
        </div>
    </main>
</body>

<script src="script/signUp_script.js?<?php echo time(); ?>"></script>