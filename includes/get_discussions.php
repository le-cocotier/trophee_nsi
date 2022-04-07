<?php
$bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM discussion");

while ($line = $response->fetchArray()) {
    $users = explode(",", $line["users"]);
    if (in_array($_SESSION["name"], $users)) {
        $get=$line['ID'];
        $pp="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png";
        $name=$line['name'];
        $message='Dernier message de la discussion';
        include('discussion.php');
    }
}

 ?>
