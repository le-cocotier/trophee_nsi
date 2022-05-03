<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/message.db', SQLITE3_OPEN_READWRITE);
$append = $bdd->exec('UPDATE discussion SET name="'.$_POST["name"].'" where id='.$_POST['ID']);

?>
