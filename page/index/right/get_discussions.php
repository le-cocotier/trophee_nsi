<?php
$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/message.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM discussion");


while ($line = $response->fetchArray()) {
    $users_ID = explode(",", $line["users_ID"]);
    if (in_array($_SESSION["user_ID"], $users_ID)) {
        $get=$line['ID'];
        $group=$line['group'];
        $pp="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png";
        $name=$line['name'];
        $request = "SELECT * FROM content where discussion_ID='$get' ORDER BY ID DESC LIMIT 1";
        $last_message= $bdd->query($request);
        $message_response=$last_message->fetchArray();
        if ($message_response == false) {
            $message='There are no messages yet. Say hye to them!';
        }
        else {
            if ($message_response['type'] == 'text'){
                $message=$message_response['mess'];
            }
            else {
                $message='image';
            }

        }
        include($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/right/discussion.php');
    }
}

 ?>
