<?php


if (isset($_POST['name']) && isset($_POST['password'])) {
    $error = ["error"=>array()];
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query('SELECT * FROM users where name="'.$_POST['name'].'"');

    $line = $response->fetchArray();
    if ($line !='') {
        if ($line["password"] == sha1($_POST["password"])) {
            session_start();
            $_SESSION['user_ID'] = $line['id'];
            $_SESSION['name'] = $line['name'];
            $_SESSION['password'] = $line['password'];
        }
        else {
            array_push($error['error'], "password");
        }
    }
    else {
        array_push($error['error'], "username");
    }
    if (count($error['error']) != 0) {
        print_r(json_encode($error));
    }
}
?>
