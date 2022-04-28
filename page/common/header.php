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

                        let xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = () => {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                let response = JSON.parse(xhr.response);
                                for (var i = 0; i < response.length; i++) {
                                    document.getElementById("search_user__list").innerHTML+="<li><a href='/trophee_nsi/cible/get_user_profil.php?user="+response[i]+"'>"+response[i]+"</a></li>";

                                }
                            }
                        }
                        xhr.open("POST", '/trophee_nsi/cible/get_users.php', true);
                        xhr.send(data);
                    }

                }
            </script>
            <img class="header__right__item" width="38" height="38" src="../../img/notif.png" alt="notif">
            <div class="header__right__dropdown header__right__item">
                <div class="header__right__dropdown__item">
                    <img width="38" height="38" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user_photo">
                    <p><?php echo $_SESSION['name']; ?></p>
                </div>
                <div class="header__right__dropdown__panel">
                    <a href="/trophee_nsi/page/index?content_type=user&id=TODO">Mon profil</a>
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
