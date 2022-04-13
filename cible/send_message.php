<?php
$bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);
print_r($_POST);

$append = $bdd->prepare("INSERT INTO content(discussion, user, type, mess, date) VALUES(:discussion, :user, :type, :mess, :date)");
$append->bindValue(':discussion', $_POST['discussion']);
$append->bindValue(':user', $_POST['user']);
$append->bindValue(':mess', $_POST['mess']);
$append->bindValue(':type', $_POST['type']);
$append->bindValue(':date', $_POST['date']);
$append->execute();

 ?>
