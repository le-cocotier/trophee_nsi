<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT friends from users where id="'.$_SESSION['user_ID'].'"');
$line = $response->fetchArray();
$line = explode(",",$line['friends']);
$line = '"'.implode('","', $line).'"';



$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/posts.db', SQLITE3_OPEN_READWRITE);
$select = 'SELECT * FROM posts where user IN ('.$line.') ORDER BY date DESC ';
$response = $bdd->query($select);


while ($line = $response->fetchArray()) {
    $user_ID = $line['user'];
    $title = $line['title'];
    $content = $line['content'];
    if ($line['image'] != NULL){
        $stream = $bdd->openBlob('posts', 'image', $line['ID']);
        $img = base64_encode(stream_get_contents($stream));
        $img_type = $line['type'];
    }
    else{
        $img = '';
    }

    include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/includes/post.php';
}

 ?>
