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
            <div class="section__right-frame__cards">
                <div class="card-dm">
                    <img width="64" height="64" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user_photo">
                    <div class="content">
                        <h5>Pseudo</h5>
                        <p>Message limité à cent quarante quartre caractères ou dans ces eaux là car tous les bandeaux font la même taille.</p>
                    </div>
                </div>
                <div class="card-dm">
                    <img width="64" height="64" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user_photo">
                    <div class="content">
                        <h5>Pseudo</h5>
                        <p>Message limité à cent quarante quartre caractères ou dans ces eaux là car tous les bandeaux font la même taille.</p>
                    </div>
                </div>
                <div class="card-dm">
                    <img width="64" height="64" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user_photo">
                    <div class="content">
                        <h5>Pseudo</h5>
                        <p>Message limité à cent quarante quartre caractères ou dans ces eaux là car tous les bandeaux font la même taille.</p>
                    </div>
                </div>
                <div class="card-dm">
                    <img width="64" height="64" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user_photo">
                    <div class="content">
                        <h5>Pseudo</h5>
                        <p>Message limité à cent quarante quartre caractères ou dans ces eaux là car tous les bandeaux font la même taille.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>