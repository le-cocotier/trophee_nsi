<?php

// On vérifie si l'utilisateur fais partie du groupe
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM discussion where ID='".$_GET['id']."'");

$discussion_ID = $_GET['id'];
while ($line = $response->fetchArray()) {
    $users_ID=explode(",", $line["users_ID"]);
    $title = $line['name'];
    if (!in_array($_SESSION["user_ID"], $users_ID)) {
        header('location: /trophee_nsi/page/index/index.php');
    }
}
?>


<link type="text/css" rel="stylesheet" href='/trophee_nsi/css/pages/index_sections/dm.css'>
<div class="content-dm">
    <div class="dm__header">
        <a href='/trophee_nsi/page/index/index.php' class="button is-black">Retour</a>
        <h2><?php echo $title; ?></h2>
    </div>
    <div class="dm__content">
        <!-- On récupère les messages de la discussion -->
        <?php $only_new=false; include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/cible/get_messages.php'; ?>
    </div>
    <div class="dm__footer">
        <form class="form-message" action='/trophee_nsi/cible/send_message.php' method="post">
            <input type="hidden" name="discussion_ID" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="user_ID" value=<?php echo $_SESSION['user_ID']; ?>>
            <input type="hidden" name="type" value="text">
            <input class="input" type="text" name="mess" value="" placeholder="Ecrire un message...">
            <input type="hidden" name="file" value="">
            <input type="hidden" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input class="button is-primary" type="submit" name="" value="Envoyer">
        </form>
        <form class="form-img" action='/trophee_nsi/cible/send_message.php' method="post" enctype="multipart/form-data">
            <input type="hidden" name="discussion_ID" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="user_ID" value=<?php echo $_SESSION['user_ID']; ?>>
            <input type="hidden" name="type" value="file">
            <input type="hidden" name="mess" value="">
            <input type="file" name="file">
            <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input class="button is-white" type="submit" name="" value="Envoyer une image">
        </form>
    </div>
</div>
