<!--
Idée de comment faire fonctioner l'affichage des posts:
Que ce soit sur le feed principal ou feed d'une communauté
ça vient demander à la cible get_posts en fonction des arguments,
exemple: groupe_id si communauté, user_id si feed de l'utilisateur
et ça return ici les posts et à d'autres endroits etc.
c'est possible en php? et demander si pas claire

En attendant, posts placeholder -->

<div class="content-flow">
    <?php include $_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/cible/get_posts.php'; ?>
</div>
