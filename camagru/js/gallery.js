/**
 * Created by cwagner on 17/12/15.
 */

(function () {
    function postLike(idUser, idPicture) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("likeOk").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","likephoto.php?p="+str,true);
        xmlhttp.send();
    }
})();