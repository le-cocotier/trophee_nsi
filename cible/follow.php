<?php
include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/cible/functions.php';
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT public FROM users where id='".$_POST['user_to_follow']."'");
$public = $response->fetchArray()['public'];
if(isset($_POST['accept_user']) && $_POST['accept_user']=='true'){
    $bdd_notif = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db', SQLITE3_OPEN_READWRITE);
    $append = $bdd_notif->prepare("INSERT INTO notifications(user_ID, type, user_concerning) VALUES(:user_ID, :type, :user_concerning)");
    $append->bindValue(':user_ID', $_POST['user_to_follow']);
    $append->bindValue(':type', 'follow');
    $append->bindValue(':user_concerning', $_POST['user']);
    $append->execute();

    $response = $bdd->query("SELECT subscribers FROM users where id='".$_POST['user_to_follow']."'");
    $nb_subscribers = $response->fetchArray()['subscribers'];
    $nb_subscribers+=1;
    $response = $bdd->exec("UPDATE users SET subscribers=".$nb_subscribers." where id='".$_POST['user_to_follow']."'");

    $response = $bdd->query("SELECT subscriptions FROM users where id='".$_POST['user']."'");
    $nb_subscriptions = $response->fetchArray()['subscriptions'];
    $nb_subscriptions+=1;
    $liste_of_friends = get_friends($_POST['user']);
    array_push($liste_of_friends, $_POST['user_to_follow']);
    $liste_of_friends = implode(',', $liste_of_friends);
    $response = $bdd->exec("UPDATE users SET subscriptions=".$nb_subscriptions.", friends='".$liste_of_friends."' where id='".$_POST['user']."'");
    print_r(json_encode(["state"=>"followed"]));
}
elseif ($public == 'false') {
    $bdd_notif = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db', SQLITE3_OPEN_READWRITE);
    $append = $bdd_notif->prepare("INSERT INTO notifications(user_ID, type, user_concerning) VALUES(:user_ID, :type, :user_concerning)");
    $append->bindValue(':user_ID', $_POST['user_to_follow']);
    $append->bindValue(':type', 'follow request');
    $append->bindValue(':user_concerning', $_POST['user']);
    $append->execute();
    print_r(json_encode(["state"=>"requested"]));
}

else {
    $bdd_notif = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db', SQLITE3_OPEN_READWRITE);
    $append = $bdd_notif->prepare("INSERT INTO notifications(user_ID, type, user_concerning) VALUES(:user_ID, :type, :user_concerning)");
    $append->bindValue(':user_ID', $_POST['user_to_follow']);
    $append->bindValue(':type', 'follow');
    $append->bindValue(':user_concerning', $_POST['user']);
    $append->execute();

    $response = $bdd->query("SELECT subscribers FROM users where id='".$_POST['user_to_follow']."'");
    $nb_subscribers = $response->fetchArray()['subscribers'];
    $nb_subscribers+=1;
    $response = $bdd->exec("UPDATE users SET subscribers=".$nb_subscribers." where id='".$_POST['user_to_follow']."'");

    $response = $bdd->query("SELECT subscriptions FROM users where id='".$_POST['user']."'");
    $nb_subscriptions = $response->fetchArray()['subscriptions'];
    $nb_subscriptions+=1;
    $liste_of_friends = get_friends($_POST['user']);
    array_push($liste_of_friends, $_POST['user_to_follow']);
    $liste_of_friends = implode(',', $liste_of_friends);
    $response = $bdd->exec("UPDATE users SET subscriptions=".$nb_subscriptions.", friends='".$liste_of_friends."' where id='".$_POST['user']."'");
    print_r(json_encode(["state"=>"followed"]));
}
 ?>
