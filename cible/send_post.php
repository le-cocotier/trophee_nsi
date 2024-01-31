<?php

// Compress image
function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    }
    elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    }
    elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    }
    imagejpeg($image, $destination, $quality);
    return $destination;
}

$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);

// On si une image à été fournis
if ($_FILES['image']['error'] == 0){
    $source = $_FILES["image"]["tmp_name"];
    $size = filesize($_FILES['image']['tmp_name']);
    $i = 1;
    while ($size > 200000){
        $response = compressImage($source, $_FILES['image']['tmp_name'].$i, 85 - $i*5);
        $size = filesize($_FILES['image']['tmp_name'].$i);
        $i+=1;
        echo $size." ";
    }
    $append = $bdd->prepare("INSERT INTO posts(title, user, content, image, type, size, date) VALUES(:title, :user, :content, :image, :type, :size, :date)");
    $append->bindValue(':image', file_get_contents($response));
    $append->bindValue(':size', filesize($_FILES['image']['tmp_name'].$i-1));
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

header('location: /page/index/index.php');
?>
