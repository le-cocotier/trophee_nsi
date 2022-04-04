<?php
if (isset($_POST['name']) && isset($_POST['users'])){
    $bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);

    $append = $bdd->prepare("INSERT INTO discussion(name, users) VALUES(:name, :users)");
    $append->bindValue(':name', $_POST['name']);
    $append->bindValue(':users', $_POST['users']);
    $append->execute();
}


 ?>
