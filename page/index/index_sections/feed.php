<!--
Idée de comment faire fonctioner l'affichage des posts:
Que ce soit sur le feed principal ou feed d'une communauté
ça vient demander à la cible get_posts en fonction des arguments,
exemple: groupe_id si communauté, user_id si feed de l'utilisateur
et ça return ici les posts et à d'autres endroits etc.
c'est possible en php? et demander si pas claire

En attendant, posts placeholder -->

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
echo '<div class="content-flow">';
echo get_user_posts($liste_of_users);
echo '</div>';
 ?>
