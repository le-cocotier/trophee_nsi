<?php


if (isset($_POST['name']) && isset($_POST['password'])) {
    $bdd = new SQLite3('../database/users.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT * FROM users");

    while ($line = $response->fetchArray()) {
        if (($line["name"] == $_POST['name']) || ($line["email"] == $_POST['name'])) {
            if ($line["password"] == $_POST["password"]) {
                session_start();
                $_SESSION['name'] = $line['name'];
                $_SESSION['password'] = $line['password'];
            }
            else {
                print_r(json_encode("{error: 'password'}"));
            }
        }
        else {
            print_r(json_encode("{error: 'name'}"));
        }
    }
}
?>
