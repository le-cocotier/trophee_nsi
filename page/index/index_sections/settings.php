<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db');
$response = $bdd->query('SELECT * FROM users where name="'.$_SESSION['name'].'"');
$line = $response->fetchArray();
 ?>
<div class="content-flow">
    <div class="card is-post card-user">
        <div class="post-header">
            <h4>Options</h4>
        </div>
        <form id="sign-in_form" onsubmit="return false">
            <div class="form-chunck is-vertical">
                <label for="username">Username</label>
                <input class="input is-wide" type="text" name="name" value=<?php echo $line['name']; ?>>
            </div>
            <div class="form-chunck is-vertical">
                <label for="email">E-mail</label>
                <input class="input is-wide" type="text" name="email" value=<?php echo $line['email']; ?>>
            </div>
            <div class="form-chunck is-vertical">
                <label for="image">Image</label>
                <input type="file" name="image">
            </div>
            <div class="form-chunck is-vertical">
                <label for="password">Mot de passe actuel</label>
                <input class="input is-wide" id="password-signin" type="password" name="password" required>
            </div>
            <input class="button is-primary is-wide" type="submit" value="Sauvgarder">
        </form>
    </div>
</div>
