<?php
include 'functions.php';
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);

if ($_POST['type'] == 'text') {
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
    $source = $_FILES["file"]["tmp_name"];
    $size = filesize($_FILES['file']['tmp_name']);
    $i = 1;
    while ($size > 200000){
        $response = compressImage($source, $_FILES['file']['tmp_name'].$i, 85 - $i*5);
        $size = filesize($_FILES['file']['tmp_name'].$i);
        $i+=1;
    }
    if (isset($response)){
        $append->bindValue(':file', file_get_contents($response));
    } else {
        $append->bindValue(':file', file_get_contents($source));
    }
    $append->bindValue(':size', $size);
    $append->bindValue(':type', $_FILES['file']['type']);
    $append->bindValue(':date', $_POST['date']);
    $append->execute();
}

header('location: /page/index/index.php?content_type=dm&id='.$_POST["discussion_ID"]);
?>
