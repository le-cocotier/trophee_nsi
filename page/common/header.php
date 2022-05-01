<header>
    <a class="header__left" href="/trophee_nsi/page/index">
        <img width="48" height="48" class="container__brand" src='/trophee_nsi/img/logo.png' alt="Logo">
        <h1>Lorem</h1>
    </a>
    <nav class="header__right">
        <?php
        if (isset($_SESSION['name']) && isset($_SESSION['password'])){ ?>
            <input id="search_user" class="input" type="text" name="search_user" onkeyup="search_user()">
            <ul id="search_user__list">

            </ul>
            <script type="text/javascript">
                function search_user() {
                    document.getElementById('search_user__list').innerHTML = "";
                    let input = document.getElementById('search_user').value;
                    if (input!=""){
                        let data = new FormData();
                        input=input.toLowerCase();
                        data.append('letters', input);
                        data.append('user_ID', <?php echo $_SESSION['user_ID'] ?>);

                        let xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = () => {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                let response = JSON.parse(xhr.response);
                                for (var i = 0; i < response['name'].length; i++) {
                                    document.getElementById("search_user__list").innerHTML+="<li><a href='/trophee_nsi/page/index/index.php?content_type=user&id="+response['id'][i]+"'>"+response['name'][i]+"</a></li>";

                                }
                            }
                        }
                        xhr.open("POST", '/trophee_nsi/cible/get_users.php', true);
                        xhr.send(data);
                    }

                }
            </script>
            <img onclick="changeRightMenu('__dm')" id="dm-button" class="header__right__item active" width="28" height="28" src="../../img/messages.png" alt="messages">
            <img onclick="changeRightMenu('__groups')" id="groups-button" class="header__right__item" width="28" height="28" src="../../img/groups.png" alt="groupes">
            <div class="header__right__dropdown header__right__item">
                <img class="header__right__dropdown__item" width="28" height="28" src="../../img/notif.png" alt="notif">
                <div class="header__right__dropdown__panel">
                    <ul>
                        <li>salut</li>
                        
                    </ul>
                </div>
            </div>
            <div class="header__right__dropdown header__right__item">
                <div class="header__right__dropdown__item">
                    <img width="28" height="28" src=<?php echo get_pp_src($_SESSION['user_ID']); ?> alt="user_photo">
                    <p><?php echo $_SESSION['name']; ?></p>
                </div>
                <div class="header__right__dropdown__panel">
                    <a href="/trophee_nsi/page/index?content_type=user&id=<?php echo $_SESSION['user_ID']; ?>">Mon profil</a>
                    <a href="/trophee_nsi/page/index?content_type=settings">Options</a>
                    <hr>
                    <a href="/trophee_nsi/page/sign_in.php">Se déconnecter</a>
            </div>
            </div>
        <?php }else{?>
            <a href="/trophee_nsi/page/sign_in.php" class="button is-primary">Se connecter</a>
        <?php }?>
        </nav>
</header>
