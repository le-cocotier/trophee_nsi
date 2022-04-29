<?php session_start(); include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/cible/functions.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href='/trophee_nsi/css/master.css'>
    <link type="text/css" rel="stylesheet" href='/trophee_nsi/css/pages/index.css'>
    <title>Document</title>
</head>
<body>
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
                <button id="group-button" >Groupes</button>
            </div>
            <div class="section__right-frame__content">
                <div class="section__right-frame__content__dm">
                    <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])){
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/right/get_discussions.php';
                    } ?>
                    <a href="/trophee_nsi/page/create_group.php" class="create-group">Créer un groupe</a>
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
