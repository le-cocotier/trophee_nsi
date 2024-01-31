<?php
// renvoie le nom de l'utilisateuren fonction de son user_IDs

function get_username($ID){
    $bdd_user = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd_user->query("SELECT name FROM users where id='$ID'");
    return ($response->fetchArray())['name'];
}

function get_pp_src($ID) {
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT type FROM users where id='$ID'");
    $line = $response->fetchArray();
    $stream = $bdd->openBlob('users', 'pp', $ID);
    return "'data:".$line['type'] .";base64,".base64_encode(stream_get_contents($stream))."'";
}

function get_user_posts($ID, $limit=10, $is_user=false) {

    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
    $query = "SELECT * FROM posts where user IN (".$ID.") ORDER BY date DESC LIMIT ".$limit;
    $response = $bdd->query($query);
    while ($line = $response->fetchArray()) {
        $user_ID = $line['user'];
        $title = $line['title'];
        $content = $line['content'];
        if ($is_user == true){
            $id = $line['ID'];            
        }
        if ($line['image'] != NULL){
            $stream = $bdd->openBlob('posts', 'image', $line['ID']);
            $img = base64_encode(stream_get_contents($stream));
            $img_type = $line['type'];
        }
        else{
            $img = '';
        }
        include $_SERVER["DOCUMENT_ROOT"].'/includes/post.php';
    }
    if (!isset($_GET['nb_post'])){
        $_GET['nb_post'] = 10;
    } else {
        $_GET['nb_post'] += 10;
    } ?>
    <button onclick="window.location.assign('/page/index/index.php?<?php echo http_build_query($_GET); ?>')">more</button> 
    <?php
}

function get_friends($ID){
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
    $query = "SELECT friends FROM users where id='$ID'";
    $response = $bdd->query($query);
    return explode(",", $response->fetchArray()['friends']);
}

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}
 ?>
