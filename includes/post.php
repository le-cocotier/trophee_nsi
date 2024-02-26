<div class="card is-post">
    <div class="post-header">
        <?php if ($is_user_post){
            echo '<button id="delete" class="button is-delete" onclick="delete_post('.$id.')">
                <div class="image"></div>
            </button>';
        } ?>
        <a class="post-header__user" href="/page/index?content_type=user&id=<?php echo $user_ID; ?>">
            <img class="post-header__user__img" height="32" width="32" src=<?php echo get_pp_src($user_ID); ?> alt="user_photo">
            <p class="post-header__user__name"><?php echo get_username($user_ID); ?></p>
        </a>
        <h4 class="post-header__title"><?php echo $title; ?></h4>
    </div>
    <p class="post-content"><?php echo $content; ?></p>
    <?php if ($img != ''){ ?>
        <img src="data:<?php echo $img_type; ?>;base64,<?php echo $img; ?>" style="width:100%">
    <?php } ?>
    <button id="comment_display" onclick="display_comments(<?php echo $id; ?>)">comments</button>
    <input id="comment-input-<?php echo($id); ?>"></input><button onclick="comment(<?php echo $id; ?>)">send</button>
    <div id="comment-section-<?php echo $id; ?>" style="display: None">
          <?php foreach($comments as $comment){
         ?><div>
                <span><img class="post-header__user__img" height="20" width="20" src=<?php echo get_pp_src($comment['user_ID']); ?> alt="user_photo"></span>
                <span><?php echo $comment['name']; ?></span>
                <span><?php echo $comment['content']; ?></span>
                <span><?php echo $comment['date']; ?><span>
          </div><?php
     } ?>
    </div>
</div>

<!-- définir
$title
$content
$img
$img_type
$id
$is_user_post
-->
