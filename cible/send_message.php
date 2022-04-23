<?php

$bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);

if ($_POST['type'] == 'text') {

    $append = $bdd->prepare("INSERT INTO content(discussion, user, type, mess, date) VALUES(:discussion, :user, :type, :mess, :date)");
    $append->bindValue(':discussion', $_POST['discussion']);
    $append->bindValue(':user', $_POST['user']);
    $append->bindValue(':mess', $_POST['mess']);
    $append->bindValue(':type', $_POST['type']);
    $append->bindValue(':date', $_POST['date']);
    $append->execute();
}
else if ($_POST['type'] == 'file') {

    $append = $bdd->prepare("INSERT INTO content(discussion, user, type, file, size, date) VALUES(:discussion, :user, :type, :file, :size, :date)");
    $append->bindValue(':discussion', $_POST['discussion']);
    $append->bindValue(':user', $_POST['user']);
    $append->bindValue(':file', file_get_contents($_FILES['file']['tmp_name']));
    $append->bindValue(':size', $_FILES['file']['size']);
    $append->bindValue(':type', $_FILES['file']['type']);
    $append->bindValue(':date', $_POST['date']);
    $append->execute();
}
?>
