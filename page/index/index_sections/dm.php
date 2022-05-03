<?php
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
        <div class="dropdown hover">
            <div class="dropdown__item">
                <span type='button' class="button">...</span>
            </div>
            <div class="dropdown__panel left">
                <a class='dropdown__panel__item' href="#" type="button">Renommer</a>
                <a class='dropdown__panel__item' href="#" type="button" >Ajouter quelqu'un</a>
                <hr>
                <a class='dropdown__panel__item' href="#" type="button" onclick='delete_group()'>Supprimer le groupe</a>
            </div>
        </div>
        HTML;
        } ?>
    </div>
    <script type="text/javascript">
        function rename() {
            document.getElementById('discussion_title').innerHTML = '<input class="input" type="text" value="'+document.getElementById('discussion_title').innerText+'"></input>';
        }

        function delete_group() {
            let xhr = new XMLHttpRequest();
            let data = new FormData();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    window.location.assign('/trophee_nsi/page/index/index.php');
                }
            }
            data.append('ID', <?php echo $_GET['id']; ?>);
            xhr.open("POST", '/trophee_nsi/cible/delete_group.php', true);
            xhr.send(data);
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
            <input class="input" type="text" name="mess" value="" placeholder="Ecrire un message..." required>
            <input type="hidden" name="file" value="">
            <input type="hidden" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input class="button is-primary" type="submit" name="" value="Envoyer">
        </form>
        <form class="form-img" action='/trophee_nsi/cible/send_message.php' method="post" enctype="multipart/form-data">
            <input type="hidden" name="discussion_ID" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="user_ID" value=<?php echo $_SESSION['user_ID']; ?>>
            <input type="hidden" name="type" value="file">
            <input type="hidden" name="mess" value="">
            <input type="file" name="file" required>
            <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input class="button is-white" type="submit" name="" value="Envoyer l'image">
        </form>
    </div>
</div>
