/**
 * Created by cwagner on 15/12/15.
 */
(function() {
    var streaming = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.getElementById('canvas'),
        overlay      = document.getElementById('overlay'),
        joint        = document.querySelector('#joint'),
        startbutton  = document.querySelector('#startbutton'),
        form         = document.querySelector('form'),
        formInput    = document.querySelector('input[name="photo64"]'),
        reset = null,
        taken = false,
        width = 200,
        height = 0,
        beingDragged = null;

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
        console.log(ev);
        console.log(ev.offsetX);
        console.log(ev.offsetY);
        overlay.getContext('2d').drawImage(beingDragged, ev.offsetX, ev.offsetY);
        createResetButton();
    }, false);

    overlay.addEventListener('dragover', function (ev) {
        ev.preventDefault();
    }, false);

    joint.addEventListener('dragstart', function(e){
        e.dataTransfer.setDragImage(joint, 0, 0);
        beingDragged = joint;
    }, false);

    document.body.addEventListener('drop', function(ev) {
        console.log('skbf');
    }, false);

    function resetpicture() {
        overlay.getContext('2d').clearRect(0, 0, overlay.width, overlay.height);
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
        formInput.value = canvas.toDataURL('image/png');
    }

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        canvas.getContext('2d').drawImage(overlay, 0, 0);
        console.log(canvas.toDataURL());
        if (!taken) {
            createSubmit();
            taken = true;
        }
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);
})();