<?php
$bdd = new SQLite3('../../database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM discussion");


while ($line = $response->fetchArray()) {
    $users = explode(",", $line["users"]);
    if (in_array($_SESSION["name"], $users)) {
        $get=$line['ID'];
        $pp="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png";
        $name=$line['name'];
        $request = 'SELECT * FROM content where "discussion"="'.$name .'" ORDER BY ID DESC LIMIT 1';
        $last_message= $bdd->query($request);
        $message_response=$last_message->fetchArray();
        if ($message_response == false) {
            $message='';
        }
        else {
            $message=$message_response['mess'];
        }
        include('discussion.php');
    }
}

 ?>
