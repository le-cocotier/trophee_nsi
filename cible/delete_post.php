<?php
echo "hello";
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/posts.db', SQLITE3_OPEN_READWRITE);
$request = $bdd->exec("DELETE FROM posts where ID=".$_POST['ID']);
var_dump($_POST);
?>