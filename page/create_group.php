<div class="create-group__panel">
    <h1 id="titre" class="create-group__panel__title"></h1>

    <div class="dropdown">
        <div class="dropdown__item">
            <input id="group__search_user" class="input create-group__panel__input" type="text" name="search_user" onkeyup="group_search_user()">
        </div>
        <div id="group__search_user__list" class="dropdown__panel overflow top">

        </div>
    </div>

    <form id="form" action="/trophee_nsi/cible/create_group.php" method="post">
        <input id="users" type="hidden" name="users" value="" required>
        <input class="button is-primary create-group__panel__button" type="submit" value="Créer la discussion">
    </form>
</div>

<script type="text/javascript">
    function group_search_user() {
        let panel = document.getElementById('group__search_user__list')
        panel.innerHTML = "";
        let input = document.getElementById('group__search_user').value;
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
                        document.getElementById("group__search_user__list").innerHTML+="<a class='dropdown__panel__item' href='#' onclick='add_to_group(\""+response['name'][i]+"\")'>Ajouter "+response['name'][i]+"</a>";
                    }
                }
            }
            xhr.open("POST", '/trophee_nsi/cible/get_users.php', true);
            xhr.send(data);
        } else panel.classList.remove('show');
    }
    let liste_of_users = [];
    function add_to_group(user){
        if (!liste_of_users.includes(user)){
            liste_of_users.push(user);
            document.getElementById('users').setAttribute('value', liste_of_users.join(','));
            document.getElementById('titre').innerText = document.getElementById('users').value;
        }
    }
</script>
