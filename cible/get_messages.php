<?php
$bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT * FROM content where discussion="'.$title.'"');

while ($line = $response->fetchArray()) {
    if ($line['user'] == $_SESSION['name']) {
        echo "<div style='text-align: right;'>".$line['mess']."</div>";
    }
    else {
        echo "<div style='text-align: left;'>".$line['mess']." </div><small>".$line['user']."</small>";

    }
}
 ?>
