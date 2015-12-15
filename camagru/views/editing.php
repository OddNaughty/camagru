<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 17:13
 */
$title = "Home - Camagru";
include_once("header.php");?>
<div>
    <video id="video"></video>
    <canvas id="overlay" style="position: absolute; z-index: 10; border: 1px solid #000000;"></canvas>
</div>
<button id="startbutton" ondrop="drop_handler(event);">Prendre une photo</button>
<canvas id="canvas" style="border:1px solid #000000;"></canvas><br/>
<image id="joint" src="/assets/joint.png" draggable="true"></image>
<script src="/js/camagru.js" type="application/javascript"></script>
<?php
include_once("footer.php");
?>