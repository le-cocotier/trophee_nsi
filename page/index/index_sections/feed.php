<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);

$response = $bdd->query('SELECT friends from users where id="'.$_SESSION['user_ID'].'"');
$line = $response->fetchArray();
if ($line != NULL){
    $line = explode(",",$line['friends']);
    array_push($line, $_SESSION['user_ID']);
    $liste_of_users = "'".implode("','", $line)."'";
 ?>

<div class="content-flow">
    <div class="card is-post">
        <div class="post-header">
            <h4 class="post-header__title">Postez quelque chose...</h4>
        </div>
        <form class="form-post" action='/cible/send_post.php' method="post" enctype="multipart/form-data">
            <div class="form-chunck is-vertical">
                <label for="username">Titre</label>
                <input class="input" type="text" name="title" placeholder="Une idée originale..." required>
            </div>
            <div class="form-chunck is-vertical">
                <label for="username">Contenu</label>
                <textarea placeholder="Racontez en un peu plus..." class="input is-secondary" name="content" rows="8" cols="80" required></textarea>
            </div>
            <div class="form-chunck is-vertical">
                <label for="username">Rajoutez une image</label>
                <input type="file" name="image" accept=".jpg, .jpeg, .png, .gif">
            </div>
            <input type="hidden" name="user" value="<?php echo $_SESSION['user_ID']; ?>">
            <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input class="button is-primary" type="submit" name="" value="Poster">
        </form>
    </div>
    <?php
    if (isset($_GET['nb_post'])){
        echo get_user_posts($liste_of_users, $_GET['nb_post']); ?> 
    <?php } else{
        echo get_user_posts($liste_of_users); ?>

            <script>
                 function comment(id) {
                     let input = document.getElementById("comment-input-"+id);
                     let data = new FormData();
                     data.append('post_ID', id);
                     data.append('input', input.value);
                     let xhr = new XMLHttpRequest();
                     xhr.onreadystatechange = ()  => {
                         if (xhr.readyState == 4 && xhr.status == 200){
                             console.log("good");
                         }
                     }
                        xhr.open("POST", '/cible/post_comment.php', true);
                     xhr.send(data);
                 }

                 function display_comments(id){
                     let comments = document.getElementById("comment-section-"+id);
                     if (comments.style.display == "block"){
                         comments.style.display = "None";
                     } else{
                         comments.style.display = "block";
                     }
                 }
            </script>
    <?php }
}
    else {
        header('location: /page/index/main.php');
    }?>
</div>
