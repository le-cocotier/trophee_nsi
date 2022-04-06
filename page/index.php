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
    <?php include "common/header.php";?>
    <section>
        <div class="section__frame">
            <div class="content">
                <?php //Ici choisir quoi afficher sur page d'index
                include "index_sections/feed.php";
                //include "index_sections/community.php";
                ?>
            </div>
        </div>
        <div class="section__right-frame">
            <div class="section__right-frame__menu">
                <span>Groupes</span>
                <span class="section__right-frame__menu--active">DM</span>
            </div>
            <?php include '../includes/get_discussions.php'; ?>
        </div>
    </section>
    <script src="index_travail_A21.js">
        // Futur code changement de menu -- Groupes <-> DM
    </script>
</body>
</html>
