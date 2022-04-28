<header>
    <div class="header__left">
        <h1>Lorem</h1>
    </div>
    <nav class="header__right">
        <?php
        if (isset($_SESSION['name']) && isset($_SESSION['password'])){ ?>
            <input id="search_user" type="text" name="search_user" onkeyup="search_user()">
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
                                    document.getElementById("search_user__list").innerHTML+="<li><a href='http://localhost/trophee_nsi/cible/get_user_profil.php?user="+response[i]+"'>"+response[i]+"</a></li>";

                                }
                            }
                        }
                        xhr.open("POST", "http://localhost/trophee_nsi/cible/get_users.php", true);
                        xhr.send(data);
                    }

                }
            </script>
            <svg class="header__right__item" xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/></svg>
            <div class="header__right__dropdown header__right__item">
                <div class="header__right__dropdown__item">
                    <img width="38" height="38" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user_photo">
                    <p><?php echo $_SESSION['name']; ?></p>
                </div>
                <ul class="header__right__dropdown__panel">
                    <li>Mon profil</li>
                    <hr>
                    <li class="item-disconnect"><a href="../sign_in.php">Se déconnecter</a></li>
                </ul>
            </div>
        <?php }else{?>
            <a href="/trophee_nsi/page/sign_in.php" class="button is-primary">Se connecter</a>
        <?php }?>
        </nav>
</header>
