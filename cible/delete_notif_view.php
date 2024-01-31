<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db');
$response = $bdd->exec("DELETE FROM notifications WHERE id='".$_POST['ID_sup']."'");
?>