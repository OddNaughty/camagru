/**
 * Created by cwagner on 17/12/15.
 */

(function () {
})();

function postLike(idUser, idPicture) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("likeOk"+idPicture).innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","/controllers/likephoto.php?p="+idPicture, true);
    xmlhttp.send();
}
