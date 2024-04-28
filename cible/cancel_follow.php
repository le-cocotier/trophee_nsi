<?php
include '../config.php';
include SITE_ROOT.'/cible/functions.php';

$bdd = new SQLite3(SITE_ROOT.'/database/main.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->exec("DELETE FROM notifications where user_ID=".$_POST['user_to_cancel']." AND user_concerning=".$_POST['user']." AND type='follow request'");
print_r(json_encode(["state"=>"cancelled"]));
 ?>
