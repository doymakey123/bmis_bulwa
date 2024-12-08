
<!DOCTYPE html>
<html>
<head>
  <title>Camera Capture</title>
</head>
<body>
  <video id="video" width="640" height="480"></video>
  <button onclick="captureImage()">Capture</button>

  <script>
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => {
        const video = document.getElementById('video');
        video.srcObject = stream;
        video.play();
      })
      .catch(error => {
        console.error('Camera access denied:', error);
      });

    function captureImage() {
      const canvas = document.createElement('canvas');
      const ctx = canvas.getContext('2d');
      const video = document.getElementById('video');

      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      ctx.drawImage(video, 0, 0);
      const dataURL = canvas.toDataURL();

      console.log(dataURL);
    }
  </script>
</body>
</html>
