<div class="card is-post">
    <div class="post-header">
        <?php if (isset($id)){
            echo '<button onclick="delete_post('.$id.')">...</button>';
        } ?>
        <a class="post-header__user" href="/trophee_nsi/page/index?content_type=user&id=<?php echo $user_ID; ?>">
            <img class="post-header__user__img" height="32" width="32" src=<?php echo get_pp_src($user_ID); ?> alt="user_photo">
            <p class="post-header__user__name"><?php echo get_username($user_ID); ?></p>
        </a>
        <h4 class="post-header__title"><?php echo $title; ?></h4>
    </div>
    <p class="post-content"><?php echo $content; ?></p>
    <?php if ($img != ''){ ?>
        <img src="data:<?php echo $img_type; ?>;base64,<?php echo $img; ?>" style="width:100%">
    <?php } ?>
</div>

<!-- définir
$title
$content
$img
$img_type
$id -->
