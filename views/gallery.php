<script src="/js/gallery.js" type="application/javascript"></script>
<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 13:28
 */
require_once("header.php");
?>


<p>Oulalala la belle gallerie d'image o/.</p>

<?php
foreach ($pictures as $picture) { ?>
    <div>
        <img src="<?php echo $picture['picture'] ?>">
        <p id="<?php echo "nblikes".$picture['id'] ?>">Likes: <?php echo $picture['nb_likes'] ?><button onclick="postLike(<?php echo $picture['id'] ?>)">Like !</button></p>
    </div>
<?php } ?>
<a href="/controllers/gallery.php?p=<?php echo ($page + 1) ?>">Page suivante</a>
<a href="/controllers/gallery.php?p=<?php echo ($page - 1) ?>">Page précédente</a>
<?php require_once("footer.php"); ?>
