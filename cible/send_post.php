<?php

$bdd = new SQLite3('../database/posts.db', SQLITE3_OPEN_READWRITE);

if ($_FILES['image']['error'] == 0){
    $append = $bdd->prepare("INSERT INTO posts(title, user, content, image, type, size, date) VALUES(:title, :user, :content, :image, :type, :size, :date)");
    $append->bindValue(':image', file_get_contents($_FILES['image']['tmp_name']));
    $append->bindValue(':size', $_FILES['image']['size']);
    $append->bindValue(':type', $_FILES['image']['type']);
}
else {
    // besoin verif isset
    $_POST['title'] = htmlspecialchars($_POST['title']);
    $_POST['user'] = htmlspecialchars($_POST['user']);
    $_POST['content'] = htmlspecialchars($_POST['content']);
    
    $append = $bdd->prepare("INSERT INTO posts(title, user, content, date) VALUES(:title, :user, :content, :date)");

}
$append->bindValue(':title', $_POST['title']);
$append->bindValue(':user', $_POST['user']);

$append->bindValue(':content', $_POST['content']);

$append->bindValue(':date', $_POST['date']);
$append->execute();

header('location: ../page/index/index.php')
?>
