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
            <form id="sign-in_form" onsubmit="return false">
                <div class="form-chunck is-vertical">
                    <label for="username">Nom d'utilisateur</label>
                    <input class="input is-wide" id="username-signin" type="text" name="name" required>
                    <p id="username-signin-error" class="input-error hidden">Nom d'utilisateur ou email incorrecte</p>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="password">Mot de passe</label>
                    <input class="input is-wide" id="password-signin" type="password" name="password" required>
                    <p id="password-signin-error" class="input-error hidden">Mot de passe incorrecte</p>
                </div>
                <input class="button is-primary is-wide" type="submit" value="Se connecter" onclick="submitSignIn()">
            </form>
        </div>
        <div id="sign-up" style="display: none;">
            <form id="sign-up_form" onsubmit="return false">
                <div class="form-chunck is-vertical">
                    <label for="username">Nom d'utilisateur</label>
                    <input class="input is-wide" id="username-signup" type="text" name="name" required>
                    <p id="username-signup-error" class="input-error hidden">Le nom d'utilisateur doit être long de 4 caractères</p>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="email">E-mail</label>
                    <input class="input is-wide" id="email-signup" type="text" name="email" required>
                    <p id="email-signup-error" class="input-error hidden">L'e-mail n'a pas la bonne forme</p>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="birth_date">Date de naissance</label>
                    <input class="input" id="birth_date-signup" type="date" name="birth_date" required>
                    <p id="birth_date-signup-error" class="input-error hidden">Date de naissance invalide</p>
                </div>
                <div class="form-chunck is-vertical">
                    <label for="password">Mot de passe</label>
                    <input class="input is-wide" id="password-signup" type="password" name="password" required>
                    <p id="password-signup-error" class="input-error hidden">Le mot de passe doit être long de 8 caractères, avoir des majuscules, des miniscules et des caractères spéciaux</p>
                </div>
                <input id="sign-up_form_submit" class="button is-primary is-wide" type="submit" value="S'inscrire" onclick="sumbitSignUp()">
            </form>
        </div>

        <a class="container__go-home" href="/trophee_nsi/page/index/index.php">Retourner à l'accueil</a>
    </div>
    <script src="../js/pages/sign-in.js"></script>
</body>
</html>
