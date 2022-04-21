<body class="bodyLogin">  
    <main class="loginMenu">
        <button class="signUp" id="">
            <a id="inscrire" href="/sign_up">Sign up</a>
        </button>
        </nav>
        <div class="block1">
            <div class="formInput">
                <!-- Formulaire de login -->
                <form class="form" action="/login" method="post">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="mail" placeholder=""><br>
                    <label for="password">Mot de passe</label><br>
                    <input type="password" id="password" name="mdp" placeholder=""><br>
                    <button type="submit" id="valider" name="valider" >Valider</button>
                </form>
            </div>
        </div>
    </main>
</body>

<script src="script/login_script.js?<?php echo time(); ?>"></script>