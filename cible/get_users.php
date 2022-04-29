<?php

$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
$query = 'SELECT name,id FROM users where name LIKE "%'.$_POST['letters'].'%" EXCEPT SELECT name, id FROM users where id="'.$_POST['user_ID'].'" LIMIT 10';
$response = $bdd->query($query);

$liste_of_users=['id'=>[], 'name'=>[]];

while ($line = $response->fetchArray()) {
    array_push($liste_of_users['name'],$line['name']);
    array_push($liste_of_users['id'], $line['id']);
}

print_r(json_encode($liste_of_users));
 ?>
