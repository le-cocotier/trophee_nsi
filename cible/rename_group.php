<?php
$bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);
$append = $bdd->exec('UPDATE discussion SET name="'.$_POST["name"].'" where id='.$_POST['ID']);

?>
