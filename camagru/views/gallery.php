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
        <p>Likes: <?php echo $picture['likes'] ?></p>
    </div>
<?php }
require_once("footer.php");
?>
<script src="/js/gallery.js" type="application/javascript"></script>
