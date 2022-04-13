<?php
$bdd = new SQLite3('../database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT * FROM content where discussion="'.$title.'"');

while ($line = $response->fetchArray()) {
    if ($only_new){
        $vu = explode(",",$line['seen']);
        if (!in_array($_SESSION["name"], $vu)){
            if ($line['user'] == $_SESSION['name']) {
                echo "<div style='text-align: right;'>".$line['mess']."</div>";
            }
            else {
                echo "<div style='text-align: left;'>".$line['mess']." </div><small>".$line['user']."</small>";
            }
            array_push($vu, $_SESSION['name']);
            $vu = implode(',', $vu);
            $append = $bdd->prepare("UPDATE content SET seen='".$vu."' where ID=".$line['ID']);
            $append->execute();
        }
    }
    else {
        if ($line['user'] == $_SESSION['name']) {
            echo "<div style='text-align: right;'>".$line['mess']."</div>";
        }
        else {
            echo "<div style='text-align: left;'>".$line['mess']." </div><small>".$line['user']."</small>";
        }

    }

}
 ?>
