/**
 * Created by cwagner on 15/12/15.
 */
(function() {
    var streaming = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.getElementById('canvas'),
        overlay      = document.getElementById('overlay'),
        items        = [document.querySelector('#joint'), document.querySelector('#grumpy'), document.querySelector('#luigi')],
        startbutton  = document.querySelector('#startbutton'),
        form         = document.querySelector('form'),
        formInputPhoto = document.querySelector('input[name="photo64"]'),
        formInputOverlay = document.querySelector('input[name="overlay64"]'),
        imageFile = document.querySelector('#image'),
        reset = null,
        taken = false,
        width = 200,
        height = 0,
        beingDragged = null,
        fileInput = false;

    navigator.getMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);
    var video_coos = video.getBoundingClientRect();
    overlay.style.left = video_coos.left +"px";
    overlay.style.top = video_coos.top +"px";
    navigator.getMedia(
        // cosntraints
        {
            video: true,
            audio: false
        },
        // successCallback
        function(stream) {
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL ? vendorURL.createObjectURL(stream) : stream;
            }
            video.play();
        },
        // error Callback
        function(err) {
            console.log("An error occured! " + err);
        }
    );

    // Make draggable you know
    items.forEach(function (elem) {
        elem.addEventListener('dragstart', function(e){
            e.dataTransfer.setDragImage(elem, 0, 0);
            beingDragged = elem;
        }, false);
    });

    // For file Input you know
    document.getElementById("files").onchange = function () {
        if (!this.files[0].name.match(/\.(jpg|jpeg|png|gif)$/))
            alert('Ths file is not an image, go fuck yourself :D.');
        else {
            var reader = new FileReader();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                imageFile.src = e.target.result;
                var imgCoos = imageFile.getBoundingClientRect();
                overlay.setAttribute('width', imgCoos.width);
                overlay.setAttribute('height', imgCoos.height);
                overlay.style.left = imgCoos.left +"px";
                overlay.style.top = imgCoos.top +"px";
                fileInput = true;
                width = imgCoos.width;
                height = imgCoos.height;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        }
    };

    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            overlay.setAttribute('width', width);
            overlay.setAttribute('height', height);
            var video_coos = video.getBoundingClientRect();
            overlay.style.left = video_coos.left +"px";
            overlay.style.top = video_coos.top +"px";
            streaming = true;
        }
    }, false);

    overlay.addEventListener('drop', function (ev) {
        // console.log(ev);
        // console.log(ev.offsetX);
        // console.log(ev.offsetY);
        overlay.getContext('2d').drawImage(beingDragged, ev.offsetX, ev.offsetY);
        createResetButton();
        startbutton.disabled = false;
    }, false);

    overlay.addEventListener('dragover', function (ev) {
        ev.preventDefault();
    }, false);

    document.body.addEventListener('drop', function(ev) {
        ev.preventDefault();
    }, false);

    function resetpicture() {
        overlay.getContext('2d').clearRect(0, 0, overlay.width, overlay.height);
        startbutton.disabled = true;
    }

    function createResetButton() {
        if (!reset) {
            reset = document.createElement('input');
            reset.type = "button";
            reset.name = "reset";
            reset.value = "Reset la photo !";
            reset.onclick = resetpicture;
            form.appendChild(reset);
        }
    }

    function createSubmit() {
        var submit = document.createElement("input");
        submit.type = 'submit';
        submit.value = "Enregistrer la photo";
        form.appendChild(submit);
        startbutton.disabled = true;
    }

    function takepicture() {
        if (!taken) {
            createSubmit();
            taken = true;
        }
        canvas.width = width;
        canvas.height = height;
        if (!fileInput)
            canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        else
            canvas.getContext('2d').drawImage(imageFile, 0, 0, width, height);
        formInputPhoto.value = canvas.toDataURL('image/png');
        formInputOverlay.value = overlay.toDataURL('image/png');
        canvas.getContext('2d').drawImage(overlay, 0, 0);
        resetpicture();
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);



})();

function deletePicture(id) {
    var picture = document.getElementById("picture" + id);
    console.log(picture);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            picture.remove();
        }
    };
    xmlhttp.open("GET","/controllers/deletephoto.php?p="+id, true);
    xmlhttp.send();
}