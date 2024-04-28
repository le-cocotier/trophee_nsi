<?php
include '../config.php';
include 'functions.php';
$bdd = new SQLite3(SITE_ROOT.'/database/main.db', SQLITE3_OPEN_READWRITE);

// On vérifie si il y a une image à été fournis
if ($_FILES['image']['error'] == 0){
    $source = $_FILES["image"]["tmp_name"];
    $size = filesize($_FILES['image']['tmp_name']);
    $i = 1;
    while ($size > 200000){
        $response = compressImage($source, $_FILES['image']['tmp_name'].$i, 85 - $i*5);
        $size = filesize($_FILES['image']['tmp_name'].$i);
        $i+=1;
    }
    $append = $bdd->prepare("INSERT INTO posts(title, user, content, image, type, size, date) VALUES(:title, :user, :content, :image, :type, :size, :date)");
    if (isset($response)){
        $append->bindValue(':image', file_get_contents($response));        
    } else {
        $append->bindValue(':image', file_get_contents($source));
    }
    $append->bindValue(':size', $size);
    $append->bindValue(':type', $_FILES['image']['type']);
}
else {
    $append = $bdd->prepare("INSERT INTO posts(title, user, content, date) VALUES(:title, :user, :content, :date)");
}
$append->bindValue(':title', $_POST['title']);
$append->bindValue(':user', $_POST['user']);

$append->bindValue(':content', $_POST['content']);

$append->bindValue(':date', $_POST['date']);
$append->execute();

header('location: '.SITE_URL.'/page/index/index.php');
?>
