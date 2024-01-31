<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db');

$user_names = implode("','",explode(",", $_POST['new_user']));
$user_IDs = [];
$query = "SELECT id from users where name in ('$user_names')";
$response = $bdd->query($query);
while ($line = $response->fetchArray()) {
    array_push($user_IDs, $line['id']);
}
if (count($user_IDs) > 0) {
    $append = $bdd->exec('UPDATE discussion SET users_ID="'.$_POST["users_ID"].','.implode(',',$user_IDs).'" where id='.$_POST['ID']);
}


?>
