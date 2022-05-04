<?php
// On vérifie si l'utilisateur fais partie du groupe
if (isset($_GET['id']) && $_GET['id'] != ""){
    $bdd = new SQLite3('../../../database/message.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT * FROM discussion where ID='".$_GET['id']."'");
    $discussion_ID = $_GET['id'];
    $line = $response->fetchArray();
    if ($line != NULL) {
        $users_ID=explode(",", $line["users_ID"]);
        $title = $line['name'];
        if (!in_array($_SESSION["user_ID"], $users_ID)) {
            header('location: ../index.php');
        }
        ?>
        <div class="popup_add-user">
            <div class="popup_add-user-container">
                <h1>Ajouter un autre membre</h1>
                <div class="dropdown">
                    <div class="dropdown__item">
                        <input class="input is-wide" id="popup_add-user__input" type="text" name="users" onkeyup="add_search_user()">
                    </div>
                    <div id="popup_add-user__list" class="dropdown__panel overflow">

                    </div>
                </div>
                <button class="button is-black" onclick="showPopup()">Retour</button>
            </div>
        </div>


        <div class="content-dm">
            <div class="dm__header">
                <a href='../index.php' class="button is-black">Retour</a>
                <h2 id="discussion_title"><?php echo $title; ?></h2>
                <?php if ($line['admin'] == $_SESSION['user_ID']) { ?>
                    <div class="dropdown hover">
                        <div class="dropdown__item">
                            <span type='button' class="button">...</span>
                        </div>
                        <div class="dropdown__panel left">
                            <a id="rename_button" class='dropdown__panel__item' href="#" type="button" onclick="rename_input()">Renommer</a>
                            <a class='dropdown__panel__item' href="#" type="button" onclick="showPopup()">Ajouter quelqu'un</a>
                            <hr>
                            <a class='dropdown__panel__item' href="#" type="button" onclick='delete_group()'>Supprimer le groupe</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="dm__content">
                <!-- On récupère les messages de la discussion -->
                <?php $only_new=false; include '../../../cible/get_messages.php'; ?>
            </div>

            <div class="dm__footer">
                <form class="form-message" action='../../../cible/send_message.php' method="post">
                    <input type="hidden" name="discussion_ID" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="user_ID" value=<?php echo $_SESSION['user_ID']; ?>>
                    <input type="hidden" name="type" value="text">
                    <input class="input" type="text" name="mess" value="" placeholder="Ecrire un message..." required>
                    <input type="hidden" name="file" value="">
                    <input type="hidden" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>">
                    <input class="button is-primary" type="submit" name="" value="Envoyer">
                </form>
                <form class="form-img" action='../../../cible/send_message.php' method="post" enctype="multipart/form-data">
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


        <script type="text/javascript">
            let isShown = true
            function showPopup() {
                let popup = document.getElementsByClassName('popup_add-user')[0];
                if (isShown) {
                    popup.style.display = "flex";
                    isShown = false;
                } else {
                    popup.style.display = "none";
                    isShown = true;
                }
            }

            function rename_input() {
                document.getElementById('rename_button').setAttribute('onclick', '');
                document.getElementById('discussion_title').innerHTML = '<input placeholder="Nouveau nom..." class="input rename_input" type="text" value="'+document.getElementById('discussion_title').innerText+'"></input><button class="button is-primary" onclick="rename_start()">Renommer</button>';
            }

            function add_search_user() {
                let panel = document.getElementById('popup_add-user__list')
                panel.innerHTML = "";
                let input = document.getElementById('popup_add-user__input').value;
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
                                document.getElementById("popup_add-user__list").innerHTML+="<a class='dropdown__panel__item' href='#' onclick='add_user_group(\""+response['name'][i]+"\")'>Ajouter "+response['name'][i]+"</a>";
                            }
                        }
                    }
                    xhr.open("POST", '../../../cible/get_users.php', true);
                    xhr.send(data);
                } else panel.classList.remove('show');
            }

            function add_user_group(user) {
                let xhr = new XMLHttpRequest();
                let data = new FormData();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.response);
                        let xhr = new XMLHttpRequest();
                        let data = new FormData();
                        xhr.onreadystatechange = () => {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                            }
                        }
                        data.append('users_ID', response[0]);
                        data.append('new_user', user);
                        data.append('ID', <?php echo $_GET['id']; ?>);
                        xhr.open("POST", '../../../cible/add_user_group.php', true);
                        xhr.send(data);
                    }
                }
                data.append('discussion', <?php echo $_GET['id']; ?>);
                xhr.open("POST", '../../../cible/is_on_group.php', true);
                xhr.send(data);
            }

            function rename_start() {
                let name = document.getElementById('discussion_title').querySelector('input').value;
                console.log(name);
                let xhr = new XMLHttpRequest();
                let data = new FormData();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.assign('../index.php?content_type=dm&id=<?php echo $_GET['id']; ?>');
                    }
                }
                data.append('ID', <?php echo $_GET['id']; ?>);
                data.append('name', name);
                xhr.open("POST", '../../../cible/rename_group.php', true);
                xhr.send(data);
                document.getElementById('rename_button').setAttribute('onclick', 'rename_input()');
                document.getElementById('discussion_title').innerHTML = name;
            }

            function delete_group() {
                let xhr = new XMLHttpRequest();
                let data = new FormData();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.assign('../index.php');
                    }
                }
                data.append('ID', <?php echo $_GET['id']; ?>);
                xhr.open("POST", '../../../cible/delete_group.php', true);
                xhr.send(data);
            }
        </script>

<?php
    }
}
exit();
    ?>
<script type="text/javascript">
    window.location.assign('../index.php');
</script>
