<header>
    <a class="header__left" href="/trophee_nsi/page/index">
        <img width="28" height="28" class="container__brand" src='/trophee_nsi/img/logo.png' alt="Logo">
        <h1>Lambda</h1>
    </a>
    <nav class="header__right">
        <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])){ ?>
            <!--searchbar-->
            <div class="dropdown">
                <div class="dropdown__item">
                    <input id="search_user" class="input" type="text" name="search_user" onkeyup="search_user()">
                </div>
                <div id="search_user__list" class="dropdown__panel overflow">

                </div>
            </div>
            <script type="text/javascript">
                function search_user() {
                    let panel = document.getElementById('search_user__list');
                    panel.innerHTML = "";
                    let input = document.getElementById('search_user').value;
                    if (input!=""){
                        panel.classList.add('show');
                        let data = new FormData();
                        input=input.toLowerCase();
                        data.append('letters', input);
                        data.append('user_ID', <?php echo $_SESSION['user_ID'] ?>);
                        let xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = () => {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                let response = JSON.parse(xhr.response);
                                for (var i = 0; i < response['name'].length; i++) {
                                    document.getElementById("search_user__list").innerHTML+="<a class='dropdown__panel__item' href='/trophee_nsi/page/index/index.php?content_type=user&id="+response['id'][i]+"'>"+response['name'][i]+"</a>";
                                }
                            }
                        }
                        xhr.open("POST", '/trophee_nsi/cible/get_users.php', true);
                        xhr.send(data);
                    } else panel.classList.remove('show');
                }
            </script>

            <!--Boutton Notification-->
            <div class="dropdown hover header__right__item">
                <img class="dropdown__item" width="28" height="28" src="../../img/notif.png" alt="notif">
                <div class="dropdown__panel overflow">
                    <?php
                        $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/notifications.db');
                        $response = $bdd->query("SELECT * FROM notifications where user_ID='".$_SESSION['user_ID']."' ORDER BY ID DESC LIMIT 10");
                        while($line = $response->fetchArray()){
                            if($line['type'] == 'follow'){ ?>
                                <a class="dropdown__panel__item" onclick="sup_notif(<?php echo $line['ID']; ?>)" href="/trophee_nsi/page/index?content_type=user&id=<?php echo $line['user_concerning']; ?>">
                                    <?php echo get_username($line['user_concerning']); ?> a commencé à vous suivre
                                </a>
                    <?php   }
                            if($line['type'] == 'follow request'){ ?>
                                <a class="dropdown__panel__item" href="/trophee_nsi/page/index?content_type=user&id=<?php echo $line['user_concerning']; ?>">
                                    <?php echo get_username($line['user_concerning']); ?> a demandé à vous suivre 
                                    <br>
                                    <a class="button is-primary" onclick="accept(<?php echo $line['user_concerning'];?>, <?php echo $_SESSION['user_ID']; ?>, <?php echo $line['ID']; ?>)" href="#">Accepter</a>
                                </a>
                    <?php } } ?>
                </div>
            </div>

            <!--Boutton Utilisateur-->
            <div class="dropdown hover header__right__item">
                <div class="dropdown__item">
                    <img width="28" height="28" src=<?php echo get_pp_src($_SESSION['user_ID']); ?> alt="user_photo">
                    <p><?php echo $_SESSION['name']; ?></p>
                </div>
                <div class="dropdown__panel">
                    <a class="dropdown__panel__item" href="/trophee_nsi/page/index?content_type=user&id=<?php echo $_SESSION['user_ID']; ?>">Mon profil</a>
                    <a class="dropdown__panel__item" href="/trophee_nsi/page/index?content_type=settings">Options</a>
                    <hr>
                    <a class="dropdown__panel__item red" href="/trophee_nsi/page/sign_in.php">Se déconnecter</a>
                </div>
            </div>
        <?php }else{?>
            <a href="/trophee_nsi/page/sign_in.php" class="button is-primary">Se connecter</a>
        <?php }?>
    </nav>
</header>

<script type="text/javascript">
    function sup_notif(ID_sup, user_send) {
        console.log(ID_sup);
        let data = new FormData();
        data.append('ID_sup', ID_sup);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                window.location.assign("/trophee_nsi/page/index?content_type=user&id="+user_send);
            }
        }
        xhr.open("POST", '/trophee_nsi/cible/delete_notif_view.php', true);
        xhr.send(data);
    }

    function accept(user_send, user_to_follow, ID_delete_notif) {
        let data = new FormData();
        data.append('user_to_follow', user_to_follow);
        data.append('user', user_send);
        data.append('accept_user', 'true');
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.response);
                sup_notif(ID_delete_notif, user_send);
            }
        }
        xhr.open("POST", '/trophee_nsi/cible/follow.php', true);
        xhr.send(data);
    }
</script>
