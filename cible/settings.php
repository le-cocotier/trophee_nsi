<?php
session_start();
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT password FROM users where id="'.$_SESSION["user_ID"].'"');
$password = $response->fetchArray()['password'];
if (sha1($_POST['password']) == $password) {
    $image = "";
    if ($_FILES['image']['error'] == 0){
        $image = 'type=:type, pp=:pp,';
    }
    $append = $bdd->prepare('UPDATE users SET name=:name, description=:description, email=:email,'.$image.' public=:public where id="'.$_SESSION["user_ID"].'"');
    $append->bindValue(':name', $_POST['name']);
    $append->bindValue(':email', $_POST['email']);
    $append->bindValue(':description',$_POST['description']);

    if ($_FILES['image']['error'] == 0) {
        $append->bindValue(':pp', file_get_contents($_FILES['image']['tmp_name']));
        $append->bindValue(':type', $_FILES['image']['type']);
    }
    if (isset($_POST['public'])) {
        $append->bindValue(':public', 'true');
    }
    else {
        $append->bindValue(':public', 'false');
    }
    $append->execute();
    $_SESSION['name'] = $_POST['name'];
}



header('location: /trophee_nsi/page/index/index.php?content_type=settings');
?>
