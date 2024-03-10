<!-- post.php -->

<div class="card is-post">
    <div class="post-header">
        <a class="post-header__user" href="/page/index?content_type=user&id=<?php echo $user_ID; ?>">
            <img class="post-header__user__img" height="32" width="32" src=<?php echo get_pp_src($user_ID); ?> alt="user_photo">
            <p class="post-header__user__name"><?php echo get_username($user_ID); ?></p>
        </a>
        <div class="post-header__actions">
            <?php if ($is_user_post){
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
            <img src="data:<?php echo $img_type; ?>;base64,<?php echo $img; ?>" style="width:100%" class="post-content__image">
        <?php } ?>
    </div>
    <div class="post-comments">
        <div class="post-comments__buttons">
            <button id="comment_display" class="post-comments__show" onclick="display_comments(<?php echo $id; ?>)">comments</button>
            <input class="post-comments__input" id="comment-input-<?php echo($id); ?>"></input>
            <button onclick="comment(<?php echo $id; ?>)" class="post-comments__send">send</button>
            <script>
                $(document).ready(function() {
                    $('#comment-input-<?php echo($id); ?>').on('input', function() {
                        this.style.height = 'auto';
                        this.style.height = (this.scrollHeight) + 'px';
                        this.style.color = "blue";
                    });
                });
            </script>
        </div>
        <div class="post-comments__comments" id="comment-section-<?php echo $id; ?>">
            <?php foreach($comments as $comment){?>
                <div class="post-comments__section">
                    <span><img class="post-comments__comments__section__img" height="20" width="20" src=<?php echo get_pp_src($comment['user_ID']); ?> alt="user_photo"></span>
                    <span class="post-comments__comments__section__name"><?php echo $comment['name']; ?></span>
                    <span class="post-comments__comments__section__content"><?php echo $comment['content']; ?></span>
                    <span class="post-comments__comments__section__date"><?php echo $comment['date']; ?><span>
                </div>
            <?php } ?>
        </div>
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

<!-- faire un compteur sur l'icone de commentaire qui montre combien de commentaires ont été postés -->