<?php
$bdd = new SQLite3(SITE_ROOT.'/database/main.db', SQLITE3_OPEN_READWRITE);
$response = $bdd->query("SELECT * FROM discussion");


while ($line = $response->fetchArray()) {
    $users_ID = explode(",", $line["users_ID"]);
    if (in_array($_SESSION["user_ID"], $users_ID)) {
        $get=$line['ID'];
        if ($line['group'] == 'true') {
            $class="is-group hidden";
            $name = $line['name'];

        }
        else {
            $class="is-dm";
            if (array_search($_SESSION['user_ID'] , $users_ID) == 1){
                $name= get_username($users_ID[0]);
            }
            else {
                $name= get_username($users_ID[1]);
            }
        }
        $pp="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png";

        $request = "SELECT * FROM content where discussion_ID='$get' ORDER BY ID DESC LIMIT 1";
        $last_message= $bdd->query($request);
        $message_response=$last_message->fetchArray();
        if ($message_response == false) {
            $message="Il n'y a pas encore de message dans cette conversation";
        }
        else {
            if ($message_response['type'] == 'text'){
                $message=$message_response['mess'];
            }
            else {
                $message='image';
            }

        }
        include(SITE_ROOT.'/page/index/right/discussion.php');
    }
}

 ?>
