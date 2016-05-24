<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 17:13
 */
$title = "Home - Camagru";
include_once("header.php");?>
<video id="video"></video>
<canvas id="overlay" style="position: absolute; z-index: 10;"></canvas>
<canvas id="canvas" style="border:1px solid #000000;"></canvas>
<div id="form">
    <form method="post" action="/controllers/editing.php">
        <input type="hidden" name="photo64" value="">
        <input type="hidden" name="overlay64" value="">
    </form>
</div>
    <br/>
<button id="startbutton" disabled>Prendre une photo</button>
<input type="file" id="files" /><img id="image" />
<image id="joint" src="/assets/joint.png" draggable="true"></image>
<image id="grumpy" src="/assets/grumpy_cat.png" draggable="true"></image>
<image id="luigi" src="/assets/luigi.png" draggable="true"></image>
<?php if ($pictures) {
    foreach ($pictures as $p) {
        echo ("<p id='picture'".$p['id']."><img src='".$p['picture']."'/><button onclick='deletePicture(".$p['id'].")/></p>");
    }
}
?>
<script src="/js/camagru.js" type="application/javascript"></script>
<?php
include_once("footer.php");
?>