/**
 * Created by cwagner on 17/12/15.
 */

(function () {
    var form = document.getElementById("post-comment");

    form.addEventListener('submit', function (ev) {
        // console.log(ev);
        postComment();
        ev.preventDefault();
    });

    function postComment() {
        var tosend = new FormData(document.getElementById("post-comment")),
            xmlhttp = new XMLHttpRequest(),
            test = new FormData();
        // test.append("test", "caca");
        console.log("Sending");
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var ul = document.getElementById("comment-list");
                var li = document.createElement("li");
                li.appendChild(document.createTextNode(form.elements['comment'].value));
                ul.appendChild(li);
                form.elements['comment'].value = "";
            }
        };
        xmlhttp.open("POST","/controllers/postcomment.php", true);
        xmlhttp.send(tosend);
    }
})();

function postLike(idPicture) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("nblikes"+idPicture).innerHTML = "Likes: " + (parseInt(document.getElementById("nblikes"+idPicture).innerHTML.split(":")[1]) + 1);
        }
    };
    xmlhttp.open("GET","/controllers/likephoto.php?p="+idPicture, true);
    xmlhttp.send();
}
