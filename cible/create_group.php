<?php
if (isset($_POST['name']) && isset($_POST['users'])){
    $bdd = new SQLite3('../database/groupe.db', SQLITE3_OPEN_READWRITE);
    $create = $bdd->prepare("CREATE TABLE ".$_POST['name'] ."('ID' INTEGER NOT NULL, 'user' TEXT, 'type' VARCHAR(20), 'mess' TEXT, 'file' LONGBLOB)");
    $create->execute();

    $append = $bdd->prepare("INSERT INTO liste(name, users) VALUES(:name, :users)");
    $append->bindValue(':name', $_POST['name']);
    $append->bindValue(':users', $_POST['users']);
    $append->execute();
}


 ?>
