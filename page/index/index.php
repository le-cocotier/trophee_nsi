<?php session_start(); include '../../cible/functions.php';?>
<?php include '../../config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href='<?php echo SITE_URL . '/scss/bundle.css' ;?>'>
    <title>Lambda</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon">
    <script type="text/javascript" src="../../js/pages/index.js"></script>
</head>
<body class="index">
    <?php include "../common/header.php";?>
    <section>        <div class="section__frame <?php if (!(isset($_SESSION['name']) && isset($_SESSION['password']))){ echo "is-wide"; }?>">
            <?php
            if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
                if(isset($_GET["content_type"])){
                    if($_GET["content_type"] == "feed") {
                        include SITE_ROOT.'/page/index/index_sections/feed.php';
                    }
                    elseif($_GET["content_type"] == "dm" && isset($_GET["id"])) {
                        include SITE_ROOT.'/page/index/index_sections/dm.php';
                    }
                    elseif($_GET["content_type"] == "community" && isset($_GET["id"])){
                        include SITE_ROOT.'/page/index/index_sections/community.php';
                    }
                    elseif($_GET["content_type"] == "user" && isset($_GET["id"])){
                        include SITE_ROOT.'/page/index/index_sections/user_profile.php';
                    }
                    elseif($_GET["content_type"] == "settings"){
                        include SITE_ROOT.'/page/index/index_sections/settings.php';
                    }
                    else{
                        echo "TODO: 404.php";
                    }
                }
                else {
                    include SITE_ROOT.'/page/index/index_sections/feed.php';
                }
            } else{
                include SITE_ROOT.'/page/index/index_sections/main.php';
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
                        include SITE_ROOT.'/page/index/right/get_discussions.php';
                    } ?>
                    <div class="create-group">
                        <button href="#" onclick="openGroup()" class="create-group__button">Créer un groupe</button>
                        <?php include SITE_ROOT."/page/create_group.php"; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</body>
</html>
