<?php
session_start();
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM discussion where ID=".$_GET['discussion']);

while ($line = $response->fetchArray()) {
    $users=explode(",", $line["users"]);
    $title = $line['name'];
    if (!in_array($_SESSION["name"], $users)) {
        header('location: '.$_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Document</title>
    </head>
    <body>
        <h1><?php echo $title; ?></h1>
        <form class="" action='/trophee_nsi/cible/send_message.php' method="post">
            <input type="hidden" name="discussion" value="<?php echo $title; ?>">
            <input type="hidden" name="user" value=<?php echo $_SESSION['name']; ?>>
            <input type="hidden" name="type" value="text">
            <input type="text" name="mess" value="message">
            <input type="hidden" name="file" value="">
            <input type="hidden" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="submit" name="" value="send">
        </form>
        <form class="" action='/trophee_nsi/cible/send_message.php' method="post" enctype="multipart/form-data">
            <input type="hidden" name="discussion" value="<?php echo $title; ?>">
            <input type="hidden" name="user" value=<?php echo $_SESSION['name']; ?>>
            <input type="hidden" name="type" value="file">
            <input type="hidden" name="mess" value="">
            <input type="file" name="file">
            <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="submit" name="" value="send">
        </form>
        <p><?php $only_new=false; include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/cible/get_messages.php'; ?></p>
    </body>
</html>
