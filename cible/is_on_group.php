<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT users_ID FROM discussion where id='.$_POST['discussion']);
print_r(json_encode($response->fetchArray()));

?>
