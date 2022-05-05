<?php /*
ABSOLUMENT DÉFINIR LES VAR
$pp pour la photo de profil
$message pour le Message
$name pour le le nom de la discussion
*/?>

<a class="card <?php echo $class; ?>" href=<?php echo("?content_type=dm&id=".$get); ?>>
    <img class="card-img" height="64" width="64" src=<?php echo $pp ?> alt="user_photo">
    <div class="content">
        <h5 class="card-title"><?php echo $name ?></h5>
        <p class="card-under"><?php echo $message ?></p>
    </div>
</a>
