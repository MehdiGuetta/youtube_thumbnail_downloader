<?php

if(isset($_POST['download'])){
    $imgurl = $_POST['imgurl'];
    $ch =curl_init($imgurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $download = curl_exec($ch);
    curl_close($ch);
    header('Content-type: image.jpg');
    header('Content-Disposition: attachment; filename="thumbnail.jpg"');
    echo $download;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download YouTube Thumbnail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <header>Download Thumbnail</header>
        <div class="url-input">
            <span class="title">Paste video url:</span>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com/watch?v=AXaywKQDTkE" required>
                <input type="hidden" class="hidden-input" name="imgurl">
                <div class="bottom-line"></div>
            </div>
        </div>
        <div class="preview-area">
            <img class="thumbnail" src="" alt="thumbnail">
            <i class="icon fas fa-cloud-download-alt"></i>
            <span>Paste video url to see preview</span>
        </div>
        <button class="download-btn" type="submit" name="download">Download Thumbnail</button>
    </form>

    <script>
        const urlField = document.querySelector('.field input'),
            previewArea = document.querySelector('.preview-area'),
            imgTag = previewArea.querySelector('.thumbnail'),
            hiddenInput = document.querySelector('.hidden-input');

        urlField.onkeyup = () => {
            let imgUrl = urlField.value;
            previewArea.classList.add('active');

            if (imgUrl.indexOf('https://www.youtube.com/watch?v=') != -1) {
                let valid = imgUrl.split('v=')[1].substring(0, 11);
                let ytThumbUrl = `https://img.youtube.com/vi/${valid}/maxresdefault.jpg`
                imgTag.src = ytThumbUrl;

            } else if (imgUrl.indexOf('https://youtu.be/') != -1) {
                let valid = imgUrl.split('be/')[1].substring(0, 11);
                let ytThumbUrl = `https://img.youtube.com/vi/${valid}/maxresdefault.jpg`
                imgTag.src = ytThumbUrl;

            } else if (imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)) {
                imgTag.src = imgUrl
            }else{
                imgTag.src = '';
                previewArea.classList.remove('active');
            }
            hiddenInput.value = imgTag.src;
        }




    </script>

</body>

</html>