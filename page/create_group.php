<h1 id="title"></h1>
<input id="search_user" class="input" type="text" name="search_user" onkeyup="search_user()">
<ul id="search_user__list">

</ul>
<form id="form" action="/trophee_nsi/cible/create_group.php" method="post">
    <input id="users" type="hidden" name="users" value="">
    <input type="submit" value="Créer la discussion">
</form>

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
                        console.log(response['name'][i]);
                        document.getElementById("search_user__list").innerHTML+="<li><a href='#' onclick='add_to_group(\""+response['name'][i]+"\")'>"+response['name'][i]+"</a></li>";
                    }
                }
            }
            xhr.open("POST", '/trophee_nsi/cible/get_users.php', true);
            xhr.send(data);
        }
    }
    let liste_of_users = [];
    function add_to_group(user){
        if (!liste_of_users.includes(user)){
            liste_of_users.push(user);
            document.getElementById('users').setAttribute('value', liste_of_users.join(','));
            document.getElementById('title').innerText = document.getElementById('users').value;
        }
    }
</script>

