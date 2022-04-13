<?php


if (isset($_POST['name']) && isset($_POST['password'])) {
    $bdd = new SQLite3('../database/users.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT * FROM users where name='".$_POST['name']."'");

    $line = $response->fetchArray();
    if ($line !='') {
        if ($line["password"] == $_POST["password"]) {
            session_start();
            $_SESSION['name'] = $line['name'];
            $_SESSION['password'] = $line['password'];
        }
        else {
            print_r("password");
        }
    }
    else {
        print_r("username");
    }
}
?>
