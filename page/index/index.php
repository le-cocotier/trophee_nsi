<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../css/master.css">
    <link type="text/css" rel="stylesheet" href="../css/pages/index.css">
    <link type="text/css" rel="stylesheet" href="../css/common.css">
    <title>Document</title>
</head>
<body>
    <!--<h4><?php /*if (isset($_SESSION['name'])) {echo $_SESSION['name'];}*/ ?></h4>-->
    <?php include "common/header.php";?>
    <section>
        <div class="section__frame">
            <div class="content">
                <?php
                    if(isset($_GET["content_type"]) {
                        if($_GET["content_type"] == "feed") {
                            include "index_sections/feed.php";
                        } else if($_GET["content_type"] == "community" && isset($_GET["id"]) {
                            include "index_sections/community.php";
                        } else if($_GET["content_type"] == "user" && isset($_GET["id"]) {
                            include "index_sections/user_profile.php";
                        } else {
                            echo "TODO: 404.php";
                            //include "index_sections/404.php";
                        }
                    } else {
                        include "index_sections/feed.php";
                    }
                //include "index_sections/community.php";

                ?>
            </div>
        </div>
        <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])){?>
            <div class="section__right-frame">
                <div class="section__right-frame__header">
                    <span class="section__right-frame__header active">Messages</span>
                    <span>Groupes</span>
                </div>
                <div class="section__right-frame__content">
                    <div class="section__right-frame__content__dm"><?php include 'right/get_discussions.php'; ?></div>
                    <div class="section__right-frame__content__groups hidden"></div>
                </div>
            </div>
        <?php } ?>
    </section>
    <script>
        //TODO: changer message àgroupes
    </script>
</body>
</html>
