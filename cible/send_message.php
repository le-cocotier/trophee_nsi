<?php

$bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);
// besoin verif isset


if ($_POST['type'] == 'text') {
    
    $_POST['mess'] = htmlspecialchars($_POST['mess']);
    $append = $bdd->prepare("INSERT INTO content(discussion_ID, user_ID, type, mess, date) VALUES(:discussion_ID, :user_ID, :type, :mess, :date)");
    $append->bindValue(':discussion_ID', $_POST['discussion_ID']);
    $append->bindValue(':user_ID', $_POST['user_ID']);
    $append->bindValue(':mess', $_POST['mess']);
    $append->bindValue(':type', $_POST['type']);
    $append->bindValue(':date', $_POST['date']);
    $append->execute();
}
else if ($_POST['type'] == 'file') {

    $append = $bdd->prepare("INSERT INTO content(discussion_ID, user_ID, type, file, size, date) VALUES(:discussion_ID, :user_ID, :type, :file, :size, :date)");
    $append->bindValue(':discussion_ID', $_POST['discussion_ID']);
    $append->bindValue(':user_ID', $_POST['user_ID']);
    $append->bindValue(':file', file_get_contents($_FILES['file']['tmp_name']));
    $append->bindValue(':size', $_FILES['file']['size']);
    $append->bindValue(':type', $_FILES['file']['type']);
    $append->bindValue(':date', $_POST['date']);
    $append->execute();
}

header('location: ../page/index/index.php?content_type=dm&id='.$_POST["discussion_ID"]);
?>
