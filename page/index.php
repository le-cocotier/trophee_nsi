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
    <h4><?php if (isset($_SESSION['name'])) {echo $_SESSION['name'];} ?></h4>
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
            <div class="section__right-frame__header">
                <span>Groupes</span>
                <span class="section__right-frame__header active">DM</span>
            </div>
            <?php if (isset($_SESSION['name']) && isset($_SESSION['password'])) {include '../includes/get_discussions.php';} ?>
        </div>
    </section>
    <script src="index_travail_A21.js">
        // Futur code changement de menu -- Groupes <-> DM
    </script>
</body>
</html>
