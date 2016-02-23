<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 09/12/15
 * Time: 18:59
 */
if ($confirmed) {
    $html = "Votre inscription a bel et bien été confirmée";
} else {
    $html = "Un ennui a eu lieu à la confirmation...";
}
echo $html;
?>