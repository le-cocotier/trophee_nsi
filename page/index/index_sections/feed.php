<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
if (isset($_SESSION['name']) && isset($_SESSION['password'])){

    $response = $bdd->query('SELECT friends from users where id="'.$_SESSION['user_ID'].'"');
    $line = $response->fetchArray();
    $line = explode(",",$line['friends']);
    $liste_of_users = "'".implode("','", $line)."'";
    $query = "SELECT id from users where public='true' EXCEPT SELECT id from users where id IN (".$liste_of_users.") ";
    $request = $bdd->query($query);
    while ($public_profile = $request->fetchArray()){
        if ($public_profile['id'] != $_SESSION['user_ID']){
            array_push($line, $public_profile['id']);
        }
    }
}
else {
    $response = $bdd->query('SELECT id FROM users where public = "true"');
    $line = [];
    while ($public_profile = $response->fetchArray()){
        array_push($line, $public_profile['id']);
    }
}
$liste_of_users = "'".implode("','", $line)."'";
 ?>

<div class="content-flow">
    <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])){ ?>
    <div class="card is-post">
        <div class="post-header">
            <h4 class="post-header__title">Postez quelque chose...</h4>
        </div>
        <form class="form-post" action='/trophee_nsi/cible/send_post.php' method="post" enctype="multipart/form-data" onsubmit="return false">
            <div class="form-chunck is-vertical">
                <label for="username">Titre</label>
                <input class="input" type="text" name="title" placeholder="Une idée originale..." required>
            </div>
            <div class="form-chunck is-vertical">
                <label for="username">Contenu</label>
                <textarea placeholder="Racontez en un peu plus..." class="input is-secondary" name="content" rows="8" cols="80" required></textarea>
            </div>
            <div class="form-chunck is-vertical">
                <label for="username">Rajoutez une image</label>
                <input type="file" name="image">
            </div>
            <input type="hidden" name="user" value="<?php echo $_SESSION['user_ID']; ?>">
            <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input class="button is-primary" type="submit" name="" value="Poster">
        </form>
    </div>
    <?php }
    echo get_user_posts($liste_of_users); ?>
</div>
