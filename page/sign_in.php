<?php
if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['birth_date'])) {
    $bdd = new SQLite3('../database/users.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT * FROM users");

    while ($line = $response->fetchArray()) {
        if (($line["name"] == $_POST['name'] && $line["password"] == $_POST['password']) or ($line["email"] == $_POST['email'] && $line["password"] == $_POST['password'])) {
            session_start();
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['password'] = $_POST['password'];
            header('location: ../page/index.php');
        }
    }
}

echo '<meta http-equiv="refresh" content="0;URL=../page/sign_up.php">';

 ?>
