<?php
//renvoie le nom de l'utilisateuren fonction de son user_IDs

function get_username($ID){
    $bdd_user = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd_user->query("SELECT name FROM users where id='$ID'");
    return ($response->fetchArray())['name'];
}

function get_pp_src($ID) {
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT type FROM users where id='$ID'");
    $line = $response->fetchArray();
    $stream = $bdd->openBlob('users', 'pp', $ID);
    return "'data:".$line['type'] .";base64,".base64_encode(stream_get_contents($stream))."'";
}
 ?>
