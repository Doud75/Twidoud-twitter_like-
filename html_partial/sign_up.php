<body class="bodyLogin">
    <main class="loginMenu">
        <button class= "login" id="">
            <a id="inscrire" href="/login">Login</a>
        </button>
        <div class="block1">
            <div class="formInput">
                <!-- Formulaire d'inscription -->
                <form method="POST">
                    <label for="pseudo">Entrez votre pseudo</label><br>
                    <input type="text" id="pseudo" name="pseudo"><br>
                    <label for="email">Entrez votre email</label><br>
                    <input type="email" id="email" name="mail"><br>
                    <label for="password">Entrez votre mot de passe</label><br>
                    <input type="password" id="password" name="mdp"><br>
                    <button type="submit" id="validers" name="valider" >Valider</button>
                </form>
            </div>
        </div>
    </main>
</body>

<script src="script/signUp_script.js?<?php echo time(); ?>"></script>