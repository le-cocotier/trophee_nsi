<?php
session_start();
if (isset($_POST['name']) && isset($_POST['users'])){
    $bdd_user = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db');

    $user_names = implode("','",explode(",", $_POST['users']));
    $user_IDs = [$_SESSION['user_ID']];
    $query = "SELECT id from users where name in ('$user_names')";
    $response = $bdd_user->query($query);
    while ($line = $response->fetchArray()) {
        array_push($user_IDs, $line['id']);
    }

    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/message.db', SQLITE3_OPEN_READWRITE);

    $append = $bdd->prepare("INSERT INTO discussion(name, users_ID, 'group') VALUES(:name, :users_ID, :group)");
    $append->bindValue(':name', $_POST['name']);
    if (count($user_IDs) >2){
        $group = 'true';
    }
    else {
        $group = 'false';
    }
    $append->bindValue(':group', $group);
    $append->bindValue(':users_ID', implode(',', $user_IDs));
    $append->execute();

    $response = $bdd->query("SELECT ID from discussion where name='".$_POST['name'] ."'");

    header('location: /trophee_nsi/page/index/index.php?content_type=dm&id='.($response->fetchArray())['ID']);
}


 ?>
