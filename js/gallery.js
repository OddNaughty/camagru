/**
 * Created by cwagner on 17/12/15.
 */

(function () {
})();

function postLike(idPicture) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log(document.getElementById("nblikes"+idPicture).innerHTML.split(":"));
            document.getElementById("nblikes"+idPicture).innerHTML = "Likes: " + (parseInt(document.getElementById("nblikes"+idPicture).innerHTML.split(":")[1]) + 1);
        }
    };
    xmlhttp.open("GET","/controllers/likephoto.php?p="+idPicture, true);
    xmlhttp.send();
}
