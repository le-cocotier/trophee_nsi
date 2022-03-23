<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/pages/sign-in.css">
</head>
<body>
    <div id="container">
        <img class="container__brand" src="./../img/logo.png" alt="Logo brand">
        <div class="container__buttons">
            <a id="button_sing-in" href="#" class="active" onclick="switchForm('sign-in')">Connexion</a>
            <a id="button_sing-up" href="#" onclick="switchForm('sign-up')">Inscription</a>
        </div>
        <div id="sign-in">
            <form action="../cible/sign_in.php" method="post">
                <div class="form-chunck is-vertical">
                    <label for="username">Nom d'utilisateur</label>
                    <input class="input is-wide" id="username" type="text" name="name" required>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="password">Mot de passe</label>
                    <input class="input is-wide" id="password-signin" type="password" name="password" required>
                </div>
                <input class="button is-primary is-wide" type="submit" value="Se connecter">
            </form>
        </div>
        <div id="sign-up" style="display: none;">
            <form id="sign-up_form" onsubmit="return false">
                <div class="form-chunck is-vertical">
                    <label for="username">Nom d'utilisateur</label>
                    <input class="input is-wide" id="username-signup" type="text" name="name" required>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="email">E-mail</label>
                    <input class="input is-wide" id="email-signup" type="text" name="email" required>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="birth_date">Date de naissance</label>
                    <input class="input" id="birth_date-signup" type="date" name="birth_date" required>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="password">Mot de passe</label>
                    <input class="input is-wide" id="password-signup" type="password" name="password" required>
                </div>
                <input id="sign-up_form_submit" class="button is-primary is-wide" type="submit" value="S'inscrire">
            </form>
        </div>

        <a class="container__go-home" href="/trophee_nsi/page/index.php">Retourner à l'accueil</a>
    </div>
    <script src="../js/pages/sign-in.js"></script>
</body>
</html>
