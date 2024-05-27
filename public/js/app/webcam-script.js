

var video = document.getElementById('video');
// var canvas = document.getElementById('canvas');
// var context = canvas.getContext('2d');
var captureButton = document.getElementById('capture');
var webcamImageInput = document.getElementById('image');

navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
        video.srcObject = stream;
        // captureButton.addEventListener('click', function() {
        //     context.drawImage(video, 0, 0, canvas.width, canvas.height);
        //     var dataURL = canvas.toDataURL('image/png');
        //     webcamImageInput.value = dataURL;
        // });

        captureButton.addEventListener('click', function (e) {
            e.stopImmediatePropagation()
            // menu.classList.remove('d-none');
            // console.log(menu)
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            canvas.toBlob((blob) => {
                const file = new File([blob], 'foto.jpg', {type: 'image/jpg'});
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('#img').src = e.target.result;
                    ocultarVideo();
                }
                reader.readAsDataURL(file);
                const data = new DataTransfer();
                data.items.add(file);
                document.getElementById('image').files = data.files;


            });
            stream.getTracks().forEach(track => track.stop());
        })
    })
    // .catch(function(err) {
    //     console.error("Erro: " + err);
    // });


            function ocultarVideo() {
        document.querySelector('#img').classList.remove('d-none');
        document.querySelector('video').classList.add('d-none');
    }