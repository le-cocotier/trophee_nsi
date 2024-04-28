<?php 
session_start(); include 'functions.php';

$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
if (!is_up_vote($_POST['ID'], $_SESSION['user_ID'])){
	echo 'like';
	$append = $bdd->prepare("UPDATE posts SET up_vote=up_vote || :user WHERE ID=:ID");
	$append->bindValue(':user', $_SESSION['user_ID'] .',');
	$append->bindValue(':ID', $_POST['ID']);

	$append->execute();
} else {
	$id = $_POST['ID'];
	$query = $bdd->query("SELECT up_vote FROM posts where ID=$id");
	$likes = $query->fetchArray()["up_vote"];
	$likes = explode(',', $likes);
	$likes = array_diff($likes, array((string) $_SESSION['user_ID'], ",", ""));
	$append = $bdd->prepare("UPDATE posts SET up_vote=:likes WHERE ID=:ID || ','");
	$append->bindValue(':likes', implode(',', $likes));
	$append->bindValue(':ID', $_POST['ID']);

	$append->execute();
}

 ?>
