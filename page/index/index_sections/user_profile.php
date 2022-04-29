<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT * FROM users where id="'.$_GET['id'].'"');
$line = $response->fetchArray();
 ?>
<link type="text/css" rel="stylesheet" href='/trophee_nsi/css/pages/index_sections/user_profile.css'>
<div class="content-flow">
    <div class="card is-post card-user">
        <div class="card-user__pic">
            <img width="128" height="128" src='data:<?php $stream = $bdd->openBlob('users', 'pp', $line['id']); echo $line['type']; ?>;base64,<?php echo base64_encode(stream_get_contents($stream)); ?>' alt="user_photo">
            <a href="#" class="card-user__pic__follow"><?php echo $line['subscriptions']. ' abonnements'; ?></a>
            <a href="#" class="card-user__pic__follow"><?php echo $line['subscribers']. ' abonnés'; ?></a>
        </div>
        <div class="card-user__text">
            <h3><?php echo $line['name'] ?></h3>
            <!--prendre dans $_GET["id"] l'id du mec voulu-->
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus recusandae nihil laborum similique consequuntur placeat ad doloribus dolor officiis quibusdam quisquam aperiam amet exercitationem vero a cum, ipsa neque sint!</p>
        </div>
    </div>
    <div class="posts">
        <?php //get_posts utilisateur ?>
    </div>
</div>
