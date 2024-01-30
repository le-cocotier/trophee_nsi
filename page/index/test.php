<?php 
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/main.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT pp FROM users where id='1'");
$line = $response->fetchArray();

if ($line != NULL){
    var_dump($line);
    $blob = stream_get_contents($bdd->openBlob("users", 'pp', "1"));
    echo base64_encode($blob);
}

?>
