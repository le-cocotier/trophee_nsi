<?php
// renvoie le nom de l'utilisateuren fonction de son user_IDs
function is_up_vote($post_ID, $ID){
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT up_vote from posts where ID='$post_ID'");
    $line = $response->fetchArray();
    $likes = explode(',', $line['up_vote']);
    var_dump($likes);
    var_dump($ID);
    if (in_array($ID, $likes)){
        return true;
    }
    return false;
}

function get_username($ID){
    $bdd_user = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd_user->query("SELECT name FROM users where id='$ID'");
    return ($response->fetchArray())['name'];
}

function get_comments($post_ID){
    $bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/database/main.db', SQLITE3_OPEN_READWRITE);
    $response = $bdd->query("SELECT c.*, u.name FROM comments as c, users as u where c.post_ID='$post_ID' and c.user_ID=u.id");
    $comments = [];
    while ($line = $response->fetchArray()){
        array_push($comments, $line);
    }
    return $comments;
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
        $is_user_post = false;
        $id = $line['ID'];
        $comments = get_comments($id);
        $is_up_vote = is_up_vote($id, $_SESSION['user_ID']);
        var_dump($is_up_vote);
        if ($is_user == true){
            $is_user_post = true;
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
        $_GET['nb_post'] = 20;
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

function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    }
    elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    }
    elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    }
    imagejpeg($image, $destination, $quality);
    return $destination;
}
 ?>
