<?php
include $_SERVER["DOCUMENT_ROOT"].'/cible/functions.php';

$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT subscribers FROM users where id='".$_POST['user_to_unfollow']."'");
$nb_subscribers = $response->fetchArray()['subscribers'];
$nb_subscribers-=1;
$response = $bdd->exec("UPDATE users SET subscribers=".$nb_subscribers." where id='".$_POST['user_to_unfollow']."'");

$response = $bdd->query("SELECT subscriptions FROM users where id='".$_POST['user']."'");
$nb_subscriptions = $response->fetchArray()['subscriptions'];
$nb_subscriptions-=1;
$liste_of_friends = get_friends($_POST['user']);
unset($liste_of_friends[array_search($_POST['user_to_unfollow'], $liste_of_friends)]);
$liste_of_friends = implode(',', $liste_of_friends);
$response = $bdd->exec("UPDATE users SET subscriptions=".$nb_subscriptions.", friends='".$liste_of_friends."' where id='".$_POST['user']."'");
print_r(json_encode(["state"=>"unfollowed"]));

$response_notif = $bdd->query("SELECT * FROM notifications where user_concerning='".$_POST['user']."'");
while($line_notif = $response_notif->fetchArray()){
    $response_notif = $bdd_notif->query("DELETE FROM notifications where user_ID='".$_POST['user_to_unfollow']."'");
}

 ?>
