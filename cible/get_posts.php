<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/users.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT friends from users where name="'.$_SESSION['name'].'"');
$line = $response->fetchArray();
$line = explode(",",$line['friends']);
$line = '"'.implode('","', $line).'"';
echo $line;



$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/posts.db', SQLITE3_OPEN_READWRITE);
$select = 'SELECT * FROM posts where user IN ('.$line.') ORDER BY date DESC ';
$response = $bdd->query($select);


while ($line = $response->fetchArray()) {
    var_dump($line);
}

 ?>
