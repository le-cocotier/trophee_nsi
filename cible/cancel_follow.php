<?php
include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/cible/functions.php';

$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->exec("DELETE FROM notifications where user_ID=".$_POST['user_to_cancel']." AND user_concerning=".$_POST['user']." AND type='follow request'");
print_r(json_encode(["state"=>"cancelled"]));
 ?>
