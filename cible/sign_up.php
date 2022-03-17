<?php
if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['birth_date'])) {
    $bdd = new SQLite3('../database/users.db', SQLITE3_OPEN_READWRITE);

    $response = $bdd->query("SELECT * FROM users");

    while ($line = $response->fetchArray()) {
        if ($line["name"] == $_POST['name']) {
            echo "name";
            exit();
        }
        elseif ($line["email"] == $_POST['email']){
            echo "email";
            exit();
        }
    }

    // Si le nom d'utilisateur et l'email n'est pas utilisé on peut créer le compte

    $append = $bdd->prepare("INSERT INTO users(name, password, email, birth_date) VALUES(:name, :password, :email, :birth_date)");

    $append->bindValue(':name', $_POST['name']);
    $append->bindValue(':password', $_POST['password']);
    $append->bindValue(':email', $_POST['email']);
    $append->bindValue(':birth_date', $_POST['birth_date']);

    $append->execute();
}
 ?>

<!-- créer un compte.

Si erreur la page renvoie l'info erronée.
-->
