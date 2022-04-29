<div class="card is-post">
    <div class="post-header">
            <img src=<?php echo get_pp_src($user_ID); ?> alt="user_photo">
            <h4><?php echo $title; ?></h4>
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
$img_type -->
