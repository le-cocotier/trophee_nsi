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
        <div class="section__frame <?php if (!(isset($_SESSION['name']) && isset($_SESSION['password']))){ echo "is-wide"; }?>">
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
        <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])){ ?>
            <div class="section__right-frame">
                <div class="section__right-frame__header">
                    <img onclick="changeRightMenu('is-dm')" id="dm-button" class="active" width="28" height="28" src="../../img/messages.png" alt="messages">
                    <img onclick="changeRightMenu('is-group')" id="groups-button" width="28" height="28" src="../../img/groups.png" alt="groupes">
                </div>
                <div class="section__right-frame__content">
                    <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])){
                        include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/page/index/right/get_discussions.php';
                    } ?>
                    <a href="/trophee_nsi/page/create_group.php" class="create-group">Créer un groupe</a>
                </div>
            </div>
        <?php } ?>
    </section>
    <script>
        let current = "is-dm";
        function changeRightMenu(where){
            if(where === current) return;
            if(current === "is-dm"){
                document.querySelectorAll(".is-dm").forEach(el => el.classList.add("hidden"));
                document.querySelectorAll(".is-group").forEach(el => el.classList.remove("hidden"));
                document.querySelector("#dm-button").classList.remove("active");
                document.querySelector("#groups-button").classList.add("active");
                current = "is-group";
            }
            else{
                document.querySelectorAll(".is-group").forEach(el => el.classList.add("hidden"));
                document.querySelectorAll(".is-dm").forEach(el => el.classList.remove("hidden"));
                document.querySelector("#dm-button").classList.add("active");
                document.querySelector("#groups-button").classList.remove("active");
                current = "is-dm";
            }
        }
    </script>
</body>
</html>
