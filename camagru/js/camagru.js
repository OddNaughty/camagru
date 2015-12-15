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
        width = 200,
        height = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

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

    video.addEventListener('drop', function (ev) {
        console.log(ev);
        console.log(ev.clientX);
        console.log(ev.clientY);
        //video.getContext()
    }, false);

    video.addEventListener('dragover', function (ev) {
        ev.preventDefault();
    }, false);

    joint.addEventListener('dragstart', function(e){
        e.dataTransfer.setDragImage(joint, 0, 0);
    }, false);

    document.body.addEventListener('drop', function(ev) {
        console.log('skbf');
    }, false);

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        canvas.getContext('2d').drawImage(joint, 50, 50);
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);
})();
