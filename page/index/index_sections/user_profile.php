<?php
if (isset($_GET['id']) && $_GET['id'] != ""){
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query('SELECT * FROM users where id="'.$_GET['id'].'"');
    $line = $response->fetchArray();
     ?>
    <div class="content-flow">
        <div class="card is-post card-user">
            <div class="card-user__pic">
                <img width="128" height="128" src='data:<?php $stream = $bdd->openBlob('users', 'pp', $line['id']); echo $line['type']; ?>;base64,<?php echo base64_encode(stream_get_contents($stream)); ?>' alt="user_photo">
                <a href="#" class="card-user__pic__follow"><?php echo $line['subscriptions']. ' abonnements'; ?></a>
                <a href="#" class="card-user__pic__follow"><?php echo $line['subscribers']. ' abonnés'; ?></a>
                <?php if (isset($_SESSION['name']) && isset($_SESSION['password']) && $_GET['id'] != $_SESSION['user_ID']) {
                    if (!in_array($_GET['id'], get_friends($_SESSION['user_ID']))){
                        $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db');
                        $query = "SELECT * FROM notifications where user_ID=".$_GET['id']." AND user_concerning=".$_SESSION['user_ID']." AND type='follow request'";
                        $response = $bdd->query($query);
                        if ($response->fetchArray() == false){
                            echo "<button id='follow' class='button is-primary' type='button' onclick='follow()'>S'abonner</button>";

                        }
                        else {
                            echo "<button id='follow' class='button is-alert' type='button' onclick='cancel_follow()'>Annuler la demande</button>";

                        }
                    }
                    else {
                        echo "<button id='follow' class='button is-error' type='button' onclick='unfollow()'>Se désabonner</button>";
                    }
                } ?>
            </div>
            <div class="card-user__text">
                <h3><?php echo $line['name'] ?></h3>
                <p><?php echo $line['description']; ?></p>
            </div>
        </div>
        <div class="posts">
            <?php
             if ($line['public'] == 'true' OR in_array($_GET['id'], get_friends($_SESSION['user_ID'])) OR $_GET['id'] == $_SESSION['user_ID']){
                echo get_user_posts($line['id']);
            }
            else {
                echo 'Ce compte est privée';
            }
             ?>
        </div>
    </div>

    <?php if (isset($_SESSION['name']) && isset($_SESSION['password']) && $_GET['id'] != $_SESSION['user_ID']) {?>
        <script type="text/javascript">
            function follow() {
                let xhr = new XMLHttpRequest();
                let data = new FormData();
                data.append('user_to_follow', <?php echo $_GET['id']; ?>);
                data.append('user', <?php echo $_SESSION['user_ID']; ?>);
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.response);
                        console.log(response['state']);
                        if (response['state'] == 'followed') {
                            document.getElementById('follow').setAttribute('onclick', 'unfollow()');
                            document.getElementById('follow').classList = ['button is-error'];
                            document.getElementById('follow').innerText = 'se désabonner';
                        }
                        else {
                            document.getElementById('follow').setAttribute('onclick', 'cancel_follow()');
                            document.getElementById('follow').classList = ['button is-alert'];
                            document.getElementById('follow').innerText = 'annuler la demande';
                        }
                    }
                }
                xhr.open("POST", '/trophee_nsi/cible/follow.php', true);
                xhr.send(data);
            }
            function unfollow(){
                let xhr = new XMLHttpRequest();
                let data = new FormData();
                data.append('user_to_unfollow', <?php echo $_GET['id']; ?>);
                data.append('user', <?php echo $_SESSION['user_ID']; ?>);
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.response);
                        if (response['state'] = 'unfollowed') {
                            document.getElementById('follow').setAttribute('onclick', 'follow()');
                            document.getElementById('follow').classList = ['button is-primary'];

                            document.getElementById('follow').innerText = "s'abonner";
                        }
                    }
                }
                xhr.open("POST", '/trophee_nsi/cible/unfollow.php', true);
                xhr.send(data);
            }
            function cancel_follow() {
                let xhr = new XMLHttpRequest();
                let data = new FormData();
                data.append('user_to_cancel', <?php echo $_GET['id']; ?>);
                data.append('user', <?php echo $_SESSION['user_ID']; ?>);
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.response);
                        if (response['state'] = 'cancelled') {
                            document.getElementById('follow').setAttribute('onclick', 'follow()');
                            document.getElementById('follow').classList = ['button is-primary'];

                            document.getElementById('follow').innerText = "s'abonner";
                        }
                    }
                }
                xhr.open("POST", '/trophee_nsi/cible/cancel_follow.php', true);
                xhr.send(data);
            }
        </script>
    <?php }
}
else{
    ?>
<script type="text/javascript">
    window.location.assign('/trophee_nsi/page/index/index.php');
</script>
    <?php
}
