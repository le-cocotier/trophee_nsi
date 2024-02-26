<?php
session_start();
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);

// On vérifie si il y a une image à été fournis
$append = $bdd->prepare("INSERT INTO comments(user_ID, post_ID, date, content) VALUES(:user_ID, :post_ID, :date, :content)");
$date = date("Y-m-d H:i:s");
$append->bindValue(':user_ID', $_SESSION['user_ID']);
$append->bindValue(':post_ID', $_POST['post_ID']);
$append->bindValue(':date', $date);
$append->bindValue(':content', $_POST['input']);
$append->execute();

header("location: /page/index/index.php");
?>
