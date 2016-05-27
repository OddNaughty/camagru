<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 13:28
 */
require_once("header.php");
?>


<p>Ouh la jolie photo</p>
<div>
    <img src="<?php echo $picture['picture'] ?>">
    <p id="<?php echo "nblikes".$picture['id'] ?>">Likes: <?php echo $picture['nb_likes'] ?><button onclick="postLike(<?php echo $picture['id'] ?>)">Like !</button></p>
    <h3>Commentaires</h3>
    <ul id="comment-list">
        <?php foreach ($comments as $comment) { ?>
            <li><?php echo $comment['comment']?></li>
        <?php } ?>
    </ul>
    <form id="post-comment" method="post" action="controllers/post-comment.php">
        <div class="field">
            <label for="message">Nouveau commentaire:</label>
            <textarea id="comment" name="comment" required></textarea>
        </div>
        <input type="hidden" name="pictureId" value="<?php echo $picture['id'] ?>">
        <div class="field">
            <button type="submit">Send</button>
        </div>
    </form>
</div>
<script src="/js/picture.js" type="application/javascript"></script>
<?php require_once("footer.php"); ?>
