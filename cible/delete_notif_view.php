<?php
$bdd = new SQLite3('../database/notifications.db');
$response = $bdd->exec("DELETE FROM notifications WHERE id='".$_POST['ID_sup']."'");
?>
