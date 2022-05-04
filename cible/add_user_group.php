<?php
$bdd_user = new SQLite3('../database/users.db');

$user_names = implode("','",explode(",", $_POST['new_user']));
$user_IDs = [];
$query = "SELECT id from users where name in ('$user_names')";
$response = $bdd_user->query($query);
while ($line = $response->fetchArray()) {
    array_push($user_IDs, $line['id']);
}
if (count($user_IDs) > 0) {
    $bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);
    $append = $bdd->exec('UPDATE discussion SET users_ID="'.$_POST["users_ID"].','.implode(',',$user_IDs).'" where id='.$_POST['ID']);
}


?>
