<?php session_start(); include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/cible/functions.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href='/trophee_nsi/scss/bundle.css'>
    <title>Document</title>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>
<body class="index">
    <?php include $_SERVER["DOCUMENT_ROOT"]."/trophee_nsi/page/common/header.php";?>
    <section>
        <div class="section__frame">
            <?php
                if(isset($_GET["content_type"])){
                    if($_GET["content_type"] == "feed") {
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/index_sections/feed.php';
                    }
                    elseif($_GET["content_type"] == "dm" && isset($_GET["id"])) {
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/index_sections/dm.php';
                    }
                    elseif($_GET["content_type"] == "community" && isset($_GET["id"])){
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/index_sections/community.php';
                    }
                    elseif($_GET["content_type"] == "user" && isset($_GET["id"])){
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/index_sections/user_profile.php';
                    }
                    elseif($_GET["content_type"] == "settings"){
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/index_sections/settings.php';
                    }
                    else{
                        echo "TODO: 404.php";
                    }
                }
                else {
                    include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/index_sections/feed.php';
                }
            ?>
        </div>
        <div class="section__right-frame">
            <div class="section__right-frame__header">
                <button id="message-button" class="active">Messages</button>
                <button id="group-button">Groupes</button>
            </div>
            <div class="section__right-frame__content">
                <div class="section__right-frame__content__dm">
                    <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])){
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/right/get_discussions.php';
                    } ?>
                    <a href="/trophee_nsi/page/create_group.php" class="create-group">Créer une discussion</a>
                </div>
                <div class="section__right-frame__content__groups hidden"></div>
            </div>
        </div>
    </section>
    <script>
        //TODO: changer message àgroupes
    </script>
</body>
</html>
