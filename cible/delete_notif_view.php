<?php
if($_POST['accept_user']=='true'){
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db');
    $response = $bdd->query("DELETE FROM notifications WHERE id='".$_GET['id_to_delete']."'");
    $line = $response->fetchArray();
}
else{
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db');
    $response = $bdd->query("DELETE FROM notifications WHERE id='".$_POST['ID_sup']."'");
    $line = $response->fetchArray();
}
?>