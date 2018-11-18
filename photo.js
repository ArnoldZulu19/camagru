(function () {

    var     video = document.querySelector('#video');
    var     no_camera = document.querySelector('#no_camera');
    var     web_button =  document.querySelector('#webcam_button');
    var     canvas = document.querySelector('#canvas');
    var     context = canvas.getContext('2d');
    var     canvas2 = document.querySelector('#canvas');
    var     context2 = canvas2.getContext('2d');
    var     img_button =  document.querySelector('#image_button');
    var     upload_image = document.querySelector('#upload');
    var     photo = document.querySelector('#photo');
    var     display = document.querySelector('#display');
    var     video_status = false;
    var     vUrl = window.URL || window.webkitURL;

    navigator.getUserMedia = navigator.getUserMedia || navigator.msGetUserMedia ||
                             navigator.oGetUserMedia || navigator.mozGetUserMedia ||
                            navigator.webkitGetUserMedia;

    navigator.getUserMedia({ video: true, audio: false }, function (stream) {
            video.src = vUrl.createObjectURL(stream);
            video_status = true;
            video.style.display = 'block';
            web_button.style.display = 'block';
            img_button.style.display = 'none';
            no_camera.style.display = 'none';
            upload.style.display = 'block';

            web_button.onclick = function() {
                var     img = new Image();
                img.src = document.querySelector('input[name="img"]:checked').value;

                context.drawImage(video, 0, 0, 380, 300);
                var myImg = canvas.toDataURL('image/png');
                photo.setAttribute('src', myImg);
                context2.drawImage(img, 0, 0, 380, 300);
                var sel = canvas2.toDataURL('image/png');
                photo.setAttribute('src', sel);
                
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "newImage.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("sel=" + sel + "&img=" + myImg);
            }   
        },
        function (error) {
            video_status = false;
            no_camera.style.display = 'block';
            video.style.display = 'none';
    });

    upload_image.onclick = function() {
        img_button.style.display = 'block';
        web_button.style.display = 'none';
        no_camera.style.display = 'block';
        video.style.display = 'none';
    }

    img_button.onclick = function () {
        if (upload_image.files.length) {

            var image = new Image();
            var img = new Image();
            img.src = document.querySelector('input[name="img"]:checked').value;
        
            image.addEventListener("load", function() {

                context.drawImage(image, 0, 0, 380, 300);
                var myImg = canvas.toDataURL('image/png');
                photo.setAttribute('src', myImg);
                context2.drawImage(img, 0, 0, 380, 300);
                var sel = canvas2.toDataURL('image/png');
                photo.setAttribute('src', sel);
                
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "newImage.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("sel=" + sel + "&img=" + myImg);

            }, false);
            image.src = window.URL.createObjectURL(upload_image.files[0]);
        }
    }


})();
   