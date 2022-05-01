<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// On vérifie si l'utilisateur fais partie du groupe
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM discussion where ID='".$_GET['id']."'");

$discussion_ID = $_GET['id'];
$line = $response->fetchArray();
$users_ID=explode(",", $line["users_ID"]);
$title = $line['name'];
if (!in_array($_SESSION["user_ID"], $users_ID)) {
    header('location: /trophee_nsi/page/index/index.php');
}
?>

<div class="content-dm">
    <div class="dm__header">
        <a href='/trophee_nsi/page/index/index.php' class="button is-black">Retour</a>
        <h2 id="discussion_title"><?php echo $title; ?></h2>
        <?php if ($line['admin'] == $_SESSION['user_ID']) {
        echo <<<HTML
        <div >
            <div >
                <button type='button' class="button">...</button>
            </div>
            <div >
                <button type="button" onclick="rename()">Renommer</button>
                <button type="button" >Ajouter quelqu'un</button>
                <hr>
                <button type="button">Supprimer le groupe</button>
            </div>
        </div>
        HTML;
        } ?>
    </div>
    <script type="text/javascript">
        function rename() {
            document.getElementById('discussion_title').innerHTML = '<input type="text" value="'+document.getElementById('discussion_title').innerText+'"></input>';
        }
    </script>
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
            <input class="button is-white" type="submit" name="" value="Envoyer l'image">
        </form>
    </div>
</div>
