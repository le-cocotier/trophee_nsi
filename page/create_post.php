<?php session_start(); ?>
<form action='/trophee_nsi/cible/send_post.php' method="post" enctype="multipart/form-data">
    <input type="text" name="title" value="title">
    <input type="hidden" name="user" value=<?php echo $_SESSION['user_ID']; ?>>
    <input type="file" name="image">
    <textarea name="content" rows="8" cols="80"></textarea>
    <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
    <input class="button is-white" type="submit" name="" value="poster">
</form>
