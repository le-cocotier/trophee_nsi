<?php
//Idée de comment faire fonctioner l'affichage des posts:
//Que ce soit sur le feed principal ou feed d'une communauté
//ça vient demander à la cible get_posts en fonction des arguments,
//exemple: groupe_id si communauté, user_id si feed de l'utilisateur
//et ça return ici les posts et à d'autres endroits etc.
//c'est possible en php? et demander si pas claire

//En attendant, posts placeholder
echo <<<HTML
    <!--bar genre création de poste ou un truc stylé-->
<div class="content-flow">
    <div class="card is-post">
        <div class="post-header">
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="user_photo">
                <h4>Incendie à Brive : l'intervention des pompiers va durer tout l'après-midi</h4>
        </div>
        <p class="post-content">Le travail des pompiers sera long, suite à l'incendie qui a détruit un salon de coiffure ce mercredi 23 mars dans le centre-ville de Brive. voir plus...</p>
        <img src="https://picsum.photos/600/400" alt="" style="width:100%">
    </div> 
    <div class="card is-post">
        <div class="post-header">
                <h4>Incendie à Brive : l'intervention des pompiers va durer tout l'après-midi</h4>
        </div>
        <p class="post-content">Le travail des pompiers sera long, suite à l'incendie qui a détruit un salon de coiffure ce mercredi 23 mars dans le centre-ville de Brive. voir plus...</p>
    </div>
    <div class="card is-post">
        <div class="post-header">
                <h4>Incendie à Brive : l'intervention des pompiers va durer tout l'après-midi</h4>
        </div>
        <p class="post-content">Le travail des pompiers sera long, suite à l'incendie qui a détruit un salon de coiffure ce mercredi 23 mars dans le centre-ville de Brive. voir plus...</p>
    
    </div> 
    <div class="card is-post">
        <div class="post-header">
                <h4>Incendie à Brive : l'intervention des pompiers va durer tout l'après-midi</h4>
        </div>
        <p class="post-content">Le travail des pompiers sera long, suite à l'incendie qui a détruit un salon de coiffure ce mercredi 23 mars dans le centre-ville de Brive. voir plus...</p>
    
    </div> 
</div>
HTML;
?>