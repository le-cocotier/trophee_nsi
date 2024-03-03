<div class="card is-post">
    <div class="post-header">
        <a class="post-header__user" href="/page/index?content_type=user&id=<?php echo $user_ID; ?>">
            <img class="post-header__user__img" height="32" width="32" src=<?php echo get_pp_src($user_ID); ?> alt="user_photo">
            <p class="post-header__user__name"><?php echo get_username($user_ID); ?></p>
        </a>
        <div class="post-header__actions">
            <?php if (isset($id)){
                echo '<button id="delete" class="button is-delete" onclick="delete_post('.$id.')">
                    <div class="image"></div>
                </button>';
            } ?>
        </div>
    </div>
    <div class="post-content">
        <h4 class="post-content__title"><?php echo $title; ?></h4>
        <p class="post-content__paragraph"><?php echo $content; ?></p>
        <?php if ($img != ''){ ?>
            <img src="data:<?php echo $img_type; ?>;base64,<?php echo $img; ?>" style="width:100%">
        <?php } ?>
    </div>
</div>

<!-- définir
$title
$content
$img
$img_type
$id -->
