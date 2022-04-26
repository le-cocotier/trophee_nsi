<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../../css/master.css">
    <link type="text/css" rel="stylesheet" href="../../css/pages/index.css">
    <title>Document</title>
</head>
<body>
    <!--<h4><?php if (isset($_SESSION['name'])) {echo $_SESSION['name'];} ?></h4>-->
    <?php include "../common/header.php";?>
    <section>
        <div class="section__frame">
            <?php
                if(isset($_GET["content_type"])){
                    if($_GET["content_type"] == "feed") {
                        include "index_sections/feed.php";
                    }
                    elseif($_GET["content_type"] == "dm" && isset($_GET["discussion"])) {
                        include "index_sections/dm.php";
                    }
                    elseif($_GET["content_type"] == "community" && isset($_GET["id"])){
                        include "index_sections/community.php";
                    }
                    elseif($_GET["content_type"] == "user" && isset($_GET["id"])){
                        include "index_sections/user_profile.php";
                    }
                    else{
                        echo "TODO: 404.php";
                        //include "index_sections/404.php";
                    }
                } else {
                    include "index_sections/feed.php";
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
                        include 'right/get_discussions.php';
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
