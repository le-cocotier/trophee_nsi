<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM content where discussion_ID='$discussion_ID'");

while ($line = $response->fetchArray()) {
    if ($only_new){
        $vu = explode(",",$line['seen']);
        if (!in_array($_SESSION["user_ID"], $vu)){
            if ($line['user_ID'] == $_SESSION['user_ID']) {
                echo <<<HTML
                <div class='message-left'>
                    <p class="content">{$line['mess']}</p>
                    <p class="user">Vous</p>
                </div>
                HTML;
            }
            else {
                echo '
                <div class="message-right">
                    <p class="content">'.$line["mess"].'</p>
                    <p class="user">'.get_username($line["user_ID"]).'</p>
                </div>';
            }
            array_push($vu, $_SESSION['user_ID']);
            $vu = implode(',', $vu);
            $append = $bdd->prepare("UPDATE content SET seen='".$vu."' where ID=".$line['ID']);
            $append->execute();
        }
    }
    else {
        if ($line['type'] == 'text') {
            if ($line['user_ID'] == $_SESSION['user_ID']) {
                echo <<<HTML
                <div class='message-left'>
                    <p class="content">{$line['mess']}</p>
                    <p class="user">Vous</p>
                </div>
                HTML;
            }
            else {
                echo '
                <div class="message-right">
                    <p class="content">'.$line['mess'].'</p>
                    <p class="user">'.get_username($line['user_ID']).'</p>
                </div>';
            }
        }
        elseif (str_contains($line['type'], 'image')) {
            $stream = $bdd->openBlob('content', 'file', $line['ID']);
            if ($line['user_ID'] == $_SESSION['user_ID']) {
                echo "<div class='message-left'><img width='200px' src='data:".$line['type'].";base64,".base64_encode(stream_get_contents($stream))."'><small>Vous</small></div>";
            }
            else {
                echo "<div class='message-right'><img width='200px' src='data:".$line['type'].";base64,".base64_encode(stream_get_contents($stream))."'><small>".get_username($line['user_ID'])."</small></div>";
            }
        }
    }

}
 ?>
