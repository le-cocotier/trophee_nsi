<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db');
$response = $bdd->query('SELECT * FROM users where id="'.$_SESSION['user_ID'].'"');
$line = $response->fetchArray();
 ?>
<div class="content-flow">
    <div class="card is-post">
        <div class="post-header">
            <h4 class="post-header__title">Options</h4>
        </div>
        <form id="sign-in_form" action="/trophee_nsi/cible/settings.php" method="post" enctype='multipart/form-data'>
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
                <label for="description">Description</label>
                <textarea class="input is-wide" name="description" rows="8" cols="100%" value="<?php echo $line['description']; ?>"><?php echo $line['description']; ?></textarea>
            </div>
            <div class="form-chunck is-vertical">
                <label for="public">Profil public</label>
                <label class="switch">
                    <input class="checkbox" type="checkbox" name="public">
                    <span class="switch__slider"></span>
                </label>
            </div>
            <div class="form-chunck is-vertical">
                <label for="password">Mot de passe actuel</label>
                <input class="input is-wide" id="password-signin" type="password" name="password" required>
            </div>
            <input class="button is-primary is-wide" type="submit" value="Sauvgarder">
        </form>
        <?php if ($line['public'] == 'true'){ ?>
            <script type="text/javascript">
                document.getElementsByClassName('checkbox')[0].checked = true;
            </script>
        <?php }
        else{ ?>
            <script type="text/javascript">
                document.getElementsByClassName('checkbox')[0].checked = false;
            </script>
        <?php } ?>
    </div>
</div>
