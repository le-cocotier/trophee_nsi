<?php
include '../config.php';
$bdd = new SQLite3(SITE_ROOT.'/database/main.db', SQLITE3_OPEN_READWRITE);
$append = $bdd->exec("DELETE FROM discussion where id=".$_POST['ID']);
$response = $bdd->query('SELECT * FROM content where discussion_ID='.$_POST['ID']);
if ($line = $response->fetchArray()){
    $append = $bdd->exec("DELETE FROM content where discussion_ID=".$_POST['ID']);
}
?>
