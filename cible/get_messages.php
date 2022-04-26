<?php
$bdd = new SQLite3('../../database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query('SELECT * FROM content where discussion="'.$title.'"');

while ($line = $response->fetchArray()) {
    if ($only_new){
        $vu = explode(",",$line['seen']);
        if (!in_array($_SESSION["name"], $vu)){
            if ($line['user'] == $_SESSION['name']) {
                //echo "<div class='message-left'>".$line['mess']."</div>";
                echo <<<HTML
                <div class='message-left'>
                    <p class="content">$line['mess']</p>
                    <p class="user">Vous</p>
                </div>
                HTML;
            }
            else {
                //echo "<div class='message-right'>".$line['mess']." </div><small>".$line['user']."</small>";
                echo <<<HTML
                <div class='message-right'>
                    <p class="content">$line['mess']</p>
                    <p class="user">$line['user']</p>
                </div>
                HTML;
            }
            array_push($vu, $_SESSION['name']);
            $vu = implode(',', $vu);
            $append = $bdd->prepare("UPDATE content SET seen='".$vu."' where ID=".$line['ID']);
            $append->execute();
        }
    }
    else {
        if ($line['type'] == 'text') {
            if (strcasecmp($line['user'], $_SESSION['name'])) {
                //echo "<div class='message-left'>".$line['mess']."</div>";
                echo <<<HTML
                <div class='message-left'>
                    <p class="content">$line['mess']</p>
                    <p class="user">Vous</p>
                </div>
                HTML;
            }
            else {
                //echo "<div class='message-right'>".$line['mess']." </div><small>".$line['user']."</small>";
                echo <<<HTML
                <div class='message-right'>
                    <p class="content">$line['mess']</p>
                    <p class="user">$line['user']</p>
                </div>
                HTML;
            }
        }
        elseif (str_contains($line['type'], 'image')) {
            $stream = $bdd->openBlob('content', 'file', $line['ID']);
            if ($line['user'] == $_SESSION['name']) {
                echo "<div class='message-left'><img width='200px' src='data:".$line['type'].";base64,".base64_encode(stream_get_contents($stream))."'></div>";
            }
            else {
                echo "<div class='message-right'><img width='200px' src='data:".$line['type'].";base64,".base64_encode(stream_get_contents($stream))."'><small>".$line['user']."</small></div>";
            }
        }
    }

}
 ?>
