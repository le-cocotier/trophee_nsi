<?php
include 'functions.php';

$bdd = new SQLite3('../database/notifications.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->exec("DELETE FROM notifications where user_ID=".$_POST['user_to_cancel']." AND user_concerning=".$_POST['user']." AND type='follow request'");
print_r(json_encode(["state"=>"cancelled"]));
 ?>
